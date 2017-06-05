    
	
	<div class="w3-container w3-center">
      <?php include_once "add_event.php"; ?>	
          <p><button onclick="document.getElementById('id11').style.display='block'" class="btn btn-primary w3-green btn-lg">Dodaj događaj</button></p>
        </div>
		
		<?php
		include_once "inc/class.event.php"; 	 
		$Ev = new Event();
 
	    $Ev->loadAllEvent();
		?>
		
	
  
	  
	
	  
	 
	