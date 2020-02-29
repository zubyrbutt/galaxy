<!-- REQUIRED JS SCRIPTS -->


<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Sweet Alert JS -->
<script src="{{ asset('js/sweetalert.min.js') }}" defer></script>

<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>

<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
 
        <!-- Bootstrap -->
       <!-- <script src="../../js/bootstrap.min.js" type="text/javascript"></script>-->
        <!-- AdminLTE App -->
        <!--<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>-->
        <!-- CK Editor -->
        <script src="{{ asset('bower_components/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <!-- page script -->
@if (\Request::is('admins') or \Request::is('roles')  or \Request::is('projects') or \Request::is('categories') or \Request::is('menu') or \Request::is('customers') or \Request::is('leads') or \Request::is('callbackfilter')  or \Request::is('appointmentfilter')  or \Request::is('allappointments')  or Route::currentRouteName()=='leads.show' or \Request::is('recordings') or Route::currentRouteName()=="appointments.index" or Route::currentRouteName()=="appointments" or Route::currentRouteName()=="callbacks" or Route::currentRouteName()=="recordings.index" or Route::currentRouteName()=="recordings"  or Route::currentRouteName()=="tasks" or \Request::is('dashboard') or Route::currentRouteName()=='leads.search' or Route::currentRouteName()=='callbacksearch'or Route::currentRouteName()=='expo-show' or \Request::is('chapters') or \Request::is('topics') or Route::currentRouteName()=="departments" or Route::currentRouteName()=="leads.indexmain"  or Route::currentRouteName()=="teacher_course.index" or Route::currentRouteName()=="teacher_timing.index" or Route::currentRouteName()=="parents.studentformparent" or Route::currentRouteName()=="daily_schedule.index" or Route::currentRouteName()=="daily_schedule.search" or Route::currentRouteName()=="daily_schedule.classDetails" or Route::currentRouteName()=="daily_schedule.classDetailsSearch" or Route::currentRouteName()=="invoice.index" or Route::currentRouteName()=="invoicelist.index"  or Route::currentRouteName()=='invoicelist.indexSearch'  or Route::currentRouteName()=="schedule.index")
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

  <script>
    $(function () {
      $('#example1').DataTable( {
        "order": [[ 0, "desc" ]]
      });
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      });
      $('#example3').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
    		"scrollX": true
      });
    })
  </script>
@endif
@if (Route::currentRouteName()=='leads.show')
  <script>
      $(function () {
        $('#nofeatures').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      });
      $(function () {
        $('#nofeaturesapp').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      });
      $(function () {
        $('#nofeaturesdocs').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      });
      $(function () {
        $('#nofeaturesproposal').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      }); 
    </script> 
@endif
@if (Route::currentRouteName()=='admins.show' or Route::currentRouteName()=='customers.show' or Route::currentRouteName()=="profile")
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script>
      $(function () {
        $('#loginlogs').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        }),
        $('#attlogs').DataTable({
          'paging'      : false,
          'lengthChange': true,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : true
        })
      });
    </script> 
@endif


@if(\Request::is('admins')  or \Request::is('categories') or \Request::is('projects') or \Request::is('menu') or \Request::is('roles') or \Request::is('customers') or \Request::is('leads') or Route::currentRouteName()=='leads.search' or \Request::is('topics')  or \Request::is('teacher_course'))
<script>
  function archiveFunction(formid) {
    event.preventDefault(); // prevent form submit
      
    swal({
            title: "Delete",
            text: "Are you sure want to delete?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('#'+formid).submit();
          } 
        });
      

    }
</script>  
@endif

