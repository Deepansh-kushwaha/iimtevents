<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location:login.php');
  $username = $_SESSION['username'];
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include "assets/dbcon.php";
  include "links.php";
  include "assets/ajax.php";
  ?>
    <title>Profile</title>
    <style>
        .background{
            background: pink;
            height: 50vh;
        }
    </style>
</head>
<body>
    <div class="background">
<?php

include "assets/nav.php";
?>
<center>
    <br><br><br>
<h1 class="heading">PROFILE</h1>
<i class="fa-solid fa-pen editico" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="functions.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="chosefile" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="editimage">Save changes</button>
        </form>

      </div>
    </div>
  </div>
</div>
<?php 
 $p=  $_SESSION['username'];
   $sql1 = mysqli_query($con,"SELECT * FROM `registration` WHERE email = '$p'");
   $run1 = mysqli_fetch_array($sql1);
   $image = $run1['profileimg'];
?>
<div class="profile-img"><img src="<?php echo $image ?>" alt="no image"></div></center>
</div>
<br><br><br><br><br>
    <div class="card">
        <div class="cont1">
            <h2>Details</h2>
       <div class="p-5">
                <h5>Name:</h5>
                <p>Deepansh kushwaha</p>
                <h5>Age:</h5>
                <p>19</p>
                <h5>Location:</h5>
                <p>Meerut</p>
            <div class="social-container">
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            </div>
        </div>
        <div class="cont2">
            <h2>Description</h2>
          <div class="p-5">
                <h5>About me: </h5>
                <p align="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente et odio nihil quidem, tempora repellat expedita dolor maxime, blanditiis obcaecati modi ad veniam repellendus?</p>
                <div class="btns">
                <button><a href="contact.php" class="contactbtn">Edit </a></button>
                <button><a href="contact.php" class="contactbtn">Contact Me</a></button>
        </div>
        </div>
        </div>
    </div>
</body>
</html>