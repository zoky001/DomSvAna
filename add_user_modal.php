
 <!-- modal add new user -->
  <div id="id01" class="w3-modal" style = "width:300 height:200">
    <div class="w3-modal-content w3-card-32 w3-animate-zoom" >

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
        <img src="<?php echo P;?>images/avatar.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>
 <!-- begin form for insert data -->
      <form class="w3-container"   action="<?php echo P;?>db-interaction\users.php"  method="post" value ="add" >
	<input type="hidden" id="12" name="act" value="add" />
        <div class="w3-section">
		
		<div class="w3-row-padding">
			 <!-- first big half section -->
			<div class="w3-half">
          
		  <label class="w3-left" ><b>Ime: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Ivo" name="name" required>
          
		  <label class="w3-left" ><b>Prezime: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Ivić" name="surname" required>
		   
		    <!-- begin small section -->
		   <div class="w3-row-padding" style="margin-left:-16px">
 
 <div class="w3-half w3-margin-bottom">
 
  <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left" ><b>Datum rođenja:</b></label>
		    
		   </div>
		   
		    <div class="w3-container"style="margin-left:-17px;">
		   <label class="w3-left" >
		    <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="bday" required>
		   </div>
		    <div class="w3-container"style="margin-left:-17px;margin-top:10px">
		   <label class="w3-left"><b>Način kupanja</b></label>
		   </div>
		   <div class="w3-container " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="bath" >
    <option value="" disabled selected>Odaberi način</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>

</div>
		   
		    <div class="w3-container"style="margin-left:-17px;margin-top:7px">
		   <label class="w3-left"><b>Prehrana</b></label>
		   </div>
		   <div class="w3-container w3-margin-bottom" style="margin-left:-17px;">


  <select class="w3-select w3-border " style="height:40px" name="food" >
    <option value="" disabled selected>Odaberi vrstu</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>

</div>

 <!-- end first smal section -->
  </div>
  <div class="w3-half w3-margin-bottom">
 
		    <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left"><b>Soba</b></label>
		   </div>
		   <div class="w3-container " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="room" >
    <option value="" disabled selected>Odaberi sobu</option>
    <option value="199">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>

</div>
 <div class="w3-container"style="margin-left:-17px;margin-top:10px">
		   <label class="w3-left"><b>Stanje</b></label>
		   </div>
		   <div class="w3-container " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="stanje" >
    <option value="" disabled selected>Odaberi stanje</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>

</div>

 <div class="w3-container"style="margin-left:-17px;margin-top:10px">
		   <label class="w3-left"><b>Način prehrane</b></label>
		   </div>
		   <div class="w3-container " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="food_n" >
    <option value="" disabled selected>Odaberi način</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>

</div>
 <!-- end second small section -->
  </div>
 </div>

		 
		   
		   
    
 <!-- end big half section -->
		</div>
		
 <!-- second big half section -->
		<div class="w3-half">
		  <label class="w3-left" ><b>OIB: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="12345678915" name="oib" required>
          
		 <div class="w3-container"> 
	 <label class="w3-left" ><b>Spol: </b></label>	 
	 </div>
	 
 <div class="w3-row-padding" style="margin-top:0px">
  <!-- sex left section -->
 <div class="w3-half w3-margin-bottom">
 
 <p>
  <input class="w3-radio w3-left" type="radio" name="gender" value="M">
  <label class="w3-validate" style="margin-top:12px;margin-left:-30px">Muškarac</label></p>
  </div>
   <!-- sex right section -->
  <div class="w3-half w3-margin-bottom">
  <p>
  <input class="w3-radio w3-left" type="radio" name="gender" value="Ž">
  <label class="w3-validate" style="margin-top:12px;margin-left:-30px">Žena</label></p>
  </div>
 </div>

		  
		  <label class="w3-left"><b>Napomena: </b></label>
          <textarea class="form-control" rows="5" placeholder="Dodatna napomena" id="comment"></textarea>
		  
	
		  

		  <!-- end of second big half section -->
		</div>





			</div>
		 <button class="w3-btn-block w3-green w3-round-large w3-section w3-padding" type="submit" action = "add">Dodaj korisnika</button>
         
       
	   </div>
	    <!-- end form insert data -->
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-round-large w3-red">Odustani</button>
       
      </div>

    </div>

  </div>
 