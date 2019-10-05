<template>
    <div class="mesgs">
        <form>
            <div class="msg_history">
                <div v-if="messages.length > 0">
                    <div v-for="message in messages">
                        <div v-if="message.sender_id != user.id" class="incoming_msg">
                            <div class="incoming_msg_img">
                                <img :src="imgPreUrl+message.sender_avatar" alt="kabeer">
                            </div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p v-if="message.message !='nomesg'">
					                <span>
                                    <p v-if="isUrl(message.message)===true">
                                        <a :href="message.message" target="_blank">{{message.message}}</a>
                                    </p>
                                    <p v-else class="messagebodypre">{{message.message}}</p>
                                    </span>
                                    </p>
                                    <div v-if="message.file !='nofile'">
                                        <a :href="chatAssets+message.file" target="_blank" download>
                                            <p class="text-center">
                                                <b>{{message.sender_name + ' has send a file '}}</b>
                                                <br>
                                                <img src="img/selectattachment.png" style="width: 20px; height: 20px;">
                                                {{message.file}}
                                            </p>
                                        </a>
                                    </div>
                                    <span class="time_date"> {{message.send_time}} <span class="pull-right">( {{message.sender_name}} )</span></span>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div v-else class="outgoing_msg">
                            <div class="incoming_msg_img" style="float: right;">
                                <img :src="imgPreUrl+message.sender_avatar" alt="kabeer">
                            </div>
                            <div class="sent_msg">
                                <p v-if="message.message !='nomesg'">
					            <span>
                                <p v-if="isUrl(message.message)===true">
                                    <a :href="message.message" target="_blank">{{message.message}}</a>
                                </p>
                                <p v-else class="messagebodypre">{{message.message}}</p>
                                </span>
                                </p>
                                <div v-if="message.file !='nofile'">
                                    <a :href="chatAssets+message.file" target="_blank" download>
                                        <p class="text-center">
                                            <b>{{message.sender_name + ' has send a file '}}</b>
                                            <br>
                                            <img src="img/selectattachment.png" style="width: 20px; height: 20px;">
                                            {{message.file}}
                                        </p>
                                    </a>
                                </div>
                                <span class="time_date"> {{message.send_time}}</span>
                            </div>

                        </div>

                    </div>

                    <br><br><br>
                </div>
                <div v-else>No Message</div>
            </div>
            <ComposeMessageComponent @send="sendMessage" :contactSelect="contactSelect"></ComposeMessageComponent>
        </form>
    </div>

</template>
<script>
    import ComposeMessage from './ComposeMessageComponent'

    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            messages: {
                type: Array,
                default: []
            },
            contactSelect: {
                type: Object,
                default: null
            }
        },
        data() {
            return {
                imgPreUrl: 'img/staff/',
                chatAssets: '/storage/chatfiles/',
                GroupimgPreUrl: '/storage/chatfiles/',
                defaultImg: 'default_avatar_male.jpg',
            }
        },
        mounted() {

        },
        methods: {
            sendMessage(newmessage) {
                axios.post('sendMessage', {
                    room_id: this.contactSelect.room_id,
                    message: newmessage
                }).then((response) => {
                    this.$emit('new', response.data);

                });

            },
            scrollMessageFeeds() {


            },
            isUrl(mesg) {
                var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
                return regexp.test(mesg);
            }
        },
        components: {
            'ComposeMessageComponent': ComposeMessage
        }
    }
</script>


<style scoped>
    img {
        border-radius: 50%;
    }

    a {
        color: black;
    }

    .received_msg p {
        color: black;
    }

    .sent_msg p {
        background: #b4e7fa;
        color: black;
        word-wrap: break-word;
    }

    .received_msg p {
        word-wrap: break-word;
    }

    .messagebodypre {
        white-space: pre-wrap;
    }
    .fa-arrow-down{
        position: absolute;
        right: 6%;
        bottom: 30%;
        border:2px solid black;
        border-radius: 50%;
        padding:8px;
    }
</style>

