<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
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

  <title>IIMTevents.com</title>
</head>

<body>

  <!-- <a href="logout.php"> <button name="logout">Logout</button></a> -->

  <div>
      <?php
      include "assets/nav.php";
      ?>
    <header>
    
      <main>
        <div>
          <!-- animated text  -->
          <!-- <div class="">
        <span class=" font-bold"></span>
        <span id="text" class="text-red-500 font-bold"></span>
      </div> -->
      <!-- text  -->
          <h1 id="h_heading  " class="mx-auto mb-4 heading text-center" style="color: #ffe0ff; 	-webkit-text-stroke: 1px whitesmoke; ">
           <span style="font-size: 44px;" id="text"></span>
          </h1>
          <h3 id="h2_heading"  class="mb-5" >Making Competitions and Contests a Breeze for Everyone.</h3>
        <center>  <div >
        <a href="#contact"> <button class="btn btn-danger">contact us</button></a>
        <a href="login.php"> <button class="btn btn-primary">sign up / login </button></a>
          </div></center>
        </div>

      </main>
    </header>
    <section class="m-5">
      <h2 align="center" class="heading">Latest Event</h2>
      <div class="event mx-5">
        <div class="event-list m-5" id="eventlist">
          <script>
            $(document).ready(function() {
              displayevents()
            });
          </script>
        </div>
            <a href="events.php">view all <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </section>
  </div>
  <section id="contact" class="py-5">
    <h2 align="center" class="py-4 heading">Contact Us</h2>
            <center>
      <form id="contact-form"  target="blank">
        <input type="text" placeholder="Name" required>
        <input type="text" placeholder="Email" required>
        <textarea name="message" id="message" cols="20" placeholder="Type here..." required></textarea>
        <button class="m-5">Submit</button>
      </form></center>
      </div>
  </section>
  <section class="my-5">
    <h2 align="center" class="question my-4 heading">Frequently Ask Question </h2>
    <!-- <div id="question">
      <h5>What types of events do you host?<span id="dots">...</span><span style="	font-size: 22px; 
	font-weight: bold;" onclick="myFunction()" id="myBtn"> &plus;</span>
        <h5 id="more"> We don't host the events we are to mannage the whole events like registration , no of students getting in etc,</h5>
      </h5>
      <h5>Where and when are your events held?<span id="dots">...</span><span style="	font-size: 22px; 
	font-weight: bold;" onclick="myFunction()" id="myBtn"> &plus;</span>
        <h5 id="more"> The events are held with in the college campus(IIMT ENGINEERING COLLEGE)</h5>
      </h5>
    </div> -->



    <div class="accordion container" id="accordionExample">

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseone" aria-expanded="false" aria-controls="collapseone">
      What types of events do you host?
      </button>
    </h2>
    <div id="collapseone" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      We don't host the events we are to mannage the whole events like registration , no of students getting in etc,
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      Where and when are your events held?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      The events are held with in the college campus(IIMT ENGINEERING COLLEGE)
      </div>
    </div>
  </div>
</div>
  </section>
  <section class="comments py-5">
    <h2 align="center" class="my-4 heading">Comments</h2>

    
    <center>
      <div id="cirl">
        <div class="circle"> Ready to rock my best outfit and show off my killer dance moves! Let's do this, fresher fam!</div>
        <div class="circle">The whole campus is buzzing about the fresher bash! This party's gonna be legendary.</div>
        <div class="circle">Shoutout to the student council for throwing the raddest fresher party ever! Feeling the campus spirit strong.</div>
        <div class="circle">Countdown's on for the biggest party of the year! Time to break the ice and make memories that'll last a lifetime</div>
      </div>
      <!-- <div id="cirl">
      <div class="circle"></div>
      <div class="circle"></div>
      <div class="circle"></div>
      <div class="circle"></div>
      </div> -->
    </center>
  </section>
 



  <?php
  include "assets/footer.php";
  ?>
  <script src="autotype.js"></script>
  <script>
    function myFunction() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("myBtn");

      if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "&plus;";
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = " &uarr;";
        moreText.style.display = "inline";
      }
    }
  </script>
</body>

</html>