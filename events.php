<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include "links.php";
       include "assets/dbcon.php";
       include "assets/ajax.php";
    ?>
    <title>events</title>
</head>
<body>
<?php
include "assets/nav.php";

?><div class="bg">
<div id="blur2">
<i class="fa-solid fa-arrow-left mx-5  " onclick="goBack()"> </i>
<div class="event-container">
<div  style="width:auto;">
  <h1 style="color: #9E73CE;" class="heading">Exciting Events</h1>
  <br>
  <div class="event-list my-5" id="eventlist">
       <script> 
              $(document).ready(function(){
        displayevent()
    });
         </script>
  </div>  

</div>
</div>
</div>
</div>
<div id="eventpop">
    &nbsp; &nbsp; <span ><i style="font-size: 26px;" class="fa-solid fa-circle-xmark " onclick="readeventclose();"></i></span>
    <div class="evepopinside" id="evepopinside" >
</div>
</div>



   <?php 
   include "assets/footer.php";
  
   ?>
</body>
</html>