
 <!-- modal add new user -->
  <div id="id01" class="w3-modal" style = "width:300 height:200">
    <div class="w3-modal-content w3-card-32 w3-animate-zoom" >

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
        <img src="<?php echo P;?>images/avatar.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>
 <!-- begin form for insert data -->
      <form class="w3-container"   action="<?php echo P;?>korisnici/db-interaction/users.php"  method="post" value ="add" >
	<input type="hidden" id="12" name="act" value="add" />
        <div class="w3-section">
		
		<div class="w3-row-padding">
			     <hr>
		 <h3 class="w3-centar" ><b>Podaci o korisniku</b></h3> 
		     <hr>
		
		
			 <!-- first big half section -->
			<div class="w3-half">
          
		  <label class="w3-left" ><b>Ime: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Ivo" name="name" required>
          
		  <label class="w3-left" ><b>Prezime: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Ivić" name="surname" required>
		   
		    <label class="w3-left" ><b>Ime oca: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="ime oca" name="f_name" required>
          
		  <label class="w3-left" ><b>Djevojačko prezime: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="npr. Horvat" name="d_surname" >
		   
		   
          
		  <label class="w3-left" ><b>Državljanstvo: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="npr. Hrvatsko" name="drz" required>
		   
		   
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
		   
		   	    <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left"><b>Soba</b></label>
		   </div>
		   <div class="w3-container " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="room" required >
  
 <!-- napraviti popunjavanje-->
 
    <option value="" disabled selected>Odaberi sobu</option>
    <option value="199">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>

</div>
		
	
		   
		 


 <!-- end first smal section -->
  </div>
  <div class="w3-half w3-margin-bottom">
    <label class="w3-left" ><b>Mjesto rođenja:: </b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="npr. Varaždin " name="b_place" required>
 
	
 <div class="w3-container"style="margin-left:-17px;margin-top:10px">
		   <label class="w3-left"><b>Stanje korisnika</b></label>
		   </div>
		   <div class="w3-container " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="stanje" required>
  
  <!-- end first smal section -->
    <option value="" disabled selected>Odaberi stanje</option>
    <option value="Pokretan i potpuno samostalan">Pokretan i potpuno samostalan</option>
    <option value="Polupokretan">Polupokretan</option>
    <option value="Nepokretan">Nepokretan</option>
  </select>

</div>


 <!-- end second small section -->
  </div>
 </div>
 
   <label class="w3-left" ><b>Rješenje/ugovor o smještaju (klasa, urbroj, datum): </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr." name="sla" required>
 
   <label class="w3-left" ><b>Rješenje CZSS o skrbništvu (klasa, urbroj, datum): </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr. Ana" name="czss" required>
 

   	    <!-- begin small section -->
		
 

   <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left" ><b>Datum prijema u dom:</b></label>
		    
		   </div>
		   
		    <div class="w3-container"style="margin-left:-17px;">
		   <label class="w3-left" >
		    <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="first_day" required>
		   </div>
		   
			 <div class="w3-container"style="margin-left:-17px;margin-top:10px">
		   <label class="w3-left"><b>Redni broj iz matične knjige:</b></label>
		   </div>
		   
		    <div class="w3-container"style="margin-left:-17px;">
		  
		    <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="xxx" name="rbm" required>
		   </div>
			
		   
		   
		   
		   
		   
		 
 
		 
		   
		   
    
 <!-- end big half section -->
		</div>
		
 <!-- second big half section -->
		<div class="w3-half">
		
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
		
		  <label class="w3-left" ><b>OIB: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="12345678915" name="oib" required>
         
		 <label class="w3-left" ><b>JMBG: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="12345678915" name="jmbg" required>
          
		   <label class="w3-left" ><b>Broj osobne iskaznice: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="12345678915" name="no_id" required>
          
		   <label class="w3-left" ><b>Adresa (prije dolaska u dom): </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr. Varazdinska 16" name="adress" required>
          
		  <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left"><b>Bračno stanje</b></label>
		   </div>
		   <div class="w3-container w3-margin-bottom " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="brak" >
    <option value="" disabled selected>Odaberi</option>
    <option value="Ozenjen">Oženjen/udata</option>
    <option value="Neozenjen">Neoženjen/neudata</option>
    <option value="Udovac">Udovac/udovica</option>
  </select>

</div>
          
		   <label class="w3-left" ><b>Ime bračnog druga: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr. Ana" name="b_ime">
          
		   <label class="w3-left" ><b>Prezime bračnog druga: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr. Anić" name="b_prezime">
          
		  		   	    <div class="w3-container"style="margin-left:-17px">
		   <label class="w3-left"><b>Stručna sprema</b></label>
		   </div>
		   <div class="w3-container w3-margin-bottom  " style="margin-left:-17px;">


  <select class="w3-select w3-border" style="height:40px" name="ss" >
    <option value="" disabled selected>Stručna sprema</option>
    <option value="nema"> Bez škole</option>
    <option value="NSS"> NSS</option>
    <option value="SSS">SSS</option>
    <option value="VSS"> VSS</option>
    <option value="VŠS">VŠS</option>
  </select>

</div>
		   <label class="w3-left" ><b>Zvanje: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr. kovač" name="zvanje" required>

		  


		  
		
	
		  

		  <!-- end of second big half section -->
		</div>





			</div>
			
		   <label class="w3-left"><b>Zdravstveno stanje prilikom dolaska u dom: </b></label>
          <textarea class="form-control" rows="5" placeholder="Napomena" id="comment" name = "napomena" ></textarea>
		  

			   	     <hr>     
		   <h3 class="w3-centar" ><b>Podaci o skrbniku</b></h3> 
		     <hr>
		  <label class="w3-left" ><b>Ime skrbnika: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="Ivo" name="sk_name" >
          <label class="w3-left" ><b>Prezime skrbnika: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="Horvat" name="sk_surname" >
          <label class="w3-left" ><b>Adresa: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="Babinec 2" name="sk_adresa" >
          <label class="w3-left" ><b>Srodstvo s korisnikom </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="npr. sin" name="srodstvo">
          <label class="w3-left" ><b>Kontakt: </b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="00386165486" name="contact" >
         
		 <button class="w3-btn-block w3-green w3-round-large w3-section w3-padding" type="submit" action = "add">Dodaj korisnika</button>
         
       
	   </div>
	    <!-- end form insert data -->
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-round-large w3-red">Odustani</button>
       
      </div>

    </div>

  </div>
 