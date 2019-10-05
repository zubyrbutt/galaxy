<template>
	<div>
	
		<div class="inbox_people" id="inbox_people_list">
			<input class="form-control" placeholder="Search Users" v-model="search" style="border-radius: unset;padding:20px;">
		  <div class="inbox_chat scroll">
				<!-- custom code for close button -->
					<a href="javascript:void(0)" class="closebtn show_on_mobile_only" v-on:click="closeInboxPeopleNav()">&times;</a>
			
				<div v-if="contacts.length > 0">

				<div v-for="contact in filterChatlist" class="chat_list" v-bind:class="{ 'active_chat' :room_id === contact.room_id}" @click="selectContact(contact)">
				  <div class="chat_people" >
					<div class="chat_img" > 
						<img v-if="contact.room_type === 'Normal'" :src="contact.avatar ? imgPreUrl + contact.user_avatar : imgPreUrl + defaultImg">

						<img v-else :src="contact.user_avatar ? GroupimgPreUrl + contact.user_avatar : defaultGroupImg"> 
					</div>
					<div class="chat_ib">

					  <h5>{{contact.roomname}} <span class="chat_date">
						  <!--<p v-if="contact.room_type === 'Normal'" :id="activeStatus + contact.user_id" style="display: none;">{{contact.user_id}}</p>-->
					  	<span v-show="contact.totalMesg>0" class="badge label label-success" :id="room + contact.room_id">&nbsp;{{contact.totalMesg}}</span><!-- {{contact.room_id + '==='+ contact.user_id}} --></span></h5>
					</div>
				  </div>
				</div>
			</div>
			<div v-else>No Active Chats</div>
		  </div>
		</div>

	</div>
</template>
<script>

	export default{
		props: {
            contacts: {
                type: Array,
                default: []
            },

        },
        data(){
        	return{
        		room:'room_',
				activeStatus:'activeStatus_',
        		imgPreUrl:'img/staff/',
        		GroupimgPreUrl:'/storage/chatfiles/',
        		defaultImg :'default_avatar_male.jpg',
        		selected: this.contacts[0],
        		room_id:null,
						defaultGroupImg:'/img/gruopicon.png',
						allcontacts:[],
						usercontactlist:[],
						search:''

        	}
        },
		watch: {
			contacts (n) {
				this.usercontactlist = n;
				this.room_id = n[0].room_id;
			}
		},
		methods:{
			// custom code for the navigation close
			closeInboxPeopleNav(){
				document.getElementById("inbox_people_list").style.width = "0px";
      		},
			selectContact(contact) {
				var loading = $(".chat-data-loading");
				loading.fadeIn();
				// custom code for on click hide people list js
				if(window.screen.availWidth <= 450){
						document.getElementById("inbox_people_list").style.width = "0px";
				}
				this.room_id=contact.room_id;
                this.selected = contact;
                this.$emit('selected', contact);
                axios.post('messagemarkasRead', {
					room_id: contact.room_id
				}).then((response) => {
					this.$emit('new', response.data);
				});
            }
		},
		computed:{
			filterChatlist:function () {
				return this.usercontactlist.filter((contact) => {
					return contact.roomname.toLowerCase().match(this.search);
				});
			}
		}

	}
</script>

<style scoped>
	/* custom code for this contact list component */
	.inbox_people_list{
		width:30%;
	}
	.inbox_chat {
		/*background: #222d32;*/
		/*color: white;*/
	}
	.inbox_chat h5{
		/*color: white;*/
	}
</style>