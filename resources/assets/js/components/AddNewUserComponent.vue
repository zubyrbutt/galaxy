<template>
    <div style="text-align: right;">
        <v-select label="user_name" :options="allcontacts" placeholder="Select Member...">
            <template slot="option" slot-scope="option">
              <div class="d-center" @click="selectContact(option)">
                <img :src='imgPreUrl+option.avatar'/> 
                {{ option.user_name }}
                </div>
            </template>
        </v-select>
        <br>
        <button class="btn btn-primary text-right" style="border-radius: unset;" @click="addselectedUser()" data-dismiss="modal">Start Chat</button>
    </div>
</template>
<script>
    export default {
        props: {
            allcontacts: {
                type: Array,
                default: []
            }
        },
        data(){
            return {
                contactList: null,
                filter:'',
                imgPreUrl:'img/staff/',
                defaultImg :'default_avatar_male.jpg',
                selectedUser :''
            };
        },
        methods:{
            addselectedUser(){
                //console.log(this.selectedUser)

                if(this.selectedUser==''){
                    return;
                }

                var loading = $(".chat-data-loading");
                loading.fadeIn();
                axios.post('createChatRoom', {
                    user_id: this.selectedUser,
                }).then((response)=>
                    this.$emit('newUserAdded', response.data)
                );


            },
            selectContact(contact){
                this.selectedUser = contact.user_id;        
            }
        }
    }
</script>
<style scoped>
    
    img {
      height: auto;
      max-width: 2.5rem;
      margin-right: 1rem;
    }

    .d-center {
      display: flex;
      align-items: center;
    }

    .selected img {
      width: auto;
      max-height: 23px;
      margin-right: 0.5rem;
    }

    .v-select .dropdown li {
      border-bottom: 1px solid rgba(112, 128, 144, 0.1);
    }

    .v-select .dropdown li:last-child {
      border-bottom: none;
    }

    .v-select .dropdown li a {
      padding: 10px 20px;
      width: 100%;
      font-size: 1.25em;
      color: #3c3c3c;
    }

    .v-select .dropdown-menu .active > a {
      color: #fff;
    }


</style>