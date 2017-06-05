<?php 
include_once "inc/constants.inc.php";
include_once "common/base.php";
 $pageTitle = "Korisnici";
include_once "common/header.php";
include_once "inc/class.lists.user.inc.php";
?>

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
<?php 



    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):
     
?>
 <!-- content -->
 <!-- Page content -->
<div class="w3-content" style="max-width:1532px;">
 
 
 <!-- Page Container -->
<div class="w3-container w3-content " style="max-width:1500px;margin-top:40px">  
<div class="w3-panel w3-round-xlarge w3-light-grey">
  <div class = "w3-left" style="margin-top:-10px">
  <h1>Popis korisnika</h1>
   <!-- Add new user--button -->
   </div>  
        <div class="w3-container w3-center w3-right" style="margin-top:5px;margin-right:-10px" >
		<?php include_once "add_user_modal.php"; ?>	
			<button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-green w3-xlarge w3-round-large">Dodaj novog korisnika</button>


</div>
     
</div>
  
  <!-- The Grid -->
  <div class="w3-row-padding">
  <!-- Left Column -->
    <div class="w3-col m2 w3-round-xlarge w3-light-grey">
  
    
	<!-- Profile -->
      <div class="w3-card-2 w3-round w3-white " style="margin-top:10px">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> UK</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
        </div>
      </div>
      <br>
      
      
      <br>
     
 <!-- End Left Column -->
 </div>
  <!-- Middle Column -->
    <div class="w3-col m8 w3-round-xlarge w3-light-grey ">
	
	 
	 <div class="w3-row-padding " style="margin-top:10px">
	 
   
<?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):
{
 
    include_once 'inc/class.lists.user.inc.php';
    $lists = new UserAna($db);
	//echo "prijavljen"; 
	//action="//localhost/list/db-interaction/lists.php" 
    //list($LID) = 
	$lists->loadUser();
	
}
?>


<?php endif; ?>

  
	
	
   
  </div>
	 <!-- End middle-->
  </div>
  
  <!-- Right Column -->
    <div class="w3-col m2 w3-round-xlarge w3-light-grey" >
	

	
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