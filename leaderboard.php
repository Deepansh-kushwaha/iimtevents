<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php
     include "links.php";
     include "assets/dbcon.php";
     include "assets/ajax.php";
    ?>
    
    <title>leaderboard</title>
</head>
<body>
<?php
include "assets/nav.php";
?><div class="bg">
    <h1 align="center" style="color: #9E73CE;" class="heading">LEADER BOARD</h1>
    <br>
<div class="container p-1">
<table class="table table-striped text-center">
                      <tr>
                        <th>No</th>
                        <th>Event Name</th>
                        <th>Description</th>
                        <th>Image</th>

                        <th>Toggle</th>
                        
                      </tr>
                      <tbody id="leader">
                     
                     <script>
                             $(document).ready(function(){
                 leader();
             });
                     </script>
                     
                               </tbody>
                    
                    </table>
                

</div>
</div>
   <?php 
   include "assets/footer.php";
   ?>
</body>
</html>