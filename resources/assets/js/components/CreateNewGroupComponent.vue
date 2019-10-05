<template>
	<div>
    <div class="form-group">
      <input type="text" v-model='groupname' class="form-control" placeholder="Group Name..." required>
    </div>
		 <v-select label="user_name" :options="allcontacts" multiple v-model="selected" placeholder="Select Members..." required>
            <template slot="option" slot-scope="option">
              <div class="d-center">
                <img :src='imgPreUrl+option.avatar'/> 
                {{ option.user_name }}
                </div>
            </template>
        </v-select>
		    <br>
        <div class="form-group">
          <input type="file" id="files" ref="files" class="form-control" v-on:change="handleFileUploads($event.target.files)" accept="image/*"/>
        </div>
         <div class="form-group text-right">
           <button class="btn btn-success " v-on:click="createGroups()">Create Group</button>
         </div>
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
      	selected:[],
      	selectedUserIds:'',
        formData: new FormData(),
        imgPreUrl:'img/staff/',
        defaultImg :'default_avatar_male.jpg',
        groupname:'',
        validateimage:false
      }
    },

    methods: {
      createGroups(){
          var loading = $(".chat-data-loading");
          loading.fadeIn();
      	    for (var i = 0; i < this.selected.length; i++) {
      	    	this.selectedUserIds = this.selectedUserIds.concat(this.selected[i].user_id);
      	    	this.selectedUserIds = this.selectedUserIds.concat(',');
      	    }

          // if(!this.validateimage){
          //   alert('Only Image Allowed!');
          //   return;
          // }
          if(this.groupname =='' || this.selectedUserIds ==''){
            alert('Please Fill Out the form!');
            return;
          }
          this.formData.append('ids',this.selectedUserIds);
      		this.formData.append('groupname',this.groupname);
      		this.selected = [];
      		this.selectedUserIds='';
            axios.post( 'create-chat-groups',
                this.formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then(function(){
              this.$emit('newUserAdded', 'Abc');
            })
        	 .catch(function(){});
           $('#createGroupModel').modal('hide');
           this.$emit('newUserAdded', 'added');

      },
      handleFileUploads(fileList){
        if(fileList[0].type.indexOf("image")){
          this.validateimage = false;
        }else{
          this.validateimage = true;
          this.formData.append("logo", fileList[0], fileList[0].name);
        }
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