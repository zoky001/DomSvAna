<?php 



// ROOM ROOM ROOM 


//include_once "../inc/constants.inc.php";
include_once "../common/base.php";
 $pageTitle = "Korisnici";
include_once "../common/header.php";
include_once "/inc/class.rooms.php";
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
  <h1>Popis soba</h1>
   <!-- Add new user--button -->
   </div>  
        <div class="w3-container w3-center w3-right" style="margin-top:5px;margin-right:-10px" >
		<?php include_once "add_room_modal.php"; ?>	
			<button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-green w3-xlarge w3-round-large">Dodaj novu sobu</button>


</div>
     
</div>
  
  <!-- The Grid -->
  <div class="w3-row-padding">
  <!-- Left Column -->

  <!-- Middle Column -->
    <div class="w3-col m6 w3-round-xlarge w3-light-grey ">
	
	 
	
	 
  <div class="w3-container w3-margin-top" id="rooms">
    <h3>Rooms</h3>
    <p>Make yourself at home is our slogan. We offer the best beds in the industry. Sleep well and rest well.</p>
  </div>
  
  <div class="w3-row-padding">
    <div class="w3-col m3">
      <label><i class="fa fa-calendar-o"></i> Check In</label>
      <input class="w3-input w3-border" type="text" placeholder="DD MM YYYY">
    </div>
    <div class="w3-col m3">
      <label><i class="fa fa-calendar-o"></i> Check Out</label>
      <input class="w3-input w3-border" type="text" placeholder="DD MM YYYY">
    </div>
    <div class="w3-col m2">
      <label><i class="fa fa-male"></i> Adults</label>
      <input class="w3-input w3-border" type="number" placeholder="1">
    </div>
    <div class="w3-col m2">
      <label><i class="fa fa-child"></i> Kids</label>
      <input class="w3-input w3-border" type="number" placeholder="0">
    </div>
    <div class="w3-col m2">
      <label><i class="fa fa-search"></i> Search</label>
      <button class="w3-button w3-block w3-black w3-padding-8">Search</button>
    </div>
  </div>
  
 

  <div class="w3-row-padding w3-padding-16">
   
    <!-- include format room-->
	  <?php
	  $lists = new Rooms();
	//echo "prijavljen"; 
	//action="//localhost/list/db-interaction/lists.php" 
    //list($LID) = 
	$lists->loadRoom();
	
	?>
   
  </div>
  
	
	
   
  
	 <!-- End middle-->
  </div>
  
  <!-- Right Column -->
    <div class="w3-col m6 w3-round-xlarge w3-center w3-light-grey" >
	
<iframe class="w3-round-xlarge" height="800px" width="98%" src="room_choicee.php"  name="iframe_a"></iframe>
	
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

include_once "../common/footer.php";

?>