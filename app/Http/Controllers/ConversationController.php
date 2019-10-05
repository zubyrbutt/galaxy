<?php
namespace App\Http\Controllers;
use App\Conversation;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
class ConversationController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('chat');
    }
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($lead_id=null)
    {
        //return Message::with('user')->get();
        return Conversation::with('createdby')->where("lead_id",$lead_id)->get();
        
    }
    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->conversation()->create([
          'message' => $request->input('message'),
          'lead_id' => $request->input('lead_id'),
          'created_by'=>$user->id
        ]);
        //dd($message->toArray());
        broadcast(new MessageSent($user, $message))->toOthers();
      
        return ['status' => 'Message Sent!'];
    }
}