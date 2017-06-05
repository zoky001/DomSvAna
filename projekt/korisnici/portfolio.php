
<?php 
//include_once "../inc/constants.inc.php";
include_once "../common/base.php";
 $pageTitle = "Korisnici";
include_once "../common/header.php";
//include_once "inc/class.lists.user.inc.php";

?>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
<?php 



    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):
     
?>




<div class="w3-container " style="margin-top: 50px;">





<!-- Sidenav/menu -->

<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
 
 

<?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):
{
 
    include_once 'inc/class.lists.user.inc.php';
    $l = new UserAna($db);
 
	$l->formatUserSidebar($_GET["oib"]); //get oib
	
}
?>


<?php endif; ?>


  
 
  
  
  <a href="#about_user" onclick="w3_close()" class="w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>Osobni list korisnika</a>  
  <a href="#biljeske" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Bilješke</a>
  <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Lijekovi</a> 
 


  <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Kupanje</a>
    <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Induvidualni plan</a>
   <a href="#anamneza" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Anamneza</a>
   <!-- <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Plačanja</a> -->
	 <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Pregled ugovora</a>
	 
	    <div class="w3-dropdown-hover">
    <a href="#"> <i class="fa fa-th-large fa-fw w3-margin-right"></i> Dropdown <i class=" fa fa-caret-down"></i></a>
    <div class="w3-dropdown-content w3-white w3-card-4">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div>

</nav>


<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main " style="margin-left:300px; margin-top: 50px;">

 

  <!-- Header -->
  <header class="w3-container" id="portfolio">
    <a href="#"><img src="<?php echo P; ?>images/avatar.png" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <h1><b>Ime Prezime</b></h1>
<!-- filter

    <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filter:</span> 
      <button class="w3-btn">ALL</button>
      <button class="w3-btn w3-white"><i class="fa fa-diamond w3-margin-right"></i>Design</button>
      <button class="w3-btn w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
      <button class="w3-btn w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button>
    </div>-->
  </header>
  
  <!-- personal user list --> 
  <div class="w3-row-padding">
  
  <div class="w3-col m10">
  <?php    

include_once "terapija.php" ; 


  $l->formatPersonalUserListTable($_GET["oib"])  ?>

       
  
  

<!-- ANAMNeza-->

  <div class="w3-panel w3-round-xlarge w3-light-grey" w3-padding-large" style="margin-bottom:32px;" id="anamneza">
    <h4><b>Anamneza</b></h4>
    <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    <hr>
    

  </div>
  
 <!--biljeske -->
	
	<?php 

include_once "../biljeske/biljeske.php";

?>
	
	
	
<!-- end middle column-->
 </div>
 
   
  <!-- Right Column -->
    <div class="w3-col m2">
	
	<div class="w3-panel w3-round-xlarge w3-light-grey">
  <h1>Buduća događanja</h1>
</div>
  
     <!--biljeske -->
	
	<?php 

include_once "../biljeske/events_user.php";

?>
	  
	
 <!-- End right-->
  </div>
  
  </div>
 </div>
<!-- End page content -->


<script>
// Script to open and close sidenav
function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>
</div>
</div>
 <!-- new login -->
 <?php
       
    else:
	 echo "<meta http-equiv='refresh' content='0;".P."Prijava.php'>";
?>

 <?php
    endif;
?>

<?php 

include_once "../common/footer.php";

?>
