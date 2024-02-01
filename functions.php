
<?php
session_start();
include "assets/dbcon.php";
// functions 

$url= "login.php";
function selectdb($s_where)
{
    // $existSql = "SELECT * FROM `registration` WHERE   email = '$email'";
    $existSql = "SELECT * FROM `registration` WHERE   $s_where";
    return $existSql;
}
function insertdb($ele, $vlu)
{
    // $insertquerry="INSERT INTO `registration`( `username`, `email`, `password`)  values ('$username','$email','$pass')";
    $insertquerry = "INSERT INTO `registration`( $ele)  values ($vlu)";
    return $insertquerry;
}
function deletedb($d_where)
{
    $deletequerry = "DELETE FROM `registration` WHERE $d_where";
    return $deletequerry;
}
function updatedb($u_ele, $u_vlu)
{
    $updatequerry = "UPDATE `registration` SET $u_ele WHERE $u_vlu";
    return $updatequerry;
}


function run($string)
{
    // for the password check 
    // $ret= "only (@, _ ,$,a-Z,0-9) character are accepted ";
    $regex = preg_match('@_$a-z0-9', 
                                         $string);
    if($regex) {
        if(preg_match('@_$',$string)){
        return 1;
        }
    }
    else{
        return 0;
} 
}

// functions end 

// for signup process//
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    // $mobile=mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    // $cpass=password_hash($cpassword, PASSWORD_BCRYPT);


    $where = "email='$email'";
    $result = mysqli_query($con, selectdb($where));
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {


        echo "email already exists";
        header('Refresh:2; URL='.$url.'');
    } else {
        if ($password === $cpassword) {
            $plen = strlen($password);
            if ($plen < 6 || $plen > 15) {
                echo "Password must be between 6 to 15 character  and only (@,_,$,a-z,0-9) are allowed";
            } else {
                $ele = "`username`, `email`, `password`";
                $vlu = "'$username','$email','$pass'";
                $iquery = mysqli_query($con, insertdb($ele, $vlu));

                if ($iquery) {
?>
                    <script>
                        alert("inserted");
                        
                    </script>
                    
                <?php
                  header('Refresh:2; URL='.$url.'');
                } else {
                ?>
                    <script>
                        alert(" not inserted");
                    </script>
                    
<?php
  header('Refresh:2; URL='.$url.'');
                }

            }
        } else {
            echo "password not matching";
            header('Refresh:2; URL='.$url.'');
        }
    }
}
// signup process ends here  //


// signin process

if(isset($_POST["signin"])){
    // $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $pass = password_hash($password, PASSWORD_BCRYPT);

    $where = "email='$email'";
    $result = mysqli_query($con, selectdb($where));
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows) {
        $db_pass= mysqli_fetch_assoc($result);
        // $db_pass['password']; 
        $user_pass = password_verify($password,$db_pass['password']);
        if($user_pass){
            $_SESSION['username']= $db_pass['email'];
            header('location:index.php');
            // $_SESSION['loggedin']=true;
            // $_SESSION['email']= $db_pass['email'];
            // // $_SESSION['mobile']= $db_pass['mobile'];
            // // $_SESSION['id']= $db_pass['id'];
        }
        else{
            echo"invalid password";
            header('Refresh:2; URL='.$url.'');
        }
    }else{
        echo"invalid email ";
        header('Refresh:2; URL='.$url.'');
    }
}
// signin process ends

// forget process starts


    if(isset($_POST["forgot"])){
        $templatefile ="mailtemp.php";

        $email = mysqli_real_escape_string($con, $_POST['email']);     
    $where = "email='$email'";
    $result = mysqli_query($con, selectdb($where));
    $numExistRows = mysqli_num_rows($result);
    // to check email exists 
    if ($numExistRows) {
    
        $to = $email;
        $subject= "Recover Your Password";
        $fet= mysqli_fetch_assoc($result);
        $id = $fet['id'];
        $tokken= rand();
        $swap_var = array(
            "{to_name}" =>"$email",
            "{coustom_url}" => "localhost/events/update-password.php?token=$tokken"
        );
        if(file_exists($templatefile)){
            $body = file_get_contents($templatefile);
            }else{
                die("unable to locate email temp file");
            }
            foreach(array_keys($swap_var) as $key){
                if(strlen($key)>2 && trim($key) != ""){
                    $body= str_replace($key, $swap_var[$key], $body);
                }
            }
        $headers = "From: talentvale.help@gmail.com \r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      
       if( mail($email , $subject , $body, $headers)){
           setcookie("ftoken", $tokken, time() + (600), "/");
           setcookie("uid", $id, time() + (600), "/");
        echo"mailsent";

       }else{
        echo"something is wrong";
       }


        // <script>
        //     const button = document.querySelector('button');
        //     const attributeName = button.getAttribute('name');
        //     button.setAttribute('forgot', 'set');

        //     document.getElementById("f_pass").type="text";
       
        // </script>
        
        //     header('Refresh:0; URL=forgot.php');
        }else{
            echo"email not found";
        }
    }
