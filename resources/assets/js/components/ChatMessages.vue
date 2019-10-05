<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            

        <div class="item">
                <img v-bind:src="'/img/staff/' + message.createdby.avatar" /> 

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ message.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a")}} </small>
                    {{ message.createdby.fname }} {{ message.createdby.lname }} 
                  </a>
                  {{ message.message }}
                </p>

              </div>

        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages']
  };
</script>  