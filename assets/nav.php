<?php if (isset($_SESSION['username'])) {

    $li_view= "hidden"; 
    $lo_view= ""; 
}else{
    $li_view="";
    $lo_view= "hidden"; 
  
}
?>
<div class="nav-container">
<style>
    .logo{
        border-radius:50% ;
       
    }
</style>
<a href="index.php"><img class="logo" src="assets/images/logo.png" width="70px" height="70px" alt=""></a>
    <!-- <h1 style="color: white;">IIMTEvents</h1> -->
    <div class="navList">
        <a id="navlinks" href="index.php">Home</a>
        <a id="navlinks" href="events.php">Events</a>
        <a id="navlinks" href="leaderboard.php">Leaderboard</a>
        <a <?php echo $li_view ?> href="login.php"><button class="nav-button">Login/Signup</button></a>
 <div <?php echo $lo_view ?>  class="dropdown">
        <i  style="padding: 5px; font-size:20px; color:white;" class="fa-regular fa-user-circle  dropbtn"></i>
  <div class="dropdown-content">
    <a href="profile.php"><i class="fa-solid fa-user-tie"></i> Profile</a>
    <a href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
  </div>
</div>
    </div>
</div>