// update password start
    if(isset($_POST["update"])){
        $id = mysqli_real_escape_string($con,$_POST["id"]);
        $password =mysqli_real_escape_string($con,$_POST["password"]);
        $cpassword =mysqli_real_escape_string($con,$_POST["cpassword"]);
        $pass= password_hash($password, PASSWORD_BCRYPT);
        if($password!=$cpassword){
            $url=$_SERVER['HTTP_REFERER'];
            header('Location:'.$url.'&err=error');
        }else{
            $plen = strlen($password);
            if ($plen < 6 || $plen > 15) {
                echo "Password must be between 6 to 15 character  and only (@,_,$,a-z,0-9) are allowed";
            } else{
            $where="id='$id'";
            $upass="password='$pass'";
            $result = mysqli_query($con, selectdb($where));
            $numExistRows = mysqli_num_rows($result);
            if ($numExistRows) {
                $updatequerry=mysqli_query($con,updatedb($upass,$where));
                setcookie("ftoken", $tokken, time() + (-600), "/");
                setcookie("uid", $id, time() + (-600), "/");
                header('Location: login.php?err=up');
            }else{
                header('Location: login.php?err=down');
            }
         }
        }
    }

    // update password end 

    //start of ajax cpaanel //
extract($_POST);
    if(isset($_POST['readrecord'])){
        $displayquery =" SELECT * FROM `registration` ";
        $result = mysqli_query($con, $displayquery);
        if(mysqli_num_rows($result) > 0){
        $number = 1;
        while( $userlist = mysqli_fetch_array($result)){
            switch ($userlist['role']) {
                case 0:
                  $ro = "User";
                  break;
                case 1:
                    $ro = "Admin";
                  break;
                case 2:
                    $ro = "Faculty";
                  break;
                default:
                  //code block
              }
      $data =' <tr> 
         <td>'.$number.'</td>
       <td> '.$userlist['username'] .'</td>
         <td> '.$userlist['email'] .'</td>
         <td> '.$userlist['mobile'] .'</td>
         <td> '.$ro .'</td>
        <td>
         <button  class="btn btn-primary" onclick="" id="view">EDIT</button>
         <button class="btn btn-danger" onclick="deleterecord('.$userlist['id'].')" id="delete">DELETE</button>
         </td></tr>
        ';
        $number++;
        echo $data;
        }
    }
}


// for the admin table
if(isset($_POST['readrecords'])){
    $result =mysqli_query($con, selectdb("role = '1'"));
    if(mysqli_num_rows($result) > 0){
    $number = 1;
    while( $userlist = mysqli_fetch_array($result)){
        switch ($userlist['role']) {
            case 0:
              $ro = "User";
              break;
            case 1:
                $ro = "Admin";
              break;
            case 2:
                $ro = "Faculty";
              break;
            default:
              //code block
          }
  $data =' <tr> 
     <td>'.$number.'</td>
   <td> '.$userlist['username'] .'</td>
     <td> '.$userlist['email'] .'</td>
     <td> '.$userlist['mobile'] .'</td>
     <td> '.$ro .'</td>
    <td>
     <button  class="btn btn-primary" onclick="" id="view">EDIT</button>
     <button class="btn btn-danger" onclick="deleterecord('.$userlist['id'].')" id="delete">DELETE</button>
     </td></tr>
    ';
    $number++;
    echo $data;
    }
}
}

// for the event record in cpannel
if(isset($_POST['eventrecord'])){
    $displayquery ="SELECT * FROM `evelist` ";
    $result = mysqli_query($con, $displayquery);
    if(mysqli_num_rows($result) > 0){
        $number = 1;
        $func = "toggle(''+ editeve +'')";
        while( $userlist = mysqli_fetch_array($result)){
      $data =' <tr> 
         <td>'.$number.'</td>
       <td> '.$userlist['name'] .'</td>
         <td> <p align="justify">'.$userlist['description'] .'</p></td>
         <td  style="width:auto"><div class="image"><img id="eveimg" src="'.$userlist['image'] .'" alt="img not found" class="p-0 m-0 " width="100rem"></div></td>
         
        <td>
         <button  class="btn btn-primary" onclick="'.$func.'"  id="view">EDIT</button>
         <button class="btn btn-danger" onclick="deleteevent('.$userlist['id'].')" id="delete">DELETE</button>
         </td></tr>
        ';
        $number++;
        echo $data;
    }
}else{
    echo "nothing found here";
}
}

