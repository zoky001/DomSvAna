
 <!-- modal add new user -->
  <div id="id01" class="w3-modal" style = "width:150;height:100">
    <div class="w3-modal-content w3-card-32 w3-animate-zoom" style="max-width:600px" >

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
        <img src="<?php echo P;?>images/room.png" alt="room" style="width:30%" class="w3-circle w3-margin-top">
      </div>
 <!-- begin form for insert data -->
      <form class="w3-container"   action="<?php echo P;?>room/db-interaction/rooms.php"  method="post" value ="add" enctype="multipart/form-data" >
	<input type="hidden" id="12" name="act" value="add" />
        <div class="w3-section">
		
		
					  <hr>     
		   <h3 class="w3-centar" ><b>Informacije o sobi</b></h3> 
		     <hr>
		  <label class="w3-left" ><b>Broj sobe: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="1/A" name="no_room" required >
          <label class="w3-left" ><b>Broj kreveta: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="2" name="no_bed" required >
          
		<div>  <label class="w3-left" ><b>Spol: </b></label> </div>
           <div  class="w3-container" style="margin-top:0px">
  <!-- sex left section -->

 <div class=" w3-container w3-margin-bottom ">
 
 <p class = "w3-left">
  <input class="w3-radio " type="radio" name="gender" value="M" required>
  <label class="w3-validate " style="margin-top:10px;margin-left:10px">Muška soba</label></p> 
  </div>

   <!-- sex right section -->
  <div class=" w3-container w3-margin-bottom ">
  <p  class = "w3-left">
  <input class="w3-radio" type="radio" name="gender" value="Ž" required>
  <label class="w3-validate" style="margin-top:10px;margin-left:10px">Ženska soba</label></p> 
  </div>

  </div>
          
		  
		<div>  <label class="w3-left" ><b>Odjel </b></label></div>
          	   <div class="w3-container w3-margin-bottom" style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="odjel" required >
  
 <!-- napraviti popunjavanje-->
 
    <option value="" disabled selected>Odaberi odjel</option>
    <option value="A">a</option>
    <option value="B">b</option>
    <option value="C">c</option>
  </select>

</div>
         
		 <label class="w3-left" ><b>Površina: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="16" name="m2" >
          <label class="w3-left" ><b>Opis sobe: </b></label>
          <textarea class="form-control w3-margin-bottom" rows="3" name = "opis" ></textarea>

	
  <label class="w3-left w3-margin-bottom" ><b>Dodaj sliku sobe: </b></label>
  
  <div class="w3-container w3-margin-bottom"  >
 <input  type="file" name="fileToUpload" id="fileToUpload">
    </div>


		  
		 <button class="w3-btn-block w3-green w3-round-large w3-section w3-padding" type="submit" name = "submit">Dodaj sobu</button>
		 
		 
         
       
	   </div>
	    <!-- end form insert data -->
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-round-large w3-red">Odustani</button>
       
      </div>

    </div>

  </div>
 