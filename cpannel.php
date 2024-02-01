<?php

session_start();
include "assets/dbcon.php";
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
else{
    $mail = $_SESSION['username'];
    $role = mysqli_query($con, selectdb("email = '$mail'"));
    $roleexist = mysqli_num_rows($role);
    if($roleexist > 0){
        $is_admin = mysqli_fetch_assoc($role);
        if($is_admin['role'] != 1){
            header('location:login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include "links.php";
     include "assets/ajax.php";
     ?>
    
    <title>IIMTevents.com</title>
    <style>
        	body {
			background: #f6f5f7;
			display: flex;
			justify-content: center;
			justify-items: center;
			align-items: center;
			flex-direction: column;
			/* font-family: 'Montserrat', sans-serif; */
			/* height: 100vh; */
			margin: -80px 0 ;
		}
    </style>
</head>
<body>
   
<script>
        var addusr = "adduser";
        var addadmin = "addadmin";
        var addeve = "addeve";
        var editeve = "editeve";
</script>

<div class="contain " id="blur">
    <div class="menu">
        <div id="top-buttons"> 
            <a href="index.php"><i style="padding: 5px; font-size:20px;" class="fa-solid fa-house-chimney-user"></i></a>
            <div class="dropdown">
        <i  style="padding: 5px; font-size:20px;" class="fa-solid fa-user-circle  dropbtn"></i>
  <div class="dropdown-content">
    <a href="profile.php"><i class="fa-solid fa-user-tie"></i> Profile</a>
    <a href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
  </div>
</div>
        </div>
        <h2 align="center" style="	font-weight: bold; margin: 0;" >IIMT EVENTS</h2>
        <div class="nav-list">
            <a class="nav-item elemactive" onclick="changeindicator(this)" href="#home"><i class="fa-solid fa-house-laptop"></i> Home</a>
            <a class="nav-item " onclick="changeindicator(this)" href="#user"><i class="fa-solid fa-users"></i> user</a>
            <a class="nav-item " onclick="changeindicator(this)" href="#admin"><i class="fa-solid fa-user-tie"></i> admin</a>
            <a class="nav-item " onclick="changeindicator(this)" href="#events"><i class="fa-solid fa-calendar-days"></i> events</a>
            <a class="nav-item " onclick="changeindicator(this)" href="#winner"><i class="fa-solid fa-trophy"></i> winner</a>
        </div>
    </div>
    <div class="pane " >
        <?php 
        function selectdb($s_where)
        {
            $existSql = "SELECT * FROM `registration` WHERE   $s_where";
            return $existSql;
        }
        function selectdbb()
        {
            $existSql = "SELECT * FROM `registration` ";
            return $existSql;
        }
        $where = "1";
        $user = mysqli_query($con, selectdbb());
        $userexist = mysqli_num_rows($user);
        $admin = mysqli_query($con, selectdb("role = '1'"));
        $adminexist = mysqli_num_rows($admin);
        $faculty = mysqli_query($con, selectdb("role = '2'"));
        $facultyexist = mysqli_num_rows($faculty);
        ?>
        <div class="cp-content " id="home">
            <br>
            <h1 align="center"> HOME</h1>
                <br>
            <div class="home-top">
                <div class="top-elem" style="background-color:#ff5c5c;">
                    <h3 id=btnclick> Total Users</h3>
                    <h1> <?php  echo $userexist ?></h1>
                </div>
                <div class="top-elem btnclick"  style="background-color:#fefe00;">
                    <h3> Total Admins</h3>
                    <h1 id=changehere><?php  echo $adminexist ?></h1>
                </div>
                <div class="top-elem"  style="background-color:#1776f3;">
                    <h3> Total Faculty</h3>
                    <h1><?php  echo $facultyexist ?></h1>
                </div>
            </div><br><br>
            <!-- <div class="home-top bottom"> 
            <div class="top-elem">
                    <h3 > Active Events</h3>
                    <h1> <?php  echo $userexist ?></h1>
                </div>
                <div class="top-elem btnclick">
                    <h3> Messages</h3>
                    <h1 id=changehere><?php  echo $adminexist ?></h1>
                </div>
                <div class="top-elem">
                    <h3>Today's Winner </h3>
                    <h1><?php  echo $facultyexist ?></h1>
                </div>    
            </div> -->
        </div>
        <?php 
          $userlist = mysqli_fetch_assoc($user); 
          
        ?>
        <div class="cp-content" id="user">
            <br>
            <h1 align="center"> USER LIST </h1>
            <i class="btn btn-warning my-1 fa-solid fa-plus" onclick=" toggle('' + addusr + '');" > Add User</i>
                <br>
                <div class="table-content">
                <table class="table table-striped text-center">
                      <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Role</th>
                        <th scope="col">Toggle</th>
                        </tr>
                      </thead>
                      <tbody id="usertable">
                     
            <script>
                    $(document).ready(function(){
        readrecord()
    });
            </script>
            
                      </tbody>
                    </table>
                </div>
           
        </div>
        <div class="cp-content" id="admin">
        <br>
            <h1 align="center"> ADMIN LIST </h1>
            <i class="btn btn-warning my-1 fa-solid fa-plus" onclick="toggle(''+ addusr +'')"> Add admin</i>
                <br>
                <div class="table-content">
                <table class="table table-striped text-center">
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Role</th>
                        <th>Toggle</th>
                        
                      </tr>
                      <tbody id="admintable">
                     
                     <script>
                             $(document).ready(function(){
                 readrecords()
             });
                     </script>
                     
                               </tbody>
                    
                    </table>
                </div>
        </div>
        <div class="cp-content" id="events"> <br>
            <h1 align="center" > EVENTS LIST </h1>
            <i class="btn btn-warning my-1 fa-solid fa-plus" onclick="toggle(''+ addeve +'')"> Add event</i>
                <br>
                <div class="table-content">
                <table class="table table-striped text-center">
                      <tr>
                        <th>NO</th>
                        <th>Event Name</th>
                        <th>Description</th>
                        <th>Image</th>

                        <th>Toggle</th>
                        
                      </tr>
                      <tbody id="evetable" class="evetable">
                     
                     <script>
                             $(document).ready(function(){
                 eventrecords();
             });
                     </script>
                     
                               </tbody>
                    
                    </table>
                </div>
            </div>
        <div class="cp-content" id="winner">
        <br>
            <h2 align="center"> HOME</h2>
                <br>
            <div class="home-top">
                <div class="listing top-elem"> 
                    <img src="assets/images/home.png" width="20%"  alt="winner img ">
                    <h3 id=btnclick> winner name </h3>
                    <h4 id=btnclick> event name </h4>
                    
                </div>
            </div>
           
        </div>
    </div>
  </div>
<div id="popup">
    <div id="addusr" class="addusr">
        <span><i class="fa-solid fa-circle-xmark closeicn" onclick="toggle(''+ addusr +'');"></i></span>
        <form id="myform" action="functions.php" method="POST">
			<h1>Add User</h1>
			<span>Enter the details</span>
			<input type="text" name="username" placeholder="Name" required/>
			<input type="email" name="email" placeholder="Email" required/>
			<input type="phone" name="mobile" placeholder="Moblie" />
            <select id="role" name="role">
    <option id="role" value="0">User</option>
    <option id="role" value="1">Admin</option>
    <option id="role" value="2">Faculty</option>
    
  </select>
			<input type="password" name="password" placeholder="Password"  required/>
			<input type="password" name="cpassword" placeholder="Confirm Password"  required/>
			<button name="addusr" id="addusrbtn">Add</button>
			
		</form>
    </div>
   
    <div id="addeve" class="addeve" >
    <span><i class="fa-solid fa-circle-xmark closeicn" onclick="toggle(''+ addeve +'');"></i></span>
    <form id="myform" action="functions.php" method="POST" enctype="multipart/form-data">
			<h1>Add Event</h1>
			<span>Enter the details</span>
            <input type="file" name="chosefile" placeholder="chose image">
			<input type="text" name="eventname" placeholder="Event Name" required/>
			<textarea name="eventdescription" id="description" cols="20"  placeholder="Description" required></textarea>
			<button name="addeve" id="addevebtn">Add</button>
			
		</form>
    </div>
<?php 
 $p=  $_SESSION['username'];
 $sql1 = mysqli_query($con,"SELECT * FROM `registration` WHERE email = '$p'");
 $run1 = mysqli_fetch_array($sql1);
 $image = $run1['profileimg'];
?>
    <div id="editeve" class="editeve" >
    <span><i class="fa-solid fa-circle-xmark closeicn" onclick="toggle(''+ editeve +'');"></i></span>
    <form id="myform" action="functions.php" method="POST" enctype="multipart/form-data">
			<h1>Edit Event</h1>
			<span>Enter the details</span>
            <input type="file" name="chosefile" value="" placeholder="chose image" required>
			<input type="text" name="eventname" value="" placeholder="Event Name" required/>
			<textarea name="eventdescription" id="description" cols="20" value=""  placeholder="Description" required></textarea>
			<button name="editeve" id="editevebtn">Add</button>
			
		</form>
    </div>
</div>

  <!-- partial -->

  <script>



    function changeindicator(element){
        const menuitems = document.querySelectorAll(".nav-item");
        menuitems.forEach(item => item.classList.remove('elemactive'));
        element.classList.add('elemactive');

    }
  </script>
  <script  src="move.js"></script>
</body>
</html>