// to delete user records in cpannel

if(isset($_POST['delrecords'])){
    $where = $_POST['delrecords'];
    $result =mysqli_query($con, selectdb("id = $where"));
    if(mysqli_num_rows($result) > 0){
      $del= mysqli_query($con, deletedb("id = $where"));

}
}

// to fetch the event list in the event page popup 
if(isset($_POST['readevent'])){
    $where=$_POST['readevent'];
    $displayquery ="SELECT * FROM `evelist` WHERE id = '$where' ";
    $result = mysqli_query($con, $displayquery);
    if(mysqli_num_rows($result) > 0){
        while($eventlist = mysqli_fetch_array($result)){
            $event =' <img src="'.$eventlist['image'].'" width="80%" alt="">
            <h1 align="center">'.$eventlist['name'].'</h1>
            <br>
            <span>Description</span>
            <p align="justify">'.$eventlist['description'].'</p>
            <a href="eventregis.php?id='.$where.'"><button>Register</button></a>
            ';
            
           
              echo $event;
              }
    }else{
        echo "nothing is here";
    }
}

// to display event in events page
if(isset($_POST['displayevent'])){
    $displayquery ="SELECT * FROM `evelist` ";
    $result = mysqli_query($con, $displayquery);
    if(mysqli_num_rows($result) > 0){
    while($eventlist = mysqli_fetch_array($result)){
  $event ='<div class="event-item" onclick="readevent('.$eventlist['id'].')">
  <img src="'.$eventlist['image'].'" alt="alt">
  <h2>'.$eventlist['name'].'</h2>
  <p style=" 
  margin: 0 auto;
  padding:auto 0;
  max-width: 28ch;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  ">'.$eventlist['description'].'</p>
  </div>
  ';
 
    echo $event;
    }
}else{
    echo "nothing found here";
}
}
// to display event in home page
if(isset($_POST['displayevents'])){
    $displayquery ="SELECT * FROM `evelist` LIMIT 6 ";
    $result = mysqli_query($con, $displayquery);
    if(mysqli_num_rows($result) > 0){
    while($eventlist = mysqli_fetch_array($result)){
  $event ='
  <a href="events.php">
  <div class="event-item">
  <img height="250px" src="'.$eventlist['image'].'" alt="alt">
  <h2>'.$eventlist['name'].'</h2>
  <p style=" 
  margin: 0 auto;
  padding:auto 0;
  max-width: 28ch;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  ">'.$eventlist['description'].'</p>
  </div>
  </a>
  ';
 
    echo $event;
    }
}else{
    echo "nothing found here";
}
}

// to show the leaderboard result 
if(isset($_POST['leader'])){
    $displayquery ="SELECT * FROM `leaderbtable` ";
    $result = mysqli_query($con, $displayquery);
    if(mysqli_num_rows($result) > 0){
        $number=1;
        while($leaderlist = mysqli_fetch_array($result)){
            $event ='
            <tr> 
            <td>'.$number.'</td>
          <td> '.$leaderlist['name'] .'</td>
            <td> '.$leaderlist['description'] .'</td>
            <td> <span><img  src="'.$leaderlist['image'] .'" alt="img not found" class="p-0 m-0 " width="30%"></span></td>
            </tr>
            ';
           
              echo $event;
              $number++;
              }
          }else{
              echo "nothing found here";
          }

}


// for adding user through the cpannel 
if(isset($_POST['addusr'])){
 
    
    $where = "email='$email'";
    $result = mysqli_query($con, selectdb($where));
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {


        echo "email already exists";
    } else {
        if ($password === $cpassword) {
            $plen = strlen($password);
            if ($plen < 6 || $plen > 15) {
                echo "Password must be between 6 to 15 character  and only (@,_,$,a-z,0-9) are allowed";
            } else {
                $pass = password_hash($password, PASSWORD_BCRYPT);
                $ele = "`username`, `email`,`mobile`, `password`";
                $vlu = "'$username','$email','$mobile','$pass'";
                $iquery = mysqli_query($con, insertdb($ele, $vlu));

                if ($iquery) {
                    echo"iserted";
          
                } else {
                ?>
                    <script>
                        alert(" not inserted");
                    </script>
                    
<?php

                }

            }
        } else {
            echo "password not matching";
        }
    }
}


