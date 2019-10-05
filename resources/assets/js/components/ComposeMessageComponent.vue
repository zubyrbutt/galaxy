<template>
    <div class="type_msg">
      <form ref="fileform">
        <div class="dragplace" style="display: none;">
            <h2>Drag Your File Here</h2>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input_msg_write">
                        <!--<input type="text" class="write_msg" v-model="message" @keydown.enter="send" placeholder="Type a message"/>-->
                        <textarea class="form-control" v-model="message" @keydown.enter.exact="send" rows="3"  placeholder="Type a message"></textarea>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button class="msg_send_btn" @click="send" type="button">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                    <img src="img/selectattachment.png" style="width: 40px; height: 40px;" onclick="document.getElementById('files').click()">
                    <img src="https://cdn.shopify.com/s/files/1/1061/1924/products/Slightly_Smiling_Face_Emoji_87fdae9b-b2af-4619-a37f-e484c5e2e7a4_large.png?v=1480481059" style="width: 30px;" data-toggle="collapse" data-target="#demo">
                </div>
            </div>
            
            <input style="visibility: hidden;" type="file" id="files" ref="files" v-on:change="handleFileUploads($event.target.files)"/>
            <!-- <button class="sendFile" @click="sendFile">Send File</button> -->
        </form>
        <div class="fileuploadingloding" style="display: none;">
            <h1>{{uploadPercentage}}%</h1>
            <progress max="100" :value.prop="uploadPercentage"  class="progressbar"></progress>
        </div>

        <div id="demo" class="collapse">
            <picker class="emoji-picker" set="facebook" @select="addEmoji"/>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            contactSelect:{
                type: Object,
                default: null
            }
        },
        data() {
            return {
                message: '',
                formData: new FormData(),
                uploadPercentage:0,
                file_name:'',
                files: [],
                dragAndDropCapable: false,
            };
        },
        mounted(){

              this.dragAndDropCapable = this.determineDragAndDropCapable();
              if( this.dragAndDropCapable ){
                   
                    ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach( function( evt ) {
                      
                      this.$refs.fileform.addEventListener(evt, function(e){
                        e.preventDefault();
                        e.stopPropagation();
                      }.bind(this), false);
                    }.bind(this));
                    var dragTimer;
                    $(document).on('dragover', function(e) {
                      var dt = e.originalEvent.dataTransfer;
                      var data = e.originalEvent.dataTransfer.files[0];
                      if (dt.types && (dt.types.indexOf ? dt.types.indexOf('Files') != -1 : dt.types.contains('Files'))) {
                        $(".dragplace").show();
                        window.clearTimeout(dragTimer);
                      }
                    });

                    this.$refs.fileform.addEventListener('dragleave', function(e){
                        $('.dragplace').hide();
                    })
                    
                    this.$refs.fileform.addEventListener('drop', function(e){
                        let file = e.dataTransfer.files[0];
                        this.message = e.dataTransfer.files[0].name;
                        this.file_name = e.dataTransfer.files[0].name;
                        this.formData.append('file', file);
                        $('.write_msg').focus();
                        $('.dragplace').hide();
                        // console.log(file);
                        this.sendFile();
                      // for( let i = 0; i < e.dataTransfer.files.length; i++ ){
                      //   this.files.push( e.dataTransfer.files[i] );
                       
                      // }
                    }.bind(this)); 
                     
                  }
        },
        methods: {
            determineDragAndDropCapable(){
                var div = document.createElement('div');
                return ( ( 'draggable' in div )
                        || ( 'ondragstart' in div && 'ondrop' in div ) )
                        && 'FormData' in window
                        && 'FileReader' in window;
              },
              send(e) {
                e.preventDefault();
                if (this.message === '') {
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
                
                var audio = new Audio('audio/sendmessage.mp3');
                audio.play();
            },

            sendFile(){
                $('.fileuploadingloding').show();
                this.formData.append("room_id", this.contactSelect.room_id);
                axios.post( 'sendMessage',
                    this.formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function( progressEvent ) {
                      this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
                    }.bind(this),
                  }).then((response) =>{
                    this.message = '';
                    this.file_name='';
                    $("#files").val(null);
                  
                    var audio = new Audio('audio/sendmessage.mp3');
                    audio.play();
                    $('.fileuploadingloding').hide();
                })
                .catch(function(){});
            },

            handleFileUploads(fileList){
                $('.write_msg').focus();
                this.file_name = fileList[0].name;
                this.message = fileList[0].name;
                this.formData.append("file", fileList[0], fileList[0].name);
                // $('.progressbar').show();
                this.sendFile();
            },
            addEmoji(emoji){
                $('.write_msg').focus();
                this.message = this.message+ ' ';
                this.message = this.message+emoji.native;
            }
        }
    }

</script>

<style scoped>
    .progressbar{
        width: 100%;
        background: #0465ac !important; 
    }
    .emoji-picker{
        width: 100% !important;
        /*position: fixed;
        right: 0;
        bottom: 0;*/
    }
    .dragplace{
         background-color: #8080806b; 
         width: 100%;height: 100%;
         position: absolute;
         text-align: center;
         line-height: 300%;
         font-size: 20px;
         color: black;
    }
    .dragplace h2{
        margin-top: 85px;
    }
</style>