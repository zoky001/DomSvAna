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
  
       

        <form class="w3-container w3-margin-top"   action="<?php echo P; ?>biljeske/db-interaction/note.php"  method="post" target = "_blank" value ="add" >
            <input type='hidden' id='12' name='act' value='pdf_all_note' /> 
           
            
                <table class="w3-table-all w3-card-4" style="margin-top:10px">
                    <tr>
                        <th>Od:</th>
                        <th>Do:</th>
                        <th>Pruzimanje</th>
                        

                    </tr>
                    <tr>
                       
                        <td> <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="from" required> </td>
                        <td> <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="to" required> </td>
                        <td> <button type="submit" class="btn btn-success">Preuzmi izvještaj</button></td>
                    </tr>


                </table>
                
          
        </form>
        <br>





  
  
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