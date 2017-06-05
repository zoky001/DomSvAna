<?php 
include_once "inc/constants.inc.php";
include_once "common/base.php";
 $pageTitle = "Home";
include_once "common/header.php";
// Include site constants

?>


<?php 



    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):
     
?>
<!-- Page content -->
<div class="w3-content" style="max-width:1532px;">
 
 
 <!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1500px;margin-top:40px">  
<div class="w3-panel w3-round-xlarge w3-light-grey">
  <h1>Dom Sveta Ana</h1>
</div>
  
  <!-- The Grid -->
  <div class="w3-row-padding">
  <!-- Left Column -->
    <div class="w3-col m5">
  <div class="w3-panel w3-round-xlarge w3-light-grey">
  <h1>Napomene - korisnici</h1>
</div>
    
	<!-- Profile -->
      
     <?php include_once "biljeske/biljeske_sve.php" ?>
 <!-- End Left Column -->
 </div>
  <!-- Middle Column -->
    <div class="w3-col m5">
	
	 
<div class="w3-panel w3-round-xlarge w3-light-grey">
  <h1>Napomene - djelatnici</h1>
</div>


 <?php include_once "biljeske/biljeske_djelatnici.php" ?>
	 <!-- End middle-->
  </div>
  
  <!-- Right Column -->
    <div class="w3-col m2">
	<div class="w3-panel w3-round-xlarge w3-light-grey">
  <h1>Buduća događanja</h1>
</div>

     	<?php 

include_once "biljeske/events_all.php";

?>
	
 <!-- End right-->
  </div>
 
 </div>
 
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>

<!-- End page content -->
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

include_once "common/footer.php";

?>