@if (\Request::is('profile') or \Request::is('admins/create') or Route::currentRouteName()=='admins.edit' or \Request::is('categories/create') or Route::currentRouteName()=='categories.edit' or Route::currentRouteName()=='customers.edit'   or \Request::is('customers/create'))
<script src="{{ asset('js/fileinput.min.js') }}"></script>
  <script>
  @if(Route::currentRouteName()=='admins.edit' or \Request::is('profile') or Route::currentRouteName()=='customers.edit')
      var avatarName="{{ asset ('img/staff/'.$user->avatar)}}";
    @else
    var avatarName='{{ asset ('img/placeholder.png') }}';
    @endif

  $("#avatar-1").fileinput({
      overwriteInitial: true,
      maxFileSize: 1000,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseOnZoneClick: true,
      browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
      removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      defaultPreviewContent: '<img src="'+ avatarName +'" alt="Avatar" width="100%">',
      layoutTemplates: {main2: '{preview} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"]
  });
  </script>
@endif
@if (\Request::is('dashboard'))  
<script>
  $(function () {
    $('#nofeaturesproposal').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  }); 
</script> 
@endif
<script>
$('a[data-notif-id]').hover(function () {

var notif_id   = $(this).data('notifId');
var targetHref = $(this).data('href');
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.post('/readnofication', {'id': notif_id}, function (data) {
    data.success ? (console.log('Done')) : false;
    //data.success ? (window.location.href = targetHref) : false;

});

return false;
});




{{-- // @if( $bduser->staffdetails->dob->format('m-d') === date('m-d')) --}}
// /* birthday code JS -raheel */

// // helper functions
// const PI2 = Math.PI * 2
// const random = (min, max) => Math.random() * (max - min + 1) + min | 0
// const timestamp = _ => new Date().getTime()

// // container
// class Birthday {
//   constructor() {
//     this.resize()

//     // create a lovely place to store the firework
//     this.fireworks = []
//     this.counter = 0

//   }
  
//   resize() {
//     this.width = canvas.width = window.innerWidth
//     let center = this.width / 2 | 0
//     this.spawnA = center - center / 4 | 0
//     this.spawnB = center + center / 4 | 0
    
//     this.height = canvas.height = window.innerHeight
//     this.spawnC = this.height * .1
//     this.spawnD = this.height * .5
    
//   }
  
//   onClick(evt) {
//      let x = evt.clientX || evt.touches && evt.touches[0].pageX
//      let y = evt.clientY || evt.touches && evt.touches[0].pageY
     
//      let count = random(3,5)
//      for(let i = 0; i < count; i++) this.fireworks.push(new Firework(
//         random(this.spawnA, this.spawnB),
//         this.height,
//         x,
//         y,
//         random(0, 260),
//         random(30, 110)))
          
//      this.counter = -1
     
//   }
  
//   update(delta) {
//     ctx.globalCompositeOperation = 'hard-light'
//     ctx.fillStyle = `rgba(20,20,20,${ 7 * delta })`
//     ctx.fillRect(0, 0, this.width, this.height)

//     ctx.globalCompositeOperation = 'lighter'
//     for (let firework of this.fireworks) firework.update(delta)

//     // if enough time passed... create new new firework
//     this.counter += delta * 3 // each second
//     if (this.counter >= 1) {
//       this.fireworks.push(new Firework(
//         random(this.spawnA, this.spawnB),
//         this.height,
//         random(0, this.width),
//         random(this.spawnC, this.spawnD),
//         random(0, 360),
//         random(30, 110)))
//       this.counter = 0
//     }

//     // remove the dead fireworks
//     if (this.fireworks.length > 1000) this.fireworks = this.fireworks.filter(firework => !firework.dead)

//   }
// }

// class Firework {
//   constructor(x, y, targetX, targetY, shade, offsprings) {
//     this.dead = false
//     this.offsprings = offsprings

//     this.x = x
//     this.y = y
//     this.targetX = targetX
//     this.targetY = targetY

//     this.shade = shade
//     this.history = []
//   }
//   update(delta) {
//     if (this.dead) return

//     let xDiff = this.targetX - this.x
//     let yDiff = this.targetY - this.y
//     if (Math.abs(xDiff) > 3 || Math.abs(yDiff) > 3) { // is still moving
//       this.x += xDiff * 2 * delta
//       this.y += yDiff * 2 * delta

//       this.history.push({
//         x: this.x,
//         y: this.y
//       })

//       if (this.history.length > 20) this.history.shift()

//     } else {
//       if (this.offsprings && !this.madeChilds) {
        
//         let babies = this.offsprings / 2
//         for (let i = 0; i < babies; i++) {
//           let targetX = this.x + this.offsprings * Math.cos(PI2 * i / babies) | 0
//           let targetY = this.y + this.offsprings * Math.sin(PI2 * i / babies) | 0

//           birthday.fireworks.push(new Firework(this.x, this.y, targetX, targetY, this.shade, 0))

//         }

//       }
//       this.madeChilds = true
//       this.history.shift()
//     }
    
//     if (this.history.length === 0) this.dead = true
//     else if (this.offsprings) { 
//         for (let i = 0; this.history.length > i; i++) {
//           let point = this.history[i]
//           ctx.beginPath()
//           ctx.fillStyle = 'hsl(' + this.shade + ',100%,' + i + '%)'
//           ctx.arc(point.x, point.y, 1, 0, PI2, false)
//           ctx.fill()
//         } 
//       } else {
//       ctx.beginPath()
//       ctx.fillStyle = 'hsl(' + this.shade + ',100%,50%)'
//       ctx.arc(this.x, this.y, 1, 0, PI2, false)
//       ctx.fill()
//     }

//   }
// }

// let canvas = document.getElementById('birthday')
// let ctx = canvas.getContext('2d')

// let then = timestamp()

// let birthday = new Birthday
// window.onresize = () => birthday.resize()
// document.onclick = evt => birthday.onClick(evt)
// document.ontouchstart = evt => birthday.onClick(evt)

//   ;(function loop(){
//   	requestAnimationFrame(loop)

//   	let now = timestamp()
//   	let delta = now - then

//     then = now
//     birthday.update(delta / 1000)
  	

//   })();
{{-- // @endif --}}
</script>
