  

 <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
 <link rel="stylesheet" href="<?php include_once "../inc/constants.inc.php";echo P;?>w3.css">





  <div class="col-sm-12 w3-panel w3-round-xlarge w3-light-grey" id="biljeske">

 <div class="col-sm-12 w3-panel w3-round-xlarge w3-white" id="biljeske">
      
           <form class="w3-container"   action="<?php echo P;?>biljeske/db-interaction/note.php"  method="post" value ="add" >
		   <input type='hidden' id='12' name='act' value='add_emp' /> 
		    <input type='hidden' id='11' name='oib' value= '<?php echo $_GET["oib"];?>' /> 
	  <label class="w3-left" ><b>Naslov: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="" name="title" required >
        <div class="form-group">
		 <label class="w3-left" ><b>Tekst: </b></label>
          <textarea class="form-control" rows="3" name = "tekst" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Dodaj novu bilješku</button>
      </form>
      <br>

 </div >	      <?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):
{
 
    include_once 'inc/class.note.php';
    $lists = new Note();
 
	$lists->loadAllEmpNote();
	
}
?>
<?php endif; ?>
	</div >
	
	
