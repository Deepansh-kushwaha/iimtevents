<script type="text/javascript">
    $(document).ready(function() {
    //     $('#btnclick').click(function() {
    //         $.get('txt.txt', function(data, status) {
    //             $('#changehere').html(data);
    //             alert(status);
    //         });
    //     });

        // $('.btnclick').click(function() {
        //     $.post('post.php', {
        //         name :"ThpaTechnical",
        //         subs : "subscribe"
        //     }, function(data, status) {
        //         $('#changehere').html(data);
        //         alert(status);
        //     });
        // });

// to be used 
    function getuserdetail(refid){
        $('#edituser').val(refid);
            $.post('post.php', {
               id:id
            }, function(data, status) {
                var user = JSON.parse(data);
                $('user_firstname').val(user.name);
            });
        }
        });

    // to toggle the pop up in cpannel 
   function toggle(ref) {
               switch(ref){
                case addusr:
            var di = document.getElementById('addusr');
            di.classList.toggle('active');
                    break;
                case addadmin:
            var di = document.getElementById('addadmin');
            di.classList.toggle('active');
                    break;
                case addeve:
            var di = document.getElementById('addeve');
            di.classList.toggle('active');
                    break;
                case editeve:
            var di = document.getElementById('editeve');
            di.classList.toggle('active');
                    break;
                    default :


               }   
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');    
        var blur = document.getElementById('popup');
        blur.classList.toggle('active');
        
}      



// to go back to pre page 
function goBack() {
window.history.back();

}




// to fetch the users in cpannel
function readrecord(){
    var readrecord = "readrecord";
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : {readrecord : readrecord },
        success:function(data,status){
            $('#usertable').html(data);
        }
    });
}
// to fetch the admins in cpannel 
function readrecords(){
    var readrecords = "readrecord";
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : {readrecords : readrecords },
        success:function(data,status){
            $('#admintable').html(data);
        }
    });
}
// to fetch the event in cpannel 
function eventrecords(){
    var eventrecord = "eventrecord";
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : {eventrecord : eventrecord },
        success:function(data,status){
            $('#evetable').html(data);
        }
    });
}
// to delete a user in cpannel 
function deleterecord(id){
    var conf = confirm("Are you sure"); 
    if(conf == true){
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : {delrecords : id },
        success:function(data,status){
         alert("deleted");
         readrecord();
         readrecords();
        }
    });
}
}
// to fetch the events in detail in events page
function readevent(id){
    var blur = document.getElementById('blur2');
            blur.classList.toggle('active');    
        var blur = document.getElementById('eventpop');
        blur.classList.toggle('active');
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : {readevent : id },
        success:function(data,status){
            $('#evepopinside').html(data);
        }
    });
}

     
function readeventclose(){
    var blur = document.getElementById('blur2');
            blur.classList.toggle('active');    
        var blur = document.getElementById('eventpop');
        blur.classList.toggle('active');
   
        
}


// to fetch events in event page
function displayevent(){
    var displayevent ="displayevent"
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : { displayevent:displayevent},
        success:function(event,status){
            $('#eventlist').html(event);
        }
    });
}
// to display events in home page 
function displayevents(){
    var displayevents ="displayevents"
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : { displayevents:displayevents},
        success:function(event,status){
            $('#eventlist').html(event);
        }
    });
}


// to delete a event in cpannel 
function deleteevent(id){
    var conf = confirm("Are you sure"); 
    if(conf == true){
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : {delevent : id },
        success:function(data,status){
         alert("deleted");
         eventrecords();
        }
    });
}
}

// to add user for cpannel 

    var form = $('#myform');
$('#addusrbtn').click(function() { 
$.ajax({
url: form.attr("action"),
type: 'post',
data: $("#myform input").serialize(),
success: function(data,status) {
    $('#myfom').reset();
console.log(data);
if(status == "success"){
    alert("good");
}
}
});
});



// for the leader board 
function leader(){
    var leader ="leader";
    $.ajax({
        url: 'functions.php',
        type : 'POST',
        data : { leader:leader},
        success:function(event,status){
            $('#leader').html(event);
        }
    });

}




    function myfun() {
        $name = "deepansh";
        $subs ="subscribe";
$.ajax({
url: 'post.php',
type: 'POST',
data: { name : $name, subs: $subs },
success: function(result){
$('#changehere').html(result);
}
});
}

</script>