<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$eveid = $_GET["id"];




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

?>
<div class="container row mx-auto my-5  bg">
    <h1 class=" row justify-content-around mx-auto mb-4  heading" >Registration</h1>
    <div class="container col ">
        <h3>Event Name :- </h3>
        <div class="">
        <form class="align-items-stretch" action="functions.php" method="POST">
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Name</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="Rahul dube" required>
</div>
    <div class="mb-3">
  <label for="exampleFormControlInput2" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput2" name="email" placeholder="rahul@example.com" required>
</div>
<input hidden name="eveid" value="<?php echo $eveid ?>" required>
<button type="submit" name="registerevent">Submit</button>
<!-- <img src="assets/images/logo.png" height="100px" alt=""> -->
</form>
</div>
    </div>
    <div class="container-fluid col" style=" object-fit:contain; height:fit-content "> <img src="assets/images/back.jpg" alt=""></div>
</div>




   <?php 
   include "assets/footer.php";
  
   ?>
</body>
</html>