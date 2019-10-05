<template>
    <div>
        <button class="btn btn-primary" v-if="calling" @click="showcallpopup()">Ongoing Call</button>
        <div class="messaging">
            <div class="first" style="width: 30%;float: left;">
                <div class="mobile_button">
                    <!-- custom people button for mobile view, it will work on only click, will show the recent people chat list -->
                    <button v-on:click="showInboxPeople()" class=" btn btn-warning show_on_mobile_only"
                            style=" position: absolute;width: 29%;top: -49px; right: 0px; padding: 8px;">
                        <li class="fa fa-bars"> People</li>
                    </button>
                </div>
                <div class="only_bigscreen">
                    <button v-if="adduserpermission===1" class=" btn btn-primary"
                            :style="(group_permission === 1) ? widthHalf : widthAll" data-toggle="modal"
                            data-target="#exampleModal">
                        <li class="fa fa-user-plus"></li>
                        New Chat
                    </button>
                    <button v-if="group_permission===1" class="  btn btn-success pull-right" style="width: 50%;"
                            data-toggle="modal" data-target="#createGroupModel">
                        <li class="fa fa-users"></li>
                        Create Group
                    </button>
                </div>
                <!-- custom code mobile_button class is only for the mobile view, it will not be shown on big screens -->
                <div class="mobile_button">
                    <button v-if="adduserpermission===1" class=" btn btn-primary"
                            :style="(group_permission === 1) ? widthHalf : widthAll" data-toggle="modal"
                            data-target="#exampleModal">
                        <li class="fa fa-user-plus"></li>
                    </button>
                    <button v-if="group_permission===1" class=" btn btn-success pull-right" style="width: 50%;"
                            data-toggle="modal" data-target="#createGroupModel">
                        <li class="fa fa-users"></li>
                    </button>
                </div>
            </div>
            <div class="second"
                 style="width: 70%;float: left; background-color: #F4F4F4; border: 1px solid lightgray; height: 44px;"
                 v-if="selectedContact">
                <img :src="selectedContact.avatar ? imgPreUrl + selectedContact.avatar : imgPreUrl + defaultImg">
                <span>
                    <h3 v-if="selectedContact.room_type === 'Normal'">
                        <p style="float:left;">{{selectedContact.roomname}}</p>
                        <p class="deptnameclass" style="float: left;"
                           v-if="(selectedContact.deptname !=='')">
                            ( {{selectedContact.deptname}} )
                        </p>

                        <button v-if="!calling" @click="calluser(selectedContact)"
                                class="pull-right btn btn-primary btn-flat btn-sm callwalabtn">
                            <i class="fa fa-phone"></i>
                        </button>
                    </h3>
                    <h3 data-toggle="modal" data-target="#groupMembersModal"
                        v-if="selectedContact.room_type === 'Group'">
                            {{selectedContact.roomname}}
                    </h3>

                </span>
                <div class="only_bigscreen">
                    <button data-toggle="modal" data-target="#groupMembersModal"
                            v-if="selectedContact.room_type === 'Group'"
                            style="margin-right: 5px;" class="btn btn-flat btn-success btn-sm pull-right">Members
                    </button>
                </div>

            </div>
            <!-- custom code button for mobile -->

            <div class="inbox_msg">
                <ContactListsComponent :contacts="contacts" @selected="startConversationWith"></ContactListsComponent>
                <i class="fa fa-arrow-down" @click="scroll"></i>
                <ConversationComponent :contactSelect="selectedContact" :messages="messages"
                                       :user="user"></ConversationComponent>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Start New Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <AddNewUser :allcontacts="allcontacts" @newUserAdded="getcontactlist"></AddNewUser>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="createGroupModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Join New Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <CreateNewGroup :allcontacts="allcontacts" @newUserAdded="getcontactlist"></CreateNewGroup>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="groupMembersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Group Members</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <GroupMembers @updatemembers="updatemembers" :groupmembers="groupmembers" :selectedContact="selectedContact" :allcontacts="allcontacts" :group_permission="group_permission"></GroupMembers>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="incommingcall" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <!--<div class="modal-header">-->
                    <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <!--<h4 class="modal-title">Call</h4>-->
                    <!--</div>-->
                    <div class="modal-body" style="text-align:center;">
                        <h3 v-show="callerindicator">Call {{callername}}</h3>
                        <h3 v-show="!callerindicator">Call {{callername}}</h3>
                        <br>
                        <textarea id="yourId" style="display: none;"></textarea><br/>
                        <textarea id="otherId" style="display: none;"></textarea>
                        <button id="btnacceptcall" class="btn btn-success btn-flat" v-show="!callerindicator"
                                @click="acceptcall()">Accept
                        </button>
                        <button @click="endcall()" class="btn btn-danger btn-flat">End</button>
                        <br>
                        <h1 v-show="callduration">{{callduration}}</h1>
                        <audio @timeupdate='onTimeUpdateListener' id="gum-local" controls autoplay
                               style="display: none;"></audio>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


    </div>
