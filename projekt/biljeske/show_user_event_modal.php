
 <!-- modal add new user -->
  <div id="id01" class="w3-modal" style = "width:300 height:200">
    <div class="w3-modal-content w3-card-32 w3-animate-zoom" >

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
        <img src="<?php echo P;?>images/avatar.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>
 <!-- begin form for insert data -->
 <form class="w3-container"   action="<?php echo P;?>biljeske/db-interaction/event.php"  method="post" value ="add" >
		   <input type='hidden' id='12' name='act' value='add' /> 
		    <input type='hidden' id='11' name='oib' value= '<?php echo $_GET["oib"];?>' /> 
			
			
			 <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left" ><b>Datum događaja:</b></label>
		    
		   </div>
		   
		    <div class="w3-container"style="margin-left:-17px;">
		 
		      <label class="w3-left" >
		 
		   
   <input type="datetime-local" name="daytime" min="2017-02-22" required>
  

		   </div>
		   
		   
		   
	  <label class="w3-left" ><b>Naslov: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="" name="title" required >
        <div class="form-group">
		 <label class="w3-left" ><b>Tekst: </b></label>
          <textarea class="form-control" rows="3" name = "tekst" required></textarea>
        </div>
        <button type="submit" class="w3-btn-block w3-green w3-round-large w3-section w3-padding">Dodaj novi događaj</button>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-round-large w3-red">Odustani</button>
       
      </div>

    </div>

  </div>
 