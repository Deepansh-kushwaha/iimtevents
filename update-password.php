<?php
session_start();
$token = $_GET['token'];
if(isset( $_COOKIE["uid"])&&isset($_COOKIE["ftoken"])){
$id= $_COOKIE["uid"];
$ctoken =$_COOKIE["ftoken"];
if($token!=$ctoken){
   header('location: forgot.php');
}
}else{
    echo"token expired";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include "links.php"?>
    
    <title>IIMTevents.com</title>
</head>
<body>
<?php
include "assets/dbcon.php";

include "assets/nav.php";

?>
   <div class="container" id="forgot-container" >
    <form id=forgot-in action="functions.php" method="POST">
        <h1 align="center">Enter New Password </h1>
        
        <input  type="hidden" name="id" value=<?php if(isset($_COOKIE['uid'])){echo $id ;} ?> >
        <input id="f_pass" name="password" placeholder="Password">
        <input id="f_pass" name="cpassword" placeholder="Confirm Password">
        <span>password shoud be b/w 6 to 15 elements </span><br>
        <button name="update">Submit</button>
    </form>
</div>
</body>
</html>