// adding event in the cpannel 

if (isset($_POST['addeve']))
{
    $eventname = mysqli_real_escape_string($con, $_POST['eventname']);
    $eventdescription = mysqli_real_escape_string($con, $_POST['eventdescription']);
	$filename = $_FILES["chosefile"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["chosefile"]["size"];
	$allowed_file_types = array('.svg','.jpg','.jpeg','.png','.webp');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
	{	
		// Rename file
		$newfilename = md5($file_basename) .time().$file_ext;
        $folder = "assets/images/".$newfilename;
		if (file_exists($folder))
		{
			// file already exists error
			echo "You have already uploaded this file.";
		}
		else
		{		
			if(move_uploaded_file($_FILES["chosefile"]["tmp_name"], "assets/images/" . $newfilename)){
			echo "File uploaded successfully.";	
                $sql = "INSERT INTO `evelist`( `name`, `description`,`image`) VALUES ('$eventname','$eventdescription','$folder')";
                $run=  mysqli_query($con, $sql); 
           if ($run){
            
           
            header("location:cpannel.php#events");
               
    
            }else{
    
             echo 'something went wrong';
    
        }
     }
            	
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	elseif ($filesize > 200000)
	{	
		// file size error
		echo "The file you are trying to upload is too large.";
	}
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["chosefile"]["tmp_name"]);
	}
}

    // for deleteing event record 
    if(isset($_POST['delevent'])){
        $eveid = $_POST['delevent'];
        $where = "id = $eveid";
        $result =mysqli_query($con, "SELECT * FROM `evelist` WHERE $where");
        if(mysqli_num_rows($result) > 0){
            $eventlist = mysqli_fetch_array($result);
            $filename = $eventlist['image'];
            if(file_exists($filename)){
                unlink($filename);
            }
            $del= mysqli_query($con, "DELETE FROM `evelist` WHERE  $where");

        }
    }
// to deit the image of the user 
    if(isset($_POST['editimage'])){
        
        $filename = $_FILES["chosefile"]["name"];
        $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
        $file_ext = substr($filename, strripos($filename, '.')); // get file name
        $filesize = $_FILES["chosefile"]["size"];
        $allowed_file_types = array('.svg','.jpg','.jpeg','.png','.webp');	
        
        if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
        {	
            // Rename file
            $newfilename = md5($file_basename) .time().$file_ext;
            $folder = "assets/images/".$newfilename;
            if (file_exists($folder))
            {
                // file already exists error
                echo "You have already uploaded this file.";
            }
            else
            {		
                if(move_uploaded_file($_FILES["chosefile"]["tmp_name"], "assets/images/" . $newfilename)){
                    $u = $_SESSION['username'];
                    $p= "email = '$u'";
                    $sql1 = mysqli_query($con,selectdb($p));
                    $run1 = mysqli_fetch_array($sql1);
                    $image = $run1['profileimg'];
                    // unlink($image);
                    $sql = "UPDATE registration SET profileimg = '$folder' WHERE email = '$u'";
                    $run=  mysqli_query($con, $sql); 

               if ($run){
                    header("location:profile.php");
               
                
        
                }else{
        
                 echo 'something went wrong';
        
            }
         }
                    
            }
        }
        elseif (empty($file_basename))
        {	
            // file selection error
            echo "Please select a file to upload.";
        } 
        elseif ($filesize > 200000)
        {	
            // file size error
            echo "The file you are trying to upload is too large.";
        }
        else
        {
            // file type error
            echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
            unlink($_FILES["chosefile"]["tmp_name"]);
        }        
    }


    // for event registration
    
if(isset($_POST['registerevent'])){
    require_once "links.php";
    $eveid = $_POST['eveid'];
    $usern = $_POST['username'];
    $useremail = $_POST['email'];
    $sql = "INSERT INTO `eventregis`(`eventid`, `username`, `useremail`) VALUES ('$eveid','$usern',' $useremail')";
    $run = mysqli_query($con,$sql);
if($run){
    echo'<div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">success</h1>
      <p class="col-md-8 fs-4">You are successfully registered, We will get in touch with you soon</p>
     <a href="events.php"> <button class="btn btn-primary btn-lg" type="button">DONE</button></a>
    </div>
  </div>';
  header('Refresh:2; URL="events.php"');
}else{
    echo'<div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Failed</h1>
      <p class="col-md-8 fs-4">Someting went wrong , try angin after some times</p>
     <a href="events.php"> <button class="btn btn-primary btn-lg" type="button">DONE</button></a>
    </div>
  </div>';
  header('Refresh:2; URL="events.php"');
}

}
?>
