  

 <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
 <link rel="stylesheet" href="<?php include_once "../inc/constants.inc.php";echo P;?>w3.css">





  <div class="col-sm-12 w3-panel w3-round-xlarge w3-light-grey" id="biljeske">

     
 <?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):
{
 
    include_once 'inc/class.note.php';
    $lists = new Note();
 
	$lists->loadAllNote();
	
}
?>
<?php endif; ?>
	</div >
	
	
