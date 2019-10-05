/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Peer from 'simple-peer'
import vSelect from 'vue-select'
import {Picker} from 'emoji-mart-vue'

/* chat box begins */

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
Vue.component('chat-component', require('./components/ChatComponent.vue'));

Vue.component('v-select', vSelect)
Vue.component('Picker', Picker)


window.addEventListener('load', function () {
    var leadid = 0;//(document.getElementById('lead_id').value) ? document.getElementById('lead_id').value : 0;
    var leadid = 0;

    if (typeof ($('#lead_id').val()) != "undefined" && $('#lead_id').val() !== null) {
        leadid = $('#lead_id').val();
    } else {
        leadid = 0;
    }
    const app = new Vue({
        el: '#app',
        data: {
            messages: [],
            rooms: {
                type: Array,
                default: []
            },
            user_id: 0
        },

        created() {

            this.user_id = $('meta[name="user-id"]').attr('content');
            Echo.private(`newroomcreated.${this.user_id}`)
                .listen('NewRoom', (e) => {

                    Notification.requestPermission(permission => {
                        let notificationabc = new Notification("New Room Created", {
                            body: "New Room", // content for the alert
                            icon: iconURL // optional image url
                        });
                        // link to page on clicking the notification
                        notificationabc.onclick = () => {
                            if (window.location.pathname == "/chat") {
                                location.reload();
                            } else {
                                window.open("/chat");
                            }
                        };
                    });
                    // this.notification('You have new Message','success')
                });
            if(leadid>0){
                this.fetchMessages();
            }
            Echo.private('chat')
                .listen('MessageSent', (e) => {
                    if (e.message.lead_id == leadid) {
                        this.messages.push({
                            message: e.message.message,
                            createdby: e.user
                        });
                    }
                });

            this.fetchUsersNewMessage();

        },

        methods: {
            fetchUsersNewMessage() {

                axios.get('getUserChatRoomsIDs').then(response => {
                    this.rooms = response.data;
                    for (var i = 0; i < response.data.length; i++) {

                        Echo.private(`newMessage.${response.data[i]}`)
                            .listen('NewMessage', (e) => {
                                var count = $('#room_' + e.message.room_id).text();
                                count++;
                                $('#room_' + e.message.room_id).text(count)
                                if (e.message.sender_id != this.user_id) {
                                    var audio = new Audio('/audio/notification.mp3');
                                    audio.play();
                                    //this.notification('You have new Message From ' + e.message.sender_name + ' ' + e.message.message, 'success')
                                    var messageBody=e.message.message;
                                    var title='';
                                    if (e.message.roomtype == "Normal") {
                                        if (messageBody === "nomesg") {
                                            title = e.message.sender_name;
                                        } else {
                                            title = e.message.sender_name + ' Says ';
                                        }

                                    } else {
                                        title = e.message.sender_name + ' Says in ' + e.message.roomname;
                                    }

                                    if (messageBody === "nomesg") {
                                        messageBody = " Shared a file";
                                    } else {
                                        messageBody = e.message.message;
                                    }

                                    Notification.requestPermission(permission => {
                                        let notificationabc = new Notification(title, {
                                            body: messageBody, // content for the alert
                                            icon: iconURL // optional image url
                                        });
                                        // link to page on clicking the notification
                                        notificationabc.onclick = () => {
                                            if (window.location.pathname == "/chat") {
                                                location.reload();
                                            } else {
                                                window.open("/chat");
                                            }
                                        };
                                    });
                                }
                            });
                    }
                });
            },

            fetchMessages() {
                axios.get('messages/' + leadid).then(response => {
                    this.messages = response.data;
                });

            },
            notification(mesg, mesg_type) {
                $.notify(
                    {
                        message: mesg,
                        url: "chat"
                    },
                    {
                        type: mesg_type,
                        animate: {
                            enter: 'animated fadeInUp',
                            exit: 'animated fadeOutRight'
                        },
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                    }
                );
            },
            addMessage(message) {
                this.messages.push(message);
                axios.post('messages', message).then(response => {
                });
            }
        }
    });
})

/* chat box ends */


let userId = document.head.querySelector('meta[name="user-id"]').content;
var iconURL = "https://erp.nsol.sg/img/n.png";

Echo.private(`App.User.${userId}`)
    .notification((notification) => {
        //console.log("App Js is working");
        //console.log(notification.count);
        //console.log(notification.letter.redirectURL);
        //console.log(notification.letter.title);
        document.querySelector('.label-warning').innerText = notification.count;
        $('#notifictioncount').val = notification.count;
        if (!('Notification' in window)) {
            alert('Web Notification is not supported');
            return;
        }
        Notification.requestPermission(permission => {
            let notificationabc = new Notification(notification.letter.title, {
                body: notification.letter.body, // content for the alert
                icon: iconURL // optional image url
            });
            // link to page on clicking the notification
            notificationabc.onclick = () => {
                window.open(notification.letter.redirectURL);
            };
        });
    });
            
    
    