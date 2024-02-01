<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "links.php";
    ?>
    <title>Forgot Password</title>
</head>
<body>
<?php
include "assets/dbcon.php";
include "assets/nav.php";
?>
<div class="container" id="forgot-container" >
    <form id=forgot-in action="functions.php" method="POST">
        <h1 align="center">Get Your Password Back</h1>
        
        <input type="text" name="email" placeholder="Email">
        <input id="f_pass" type="hidden" name="password " placeholder="Email">
        <input id="f_pass" type="hidden" name="password" placeholder="Email">
        <span>or use your email for registration</span><br>
        <button name="forgot">Submit</button>
    </form>
</div>
</body>
</html>

<!-- const button = document.querySelector('button');
const attributeName = button.getAttribute('name');
button.setAttribute('name', 'new-name');

document.getElementById("id_of_tag_to_be_changed").type="text"; -->