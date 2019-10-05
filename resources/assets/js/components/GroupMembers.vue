<template>
	<div>
        <ul class="list-group">
		  <li v-for="members in groupmembers" class="list-group-item">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<h4>{{ members.user_name }}</h4>
		  		</div>
		  		<div class="col-md-4 text-right">
		  			<img :src="imgPreUrl + members.avatar" alt="">
		  		</div>
				<div v-show="authuser == selectedContact.createdby" class="col-md-2 text-right">
					<button  class="btn btn-danger" @click="removemember(members)"><i class="fa fa-minus"></i></button>
				</div>
		  	</div>
		  </li>
		</ul>
		<div v-if="group_permission===1">
		<h1>Add User To Group</h1>
		<v-select label="user_name" :options="allcontacts" multiple v-model="selected">
            <template slot="option" slot-scope="option">
              <div class="d-center">
                <img :src='imgPreUrl+option.avatar'/> 
                {{ option.user_name }}
                </div>
            </template>
        </v-select>
		<button class="btn btn-success" @click="addNewMembersToGroup">Done</button>
		</div>
	</div>
</template>

<script>
	export default{
		props:{
			groupmembers:{
            	type: Array,
            	default: null
            },
            allcontacts: {
                type: Array,
                default: []
            },
			group_permission: {
				type: Number,
				default: 0
			},
			selectedContact: {
				type: Object,
				default: null
			}
		},
		data(){
			return {
				imgPreUrl:'img/staff/',
                defaultImg :'default_avatar_male.jpg',
                selectedUserIds:'',
                selected:[],
                group_id:'',
				authuser:null
			}
		},
		mounted(){
			 this.authuser = document.head.querySelector('meta[name="user-id"]').content;
		},
		methods:{
            addNewMembersToGroup(){

            	for (var i = 0; i < this.selected.length; i++) {
	      	    	this.selectedUserIds = this.selectedUserIds.concat(this.selected[i].user_id);
	      	    	this.selectedUserIds = this.selectedUserIds.concat(',');
	      	    }

                axios.post('addNewMembersToGroup', {
                    room_id : this.groupmembers[0].room_id,
                    selectedUserIds : this.selectedUserIds
                });

                this.selected = [];
      			this.selectedUserIds='';
				this.$emit('updatemembers',  this.groupmembers[0].room_id);

            },
			removemember(members){
				axios.post('removememberfromgroup', {
					room_id : members.room_id,
					user_id : members.user_id
				});
				this.$emit('updatemembers',  members.room_id);

			}
        }
		
	}
</script>
<style scoped>
    
    img {
      height: 5.5rem;
      max-width: 5.5rem;
      margin-right: 1rem;
      border-radius: 50%;
    }

    .d-center {
      display: flex;
      align-items: center;
    }

    .selected img {
      width: auto;
      max-height: 35px;
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