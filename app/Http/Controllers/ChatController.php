<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use App\ChatRoomFeed;
use App\ChatRoomParticipant;
use App\Events\AnswerCall;
use App\Events\NewMessage;
use App\Events\NewRoom;
use App\Events\CallUser;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\GroupMemberCollection;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessageResourceCollection;
use App\Http\Resources\Participant;
use App\Http\Resources\ParticipantCollection;
use App\Messages;
use App\UnReadMessage;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;

class ChatController extends Controller
{
    public function index()
    {
        $auth_user_id = Auth::user()->id;
        $chatrooms = ChatRoomParticipant::where('user_id', $auth_user_id)->pluck('room_id');

        return view('chat.index')->with('rooms', $chatrooms);
    }


    public function getUserChatRoomsIDs()
    {

        $auth_user_id = Auth::user()->id;
        $chatrooms = ChatRoomParticipant::where('user_id', $auth_user_id)->pluck('room_id');
        return response()->json($chatrooms);
    }


    public function contactList()
    {

        $auth_user_id = Auth::user()->id;
        $users = User::where('status', 1)->where('iscustomer', 0)->get();
        return response(new ContactCollection($users));
        return response()->json($users);
    }


    public function getConversations($contact_id)
    {
        $user_id = Auth::user()->id;

        $data = DB::select('SELECT * FROM messages as mm WHERE mm.to=' . $user_id . ' AND mm.from=' . $contact_id . ' OR mm.from=' . $user_id . ' AND mm.to=' . $contact_id);
        return response()->json($data);
    }


    public function sendMessage(Request $request)
    {

        $user_id = Auth::user()->id;

        $newMessage = new ChatRoomFeed;

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $filename = time() . $file->getClientOriginalName();
            //$file->move(public_path().'/img/chat', $filename);
            Storage::disk('local')->put('/public/chatfiles/' . $filename, File::get($request->file));

            $newMessage->file = $filename;
        } else {

            $newMessage->message = $request->message;
        }


        $newMessage->room_id = $request->room_id;
        $newMessage->sender_id = $user_id;

        $newMessage->save();

        $roomparticipants = ChatRoomParticipant::where('room_id', $request->room_id)->pluck('user_id');

        foreach ($roomparticipants as $key => $value) {
            $unreadMessage = new UnReadMessage;
            if ($user_id != $value) {

                $unreadMessage->room_id = $request->room_id;
                $unreadMessage->user_id = $value;
                $unreadMessage->message_id = $newMessage->id;

                $unreadMessage->save();
            }
        }

        broadcast(new NewMessage($newMessage));