</template>
<script>
    var selectedroom = null;
    var authUserid = $('meta[name="user-id"]').attr('content');
    var otherid = '';
    var globalindicator = '';
    var answerroomid = '';
    if (window.location.pathname == "/chat") {
        var ringtone = new Audio('audio/ringtone.mp3');
        ringtone.loop = true;
        var fromarding = new Audio('audio/forwarding.mp3');
        fromarding.loop = true;
        console.log('chatroom')
    }
    import Conversation from './ConversationComponent';
    import ContactsList from './ContactListsComponent';
    import AddNewUser from './AddNewUserComponent';
    import CreateNewGroup from './CreateNewGroupComponent';
    import GroupMembers from './GroupMembers';
    import Peer from 'simple-peer';

    var peer = null;
    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            rooms: {
                type: Array,
                default: []
            },
            group_permission: {
                type: Number,
                default: 0
            },
            adduserpermission: {
                type: Number,
                default: 0
            }
        },
        data() {
            return {
                widthAll: "width: 100%",
                widthHalf: "width: 50%",
                selectedContact: null,
                messages: [],
                contacts: [],
                allcontacts: [],
                imgPreUrl: 'img/staff/',
                defaultImg: 'default_avatar_male.jpg',
                groupmembers: [],
                user_id: 0,
                initiator: '',
                calling: false,
                callerid: '',
                callerindicator: false,
                callduration: null,
                callername:''

            };
        },

        mounted() {
            var loading = $(".chat-data-loading");
            loading.fadeIn();
            this.user_id = $('meta[name="user-id"]').attr('content');
            if (this.rooms.length > 0) {
                for (var i = 0; i < this.rooms.length; i++) {

                    Echo.private(`newMessage.${this.rooms[i]}`)
                        .listen('NewMessage', (e) => {
                            this.handleIncoming(e.message);
                        });
                    Echo.private(`newCall.${this.rooms[i]}`)
                        .listen('CallUser', (e) => {
                            $("#incommingcall").modal();
                            if(e.calldata.c_user_id===this.user_id){
                                fromarding.play();
                            }
                            if (e.calldata.c_user_id != this.user_id) {
                                ringtone.play();
                                //console.log(e);
                                this.callername=' from '+e.calldata.callername;
                                answerroomid = e.calldata.recieverid;
                                otherid = e.calldata.callerid;
                                $("#otherId").val(otherid);
                            }
                        });

                    Echo.private(`answerCall.${this.rooms[i]}`)
                        .listen('AnswerCall', (e) => {
                            //console.log(e);
                             fromarding.pause();
                            if (e.calldata.indicator === 'endcall') {
                                if(peer){
                                    peer.destroy();
                                    peer = null;
                                }
                                ringtone.pause();
                                this.initiator = '';
                                globalindicator = '';
                                otherid = '';
                                answerroomid = '';
                                this.calling = false;
                                this.callerid = '';
                                this.callerindicator = false;
                                this.callduration =null;
                                this.callername='';
                                $("#incommingcall").modal('hide');
                                //if (e.calldata.c_user_id === this.user_id) {
                                    $('#btnacceptcall').show();
                                //}
                                return;
                            }
                            // console.log('roomid ' + e.calldata.recieverid);
                            if (e.calldata.c_user_id !== this.user_id && e.calldata.initiator!=='endcall') {
                                answerroomid = e.calldata.recieverid;
                                this.initiator = "startcalling";
                                otherid = e.calldata.callerid;
                                $("#otherId").val(e.calldata.callerid);
                                //otherid= answerroomid;
                                otherid = $('#otherId').val();
                                this.connectcall()
                            }
                        });
                }
                this.getcontactlist();
                // this.useronlineorofline();
            }

            Echo.private(`newroomcreated.${this.user_id}`)
                .listen('NewRoom', (e) => {
                    this.getcontactlist();
                });

            axios.get('contacts_list')
                .then((response) => {
                    this.allcontacts = response.data;
                });
        },
        methods: {
            showcallpopup() {
                $("#incommingcall").modal();
            },
            onTimeUpdateListener: function () {
                var audio = document.getElementById("gum-local");
                var s = parseInt(audio.currentTime % 60);
                var m = parseInt((audio.currentTime / 60) % 60);
                this.callduration = m + ":" + s;
            },
            calluser(s) {
                this.getusermediapermission();
                this.callduration=null;
                this.callerindicator = true;
                globalindicator = this.initiator;
                selectedroom = this.selectedContact;
                this.callername = ' To '+this.selectedContact.roomname;
                this.calling = true;
                this.initiator = "caller";
                this.connectcall();
            },
            acceptcall() {
                this.getusermediapermission();
                ringtone.pause();
                this.initiator = "accept";
                globalindicator = this.initiator;
                this.connectcall();
                this.calling = true;
                $('#btnacceptcall').hide();
            },
            endcall() {
                this.getusermediapermission();
                this.callduration=null;
                this.initiator = "endcall";
                globalindicator = this.initiator;
                if(this.initiator==='endcall' && this.callerindicator === true){
                    axios.post('answercall', {
                        reciever: selectedroom.room_id,
                        callerid: this.callerid,
                        indicator: globalindicator,
                        c_user_id: authUserid,
                    }).then((response) => {
                    });
                }

                if(answerroomid!=='' && this.callerindicator === false){
                    axios.post('answercall', {
                        reciever: answerroomid,
                        callerid: '',
                        indicaator: globalindicator,
                        c_user_id: authUserid,
                    }).then((response) => {});
                }
                // this.connectcall();
                $("#incommingcall").modal('hide');
                // peer = null;
                this.calling = false;
                this.initiator = '';
                this.callerindicator = false;

            },
            getusermediapermission(){
                if (!navigator.getUserMedia)
                    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia || navigator.msGetUserMedia;
                if (navigator.getUserMedia){

                    navigator.getUserMedia({audio:true},
                        function(stream) {
                            console.log('permission granted')
                        },
                        function(e) {
                            console.log('audio capturing error')
                        }
                    );

                } else { alert('getUserMedia not supported in this browser.'); }
            },
            connectcall() {
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia({audio: true}).then(stream => {

                        if (this.initiator === 'startcalling') {
                            if (peer!==null){
                                peer.signal(otherid);
                            }
                        } else {
                            peer = new Peer({
                                initiator: this.initiator === 'caller',
                                trickle: false,
                                stream: stream
                            });
                        }

                        if (this.initiator === 'caller') {
                            peer.on('signal', function (data) {
                                this.callerid = JSON.stringify(data);
                                axios.post('callusers', {
                                    reciever: selectedroom.room_id,
                                    callerid: this.callerid,
                                    indicator: globalindicator,
                                    c_user_id: authUserid,
                                }).then((response) => {
                                });
                                document.getElementById('yourId').value = JSON.stringify(data)
                            });

                        } else if (this.initiator !== 'startcalling' && this.initiator !== "caller" && this.initiator !== 'endcall') {

                            peer.on('signal', function (data) {
                                document.getElementById('yourId').value = JSON.stringify(data)
                                this.callerid = JSON.stringify(data);
                                axios.post('answercall', {
                                    reciever: answerroomid,
                                    callerid: this.callerid,
                                    indicator: globalindicator,
                                    c_user_id: authUserid,
                                }).then((response) => {
                                });
                            });
                            peer.signal(otherid);
                        }
                        if (peer!==null){
                            peer.on('stream', function (stream) {
                                const audio = document.querySelector('audio');
                                const audioTracks = stream.getAudioTracks();
                                audio.srcObject = stream;
                            });
                        }


                    });
                }
            },
            showInboxPeople() {
                document.getElementById('inbox_people_list').style.display = 'inline-block';
                document.getElementById("inbox_people_list").style.width = "200px";
            },
            startConversationWith(room) {
                axios.get('get_room_conversations/' + room.room_id)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = room;
                        this.scroll();
                        var loading = $(".chat-data-loading");
                        loading.fadeOut();

                    });
                $('#room_' + room.room_id).hide();
                axios.get('getGroupMembers/' + room.room_id)
                    .then((response) => {
                        this.groupmembers = response.data;
                    });


            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            handleIncoming(message) {
                if (this.selectedContact.room_id === message.room_id) {
                    this.saveNewMessage(message);
                    this.scroll();

                    return;
                }
                $('#room_' + message.room_id).show();
            },
            getcontactlist(contact = '') {
                Echo.private(`newMessage.${contact.id}`)
                    .listen('NewMessage', (e) => {
                        this.handleIncoming(e.message);
                    });
                axios.get('getUsersChatRooms')
                    .then((response) => {
                        if (response.data.length > 0) {
                            this.contacts = response.data;
                            this.selectedContact = this.contacts[0];
                            this.startConversationWith(this.contacts[0]);

                        }
                    });

            },
            scroll() {

                $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight - $('.msg_history')[0].clientHeight);

            },

            updatemembers( room_id) {
                console.log(room_id);
                axios.get('getGroupMembers/' + room_id)
                    .then((response) => {
                        this.groupmembers = response.data;
                    });
            }
            // ,
            // useronlineorofline() {
            //     Echo.join('chat')
            //         .joining((user) => {
            //             axios.put('useronline/'+ user.id +'/online');
            //         })
            //         .leaving((user) => {
            //             axios.put('userofline/'+ user.id +'/offline');
            //         })
            //         .listen('UserOnline', (e) => {
            //             $('#activeStatus_' + e.user.id).show();
            //             $('#activeStatus_' + e.user.id).text('Online');
            //         })
            //         .listen('UserOffline', (e) => {
            //             $('#activeStatus_' + e.user.id).hide();
            //             $('#activeStatus_' + e.user.id).text('Offline');
            //         });
            // }

        },
        components: {
            'ConversationComponent': Conversation,
            'ContactListsComponent': ContactsList,
            'AddNewUser': AddNewUser,
            'CreateNewGroup': CreateNewGroup,
            'GroupMembers': GroupMembers,

        }
    }
</script>
<style scoped>
    .first .btn-success, .btn-primary {
        border-radius: unset;
    }

    .second h3 {
        margin-top: 0px;
        margin-bottom: 0px;
        width: 70%;
        float: left;
    }

    .second .label {
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 0;
        padding-bottom: 0;
    }

    .second img {
        margin-left: 5px;
        height: 30px;
        float: left;
        border-radius: 50%;
    }

    .first .btn {
        padding: 14px;
    }

    .deptnameclass {
        font-size: 15px;
    }

    /*.second{
        padding: 10px;
        background: #222d32;
    }*/
    /* custom code of css for this chat component */
    @media only screen and (max-width: 768px) {
        .show_on_mobile_only {
            display: none;
        }
    }

    @media only screen and (max-width: 450px) {
        .show_on_mobile_only {
            display: block;
        }

        .deptnameclass {
            font-size: 11px;
        }

    }
    .fa-arrow-down{
        position: absolute;
        right: 6%;
        bottom: 30%;
        border:2px solid black;
        border-radius: 50%;
        padding:8px;
        background: #222d3221;
    }

    .callwalabtn{
        height: 5.3%;
        position: absolute;
        right: 1.13%;
    }
</style>