<!DOCTYPE html>

<?php 
include_once "../inc/constants.inc.php";
include_once "/inc/class.rooms.php";
 
	  $Room = new Rooms();
	  
	include_once "../korisnici/inc/class.lists.user.inc.php";
 
	  $User = new UserAna();  
	
	
	
	?>
?>
<html>
<title>Sobe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display:none}
</style>
<body class="w3-content w3-border-left w3-border-right">

<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-light-grey w3-collapse w3-top" style="z-index:3;width:260px" id="mySidenav">
  <div class="w3-container w3-padding-8">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-closebtn w3-hover-text-red"></i>
    <h3>Broj sobe: <?php echo $_GET['num_room'] ?></h3>
    <h3>from $99</h3>
    <h6>per night</h6>
    <hr>
    <form action="/action_page.php" target="_blank">
      <p><label><i class="fa fa-calendar-check-o"></i> Check In</label></p>
      <input class="w3-input w3-border" type="text" placeholder="DD MM YYYY" name="CheckIn" required>          
      <p><label><i class="fa fa-calendar-o"></i> Check Out</label></p>
      <input class="w3-input w3-border" type="text" placeholder="DD MM YYYY" name="CheckOut" required>         
      <p><label><i class="fa fa-male"></i> Adults</label></p>
      <input class="w3-input w3-border" type="number" value="1" name="Adults" min="1" max="6">              
      <p><label><i class="fa fa-child"></i> Kids</label></p>
      <input class="w3-input w3-border" type="number" value="0" name="Kids" min="0" max="6">
      <p><button class="w3-button w3-block w3-green w3-left-align" type="submit"><i class="fa fa-search w3-margin-right"></i> Search availability</button></p>
    </form>
  </div>
  <a href="#apartment" class="w3-padding-16"><i class="fa fa-building"></i> Apartment</a>
  <a href="javascript:void(0)" class="w3-padding" onclick="document.getElementById('subscribe').style.display='block'"><i class="fa fa-rss"></i> Subscribe</a>
  <a href="#contact" class="w3-padding-16"><i class="fa fa-envelope"></i> Contact</a>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-black w3-xlarge w3-padding-16">
  <span class="w3-left">Broj sobe: <?php echo $_GET['num_room']; ?></span>
  <a href="javascript:void(0)" class="w3-right w3-opennav" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-white" style="margin-left:260px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:80px"></div>

  <!-- Slideshow Header -->

  <?php 
  
  $Room->FormatContent($_GET['num_room']);
  
  
  ?>

<div class ="w3-container">
  <h2>Korisnici u sobi</h2>
  <div class="w3-round-xlarge w3-light-grey ">
  <!-- Protage -->
  <div class="w3-row-padding" id="contact">
   
    <?php 
	$User->loadUserbyRoom($_GET['num_room']);
	
	?>
  </div>
 </div> 
 
 </div>

<!-- End page content -->



<!-- Subscribe Modal -->
<div id="subscribe" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom w3-padding-large">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('subscribe').style.display='none'" class="fa fa-remove w3-closebtn w3-xlarge w3-hover-text-grey w3-margin"></i>
      <h2 class="w3-wide">SUBSCRIBE</h2>
      <p>Join our mailing list to receive updates on available dates and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-green w3-margin-bottom" onclick="document.getElementById('subscribe').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Script to open and close sidenav when on tablets and phones
function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Slideshow Apartment Images
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>

</body>
</html>