        // return response()->json($newMessage->toArray());
        return response(new MessageResource($newMessage));
    }


    public function createChatRoom(Request $request)
    {
        $auth_user_id = Auth::user()->id;

        $chatrooms = ChatRoom::where('room_type', 'Normal')->whereHas('participants', function ($query) use ($auth_user_id) {
            $query->where('user_id', '=', $auth_user_id);
        })
            ->with('participants')
            ->get();

        $count = 0;
        foreach ($chatrooms as $rooms) {
            foreach ($rooms->participants as $value) {
                if ($value->user_id == $request->user_id) {
                    $count++;
                }
            }
        }

        if ($count <= 0) {
            $chatRoom = new ChatRoom;
            $chatRoom->room_type = 'Normal';
            $chatRoom->status = 'Active';
            $chatRoom->save();

            if ($chatRoom) {
                $chatParticipants = new ChatRoomParticipant;
                $chatParticipants->room_id = $chatRoom->id;
                $chatParticipants->user_id = $request->user_id;
                $chatParticipants->save();

                broadcast(new NewRoom($chatParticipants));

                $chatParticipants = new ChatRoomParticipant;
                $chatParticipants->room_id = $chatRoom->id;
                $chatParticipants->user_id = $auth_user_id;
                $chatParticipants->save();

                //broadcast(new NewRoom($chatParticipants));
            }


            return response($chatRoom);
        } else {
            echo "already exists";
        }

    }


    public function getUsersChatRooms()
    {

        $auth_user_id = Auth::user()->id;

        $chatrooms = ChatRoom::whereHas('participants', function ($query) use ($auth_user_id) {
            $query->where('user_id', '=', $auth_user_id);
        })
            ->with('participants')
            ->get();

        return response(new ParticipantCollection($chatrooms));
    }


    public function getGroupMembers($room_id)
    {
        $members = ChatRoomParticipant::where('room_id', $room_id)->get();
        return response(new GroupMemberCollection($members));
    }


    public function getRoomConversations($room_id)
    {
        $data = ChatRoomFeed::where('room_id', $room_id)->get();
        return response(new MessageResourceCollection($data));
        return response()->json($data);
    }


    public function createGroups(Request $request)
    {

        $group_participants = rtrim($request->ids, ',');
        $group_participants = explode(',', $group_participants);

        //dd($request->all());
        $auth_user_id = Auth::user()->id;
        $chatRoom = new ChatRoom;
        $chatRoom->room_type = 'Group';
        $chatRoom->status = 'Active';
        $chatRoom->createdby = $auth_user_id;
        $chatRoom->name = $request->groupname;

        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $filename = time() . $file->getClientOriginalName();
            //$file->move(public_path().'/img/chat', $filename);
            Storage::disk('chatfiles')->put($filename, File::get($request->logo));

            $chatRoom->logo = $filename;
        } else {

        }

        $chatRoom->save();

        if ($chatRoom) {
            //All Users insertion begins
            foreach ($group_participants as $value) {

                $chatParticipants = new ChatRoomParticipant;
                $chatParticipants->room_id = $chatRoom->id;
                $chatParticipants->user_id = $value;
                $chatParticipants->save();

                broadcast(new NewRoom($chatParticipants));
            }
            //All Users insertion end

            //Current Login User insertion begins    
            $chatParticipants = new ChatRoomParticipant;
            $chatParticipants->room_id = $chatRoom->id;
            $chatParticipants->user_id = auth()->user()->id;
            $chatParticipants->save();
            //Current Login User insertion ends
        }


        return response()->json(['success' => 1]);
    }


    public function addNewMembersToGroup(Request $request)
    {
        $group_participants = rtrim($request->selectedUserIds, ',');
        $group_participants = explode(',', $group_participants);

        foreach ($group_participants as $value) {
            $chatParticipants = ChatRoomParticipant::where('room_id', $request->room_id)
                ->where('user_id', $value)
                ->count();
            if ($chatParticipants <= 0) {
                $groupNewMember = new ChatRoomParticipant;
                $groupNewMember->room_id = $request->room_id;
                $groupNewMember->user_id = $value;
                $groupNewMember->save();
                echo $value . ' === Added';
            }
        }
    }


    public function markasread(Request $request)
    {
        $room_id = $request->room_id;
        $auth_user_id = Auth::user()->id;

        $deletedRows = UnReadMessage::where('user_id', $auth_user_id)
            ->where('room_id', $room_id)
            ->delete();

    }


    public function callusers(Request $request)
    {
        $user = User::where('id',$request->c_user_id)->first();

        $calldetail = array(
            'callerid' => $request->callerid,
            'recieverid' => $request->reciever,
            'c_user_id' => $request->c_user_id,
            'callername'=>$user->fname . ' ' .$user->lname,
        );
        broadcast(new CallUser($calldetail));
    }

    public function answercall(Request $request)
    {
        // dd ($request->all());
        $calldetail = array(
            'callerid' => $request->callerid,
            'recieverid' => $request->reciever,
            'indicator' => $request->indicator,
            'c_user_id' => $request->c_user_id,
        );
        broadcast(new AnswerCall($calldetail));
    }


    public function removememberfromgroup(Request $request){
//        dd($request->all());
        ChatRoomParticipant::where('room_id', $request->room_id)->where('user_id',$request->user_id)->delete();
    }

}
