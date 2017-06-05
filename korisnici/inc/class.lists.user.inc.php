<?php

class UserAna {

    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db = NULL) {
        if (is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    public function loadUserbyRoom($room) {
        $sql = "select * from korisnici where Soba = :room order by Prezime";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':room', $room, PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch()) {


                echo $this->formatUserCard($row);
            }
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    public function loadUser() {
        $sql = "select * from korisnici order by Prezime";
        if ($stmt = $this->_db->prepare($sql)) {
            // $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while ($row = $stmt->fetch()) {


                echo $this->formatUserCard($row);
            }
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    private function formatUserCard($row) {

        $date = date_create($row['Godina_rodjenja']);
        $dat = date_format($date, 'd. m. Y.');
        return " <div class='w3-quarter w3-margin-bottom'>
	
 <div  class='w3-card-2  w3-ripple w3-round w3-hover-shadow w3-white ' style='margin-top:10px' id=\"$row[OIB]\">
        <div class='w3-container'>
         <h4 class='w3-center'> <a href = '" . P . "korisnici/portfolio.php?oib=$row[OIB]' target = '_blank'> $row[Prezime] $row[Ime] </a></h4>
         <p class='w3-center'><img src=\"" . P . "images/avatar.png\" class='w3-circle' style='height:106px;width:106px' alt='Avatar'></p>
         <hr>
         <p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i> Korisnik</p>
         <p><i class='fa fa-home fa-fw w3-margin-right w3-text-theme'></i> $row[OIB] </p>
         <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> " . $dat . "</p>
        </div>
      </div>
	  
	
	   </div>";
    }

    public function formatUserSidebar($oib) {



        $sql = "select * from korisnici where oib = :oib";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while ($row = $stmt->fetch()) {
                $date = date_create($row['Godina_rodjenja']);
                $dat = date_format($date, 'd. m. Y.');

                echo "   <div class='w3-container'>
    <a href='#' onclick='w3_close()' class='w3-hide-large w3-right w3-jumbo w3-padding' title='close menu'>
      <i class='fa fa-remove'></i>
    </a>
 <img src=' " . P . "images/avatar.png' style='width:45%;' class='w3-round'><br><br>
 
    <h4 class='w3-padding-0'><b>$row[Ime] $row[Prezime]</b></h4><br>
	
	
   
	
	  <p class='w3-text-grey'> <b>Odjel: </b> a </p>

	
	 <p class='w3-text-grey'> <b>Soba: </b>  $row[Soba] </p>
	 
	 <p class='w3-text-grey'> <b>Datum rođenja:</b>  " . $dat . " </p>
	
	 <p class='w3-text-grey'> <b> Kontakt:</b>  $row[kontakt] </p>

	  <p class='w3-text-grey'> <b>Status:</b>  $row[status] </p>

	 <hr>
  </div> ";
            }
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>";
        }
    }

    private function formatRemoveUser($oib) {

        $D = date("Y-m-d");

        // echo $D;

        echo " <!-- modal add new user -->
	
	<div class='w3-container w3-center w3-right' >
  <div id='id11' class='w3-modal' style = 'width:300 height:200'>
    <div class='w3-modal-content w3-card-32 w3-animate-zoom' >

      <div class='w3-center'><br>
        <span onclick=\"document.getElementById('id11').style.display='none'\" class='w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright' title='Close Modal'>&times;</span>
       
      </div>
 <!-- begin form for insert data -->
      <form class='w3-container'   action='" . P . "korisnici/db-interaction/users.php'  method='post' value ='add' >
	<input type='hidden' id='12' name='act' value='remove' />
        <div class='w3-section'>
		
		   <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left' ><b>Datum odlaska iz doma:</b></label>
		    
		   </div>
		    <input  type='hidden' value = '" . $oib . "' name='oib'  >
		   
		    <div class='w3-container'style='margin-left:-17px;'>
		   <label class='w3-left' >
		
		    <input class = 'w3-date w3-border w3-margin-bottom'  type='date' value ='" . $D . "'  name='rest_day' required>
		   </div>
		
 <label class='w3-left'><b>Razlog odlaska: </b></label>
          <textarea class='form-control w3-margin-bottom' rows='5' placeholder='Napomena' id='comment' name = 'napomena' ></textarea>



		  <label class='w3-left' ><b>Nova adresa: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' placeholder='Varazdinska 2  ' name='new_adress' >
		  
		 
		  

			</div>
			
		  
		  

			   	         
		
		 
         
		 <button class='w3-btn-block w3-green w3-round-large w3-section w3-padding' type='submit' action = 'add'>Ispiši korisnika</button>
         
       
	  
	    <!-- end form insert data -->
      </form>

      <div class='w3-container w3-border-top w3-padding-16 w3-light-grey'>
        <button onclick=\"document.getElementById('id11').style.display='none'\"  type='button' class='w3-btn w3-round-large w3-red'>Odustani</button>
       
      </div>

    </div>

  </div>
  </div>";
    }

    private function formatUpdateModalPersonalUserList($oib) {
        $sql = "select * from korisnici where oib = :oib";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch()) {



                echo "  
	
	 <div class='w3-container w3-center w3-right' >


	
	<!-- modal add new user -->
  <div id='id02' class='w3-modal' style = 'width:300 height:200'>
    <div class='w3-modal-content w3-card-32 w3-animate-zoom' >

      <div class='w3-center'><br>
        <span onclick=\"document.getElementById('id02').style.display='none'\" class='w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright' title='Close Modal'>&times;</span>
        <img src='" . P . "images/avatar.png' alt='Avatar' style='width:30%' class='w3-circle w3-margin-top'>
      </div>
 <!-- begin form for insert data -->
      <form class='w3-container'   action='" . P . "korisnici/db-interaction/users.php'  method='post' value ='add' >
	<input type='hidden' id='12' name='act' value='update' /> 
	 <input  type='hidden' value = '$row[OIB]' name='oib'  >
        <div class='w3-section'>
		
		<div class='w3-row-padding'>
			     <hr>
		 <h3 class='w3-centar' ><b>Podaci o korisniku</b></h3> 
		     <hr>
		
		
			 <!-- first big half section -->
			<div class='w3-half'>
          
		  <label class='w3-left' ><b>Ime: </b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text'  value ='$row[Ime]' name='name' required>
          
		  <label class='w3-left' ><b>Prezime: </b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text' value ='$row[Prezime]'  name='surname' required>
		   
		    <label class='w3-left' ><b>Ime oca: </b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text' value ='$row[ime_oca]'  name='f_name' required>
          
		  <label class='w3-left' ><b>Djevojačko prezime: </b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text' value ='$row[djevojacko_prezime]' name='d_surname' >
		   
		   
          
		  <label class='w3-left' ><b>Državljanstvo: </b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text' value ='$row[drzavljanstvo]'  name='drz' required>
		   
		   
		    <!-- begin small section -->
		   <div class='w3-row-padding' style='margin-left:-16px'>
 
 <div class='w3-half w3-margin-bottom'>
 
  <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left' ><b>Datum rođenja:</b></label>
		    
		   </div>
		   
		    <div class='w3-container'style='margin-left:-17px;'>
		   <label class='w3-left' >
		    <input class = 'w3-date w3-border w3-margin-bottom'  type='date'  value=$row[Godina_rodjenja] name='bday' required>
		   </div>
		   
		   	    <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left'><b>Soba</b></label>
		   </div>
		   <div class='w3-container ' style='margin-left:-17px;'>


  <select class='w3-select w3-border' style='height:40px' name='room' required >
  
 <!-- napraviti popunjavanje-->
 
    <option value='$row[Soba]'>  $row[Soba]</option>
    <option value='199'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
  </select>

</div>
		
	
		   
		 


 <!-- end first smal section -->
  </div>
  <div class='w3-half w3-margin-bottom'>
    <label class='w3-left' ><b>Mjesto rođenja:: </b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text' value = $row[mjesto_rodjenja] name='b_place' required>
 
	
 <div class='w3-container'style='margin-left:-17px;margin-top:10px'>
		   <label class='w3-left'><b>Stanje korisnika</b></label>
		   </div>
		   <div class='w3-container ' style='margin-left:-17px;'>


  <select class='w3-select w3-border' style='height:40px' name='stanje' required>
  
  <!-- end first smal section -->
    <option value='$row[z_stanje]'> $row[z_stanje]</option>
    <option value='Pokretan i potpuno samostalan'>Pokretan i potpuno samostalan</option>
    <option value='Polupokretan'>Polupokretan</option>
    <option value='Nepokretan'>Nepokretan</option>
  </select>

</div>


 <!-- end second small section -->
  </div>
 </div>
 
   <label class='w3-left' ><b>Rješenje/ugovor o smještaju (klasa, urbroj, datum): </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value=$row[ugovor] name='sla' required>
 
   <label class='w3-left' ><b>Rješenje CZSS o skrbništvu (klasa, urbroj, datum): </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = $row[czss] name='czss' required>
 

   <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left' ><b>Datum prijema u dom:</b></label>
		    
		   </div>
		   
		    <div class='w3-container'style='margin-left:-17px;'>
		   <label class='w3-left' >
		    <input class = 'w3-date w3-border w3-margin-bottom'  type='date'  value = $row[datum_prijema] name='first_day' required>
		   </div>
		   
		   	 <div class='w3-container'style='margin-left:-17px;margin-top:10px'>
		   <label class='w3-left'><b>Redni broj iz matične knjige:</b></label>
		   </div>
		   
		    <div class='w3-container'style='margin-left:-17px;'>
		  
		    <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = $row[rbm] name='rbm' required>
		   </div>
		   
		   
 
		 
		   
		   
    
 <!-- end big half section -->
		</div>
		
 <!-- second big half section -->
		<div class='w3-half'>
		
				 <div class='w3-container'> 
	 <label class='w3-left' ><b>Spol: </b></label>	 
	 </div>
	 
	 ";


                if ($row['Spol'] === 'M'): {
                        echo "   <div class='w3-row-padding' style='margin-top:0px'>
  <!-- sex left section -->
 <div class='w3-half w3-margin-bottom'>
 
 <p>
  <input class='w3-radio w3-left' type='radio' name='gender' checked='checked' value='M'>
  <label class='w3-validate' style='margin-top:12px;margin-left:-30px'>Muškarac</label></p>
  </div>
   <!-- sex right section -->
  <div class='w3-half w3-margin-bottom'>
  <p>
  <input class='w3-radio w3-left' type='radio' name='gender'  value='Ž'>
  <label class='w3-validate' style='margin-top:12px;margin-left:-30px'>Žena</label></p>
  </div>
 </div> ";
                    }
                else: {
                        echo "  <div class='w3-row-padding' style='margin-top:0px'>
  <!-- sex left section -->
 <div class='w3-half w3-margin-bottom'>
 
 <p>
  <input class='w3-radio w3-left' type='radio' name='gender'  value='M'>
  <label class='w3-validate' style='margin-top:12px;margin-left:-30px'>Muškarac</label></p>
  </div>
   <!-- sex right section -->
  <div class='w3-half w3-margin-bottom'>
  <p>
  <input class='w3-radio w3-left' type='radio' name='gender' checked='checked' value='Ž'>
  <label class='w3-validate' style='margin-top:12px;margin-left:-30px'>Žena</label></p>
  </div>
 </div>";
                    }
                endif;

                echo "
	 

		
		  <label class='w3-left' ><b>OIB: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[OIB]' name='oib12' disabled>
         
		 <label class='w3-left' ><b>JMBG: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[jmbg]' name='jmbg' required>
          
		   <label class='w3-left' ><b>Broj osobne iskaznice: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[br_osobne]' name='no_id' required>
          
		   <label class='w3-left' ><b>Adresa (prije dolaska u dom): </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[adresa]' name='adress' required>
          
		  <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left'><b>Bračno stanje</b></label>
		   </div>
		   <div class='w3-container w3-margin-bottom ' style='margin-left:-17px;'>


  <select class='w3-select w3-border' style='height:40px' name='brak' >
    <option value='$row[bracno_stanje]' >$row[bracno_stanje]</option>
    <option value='Ozenjen'>Oženjen/udata</option>
    <option value='Neozenjen'>Neoženjen/neudata</option>
    <option value='Udovac'>Udovac/udovica</option>
  </select>

</div>
          
		   <label class='w3-left' ><b>Ime bračnog druga: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[ime_b_druga]' name='b_ime'>
          
		   <label class='w3-left' ><b>Prezime bračnog druga: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[prez_b_druga]' name='b_prezime'>
          
		  		   	    <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left'><b>Stručna sprema</b></label>
		   </div>
		   <div class='w3-container w3-margin-bottom  ' style='margin-left:-17px;'>


  <select class='w3-select w3-border' style='height:40px' name='ss' >
    <option value='$row[s_sprema]' >$row[s_sprema]</option>
    <option value='nema'> Bez škole</option>
    <option value='NSS'> NSS</option>
    <option value='SSS'>SSS</option>
    <option value='VSS'> VSS</option>
    <option value='VŠS'>VŠS</option>
  </select>

</div>
		   <label class='w3-left' ><b>Zvanje: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[zvanje]' name='zvanje' required>

		  


		  
		
	
		  

		  <!-- end of second big half section -->
		</div>





			</div>
			
		   <label class='w3-left'><b>Zdravstveno stanje prilikom dolaska u dom: </b></label>
          <textarea class='form-control' rows='5'  id='comment' name = 'napomena' > $row[Napomena]</textarea>
		  

			   	     <hr>     
		   <h3 class='w3-centar' ><b>Podaci o skrbniku</b></h3> 
		     <hr>
		  <label class='w3-left' ><b>Ime skrbnika: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[sk_ime]' name='sk_name' >
          <label class='w3-left' ><b>Prezime skrbnika: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[sk_prezime]' name='sk_surname' >
          <label class='w3-left' ><b>Adresa: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[sk_adresa]' name='sk_adresa' >
          <label class='w3-left' ><b>Srodstvo s korisnikom </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[sk_srodstvo]' name='srodstvo'>
          <label class='w3-left' ><b>Kontakt: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[kontakt]' name='contact' >
         
		 <button class='w3-btn-block w3-green w3-round-large w3-section w3-padding' type='submit' action = 'add'>Pohrani promjene</button>
         
       
	   </div>
	    <!-- end form insert data -->
      </form>

      <div class='w3-container w3-border-top w3-padding-16 w3-light-grey'>
        <button onclick=\"document.getElementById('id02').style.display='none'\" type='button' class='w3-btn w3-round-large w3-red'>Odustani</button>
       
      </div>

    </div>
 </div>
  </div>
	
			";
            };
        }
    }

    public function formatPersonalUserList($oib) { //osobni list korisnika
        $sql = "select * from korisnici where oib = :oib";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while ($row = $stmt->fetch()) {

                $this->formatUpdateModalPersonalUserList($oib);
                $this->formatRemoveUser($oib);
                echo "   <!-- personal user list --> 
        <div class='w3-panel w3-round-xlarge w3-light-grey ' >
		
		<div class='w3-panel w3-center w3-round-xlarge w3-pale-blue'>
		<h2> <b>Osobni list korisnika &nbsp; - &nbsp;  $row[Ime] $row[Prezime]</b></h2>
		
		
		
		</div>

        <div class='w3-section'>
		
		<div class='w3-row-padding'>
			 <!-- first big half section -->
			<div class='w3-half' >
			
			<div class='w3-panel w3-round-xlarge w3-pale-yellow'>
			
		
		
			<div class='w3-center'><h3 class ='w3-large'> <b class='w3-xlarge'>Podaci o štičeniku </b> <h3> </div>
		
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Redni broj iz matične knjige: </b> $row[rbm] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Ime: </b> $row[Ime] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Prezime: </b> $row[Prezime] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Ime oca: </b> $row[ime_oca]<p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Djevojačko prezime: </b> $row[djevojacko_prezime] <p></div>
          	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Datum rođenja: </b> $row[Godina_rodjenja] <p></div>
		 	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Mjesto rođenja: </b> $row[mjesto_rodjenja] <p></div>
        	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Državljanstvo: </b> $row[drzavljanstvo]<p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>JMBG: </b> $row[jmbg]<p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>OIB: </b> $row[OIB] <p></div>
		 	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Broj osobne iskaznice: </b> $row[br_osobne]<p></div>
		   	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Adresa (prije dolaska u dom): </b> $row[adresa]<p></div>
		    <div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Bračno Stanje: </b> $row[bracno_stanje]<p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Ime i prezime bračnog druga: </b> $row[ime_b_druga] $row[prez_b_druga] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Školska sprema: </b> $row[s_sprema] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Zvanje: </b> $row[zvanje] <p></div>
			
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Rješenje/ugovor o smještaju (klasa,urbroj,datum): </b> $row[ugovor] <p></div>
		 	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Rješenje CZSS o skrbništvu (klasa,urbroj, datum): </b> $row[czss] <p></div>
        	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Datum prijema u dom: </b> $row[datum_prijema] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Zdravstveno stanje prilikom dolaska u dom: </b> $row[Napomena] <p></div>
	
			
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Datum odlaska iz doma: </b> $row[datum_odlaska] <p></div>
		 	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Razlog odlaska: </b> $row[razlog]<p></div>
		   	<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Nova adresa: </b> $row[nova_adresa]<p></div>
		
			</div>
		
		</div>
	<!-- end big half section -->		
 <!-- second big half section -->
		<div class='w3-half'>
		<div class='w3-panel w3-round-xlarge w3-pale-yellow'>
		
      
         	<div class='w3-center'><h3 class ='w3-large'> <b class='w3-xlarge'>Podaci o skrbniku</b> <h3> </div>
	
			
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Ime: </b> $row[sk_ime] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Prezime: </b>$row[sk_prezime] <p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Adresa: </b> $row[sk_adresa]<p></div>
			<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Srodstvo s korisnikom: </b> $row[sk_srodstvo] <p></div>
          
	
		</div>
		  <!-- end of second big half section -->
		</div>


			</div>
			<div class='w3-row-padding'>
				<div class='w3-third w3-centar'>
		 
	
			<button onclick=\"document.getElementById('id02').style.display='block'\" class='w3-btn-block w3-green w3-round-large w3-section w3-padding'>Promjeni podatke korisnika</button>
		 
		 
		 </div>
		 <div class='w3-third'>
		 <button class='w3-btn-block w3-green w3-round-large w3-section w3-padding' type='submit' action = ''>Preuzmi dokument</button>
		  </div>
		 <div class='w3-third'>
		 <button onclick=\"document.getElementById('id11').style.display='block'\" class='w3-btn-block w3-red w3-round-large w3-section w3-padding' type='submit' action = 'add'>Ispiši korisnika</button>
		  </div>
        
		</div>
       
	   </div>
	    <!-- end form insert data -->
      </div>
  ";
            }
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>";
        }
    }

    public function formatPersonalUserListTable($oib) { //osobni list korisnika
        $sql = "select * from korisnici where oib = :oib";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while ($row = $stmt->fetch()) {

                $date = date_create($row['Godina_rodjenja']);
                $datum_rod = date_format($date, 'd. m. Y.');

                $date = date_create($row['datum_prijema']);
                $datum_prijema= date_format($date, 'd. m. Y.');

                $date = date_create($row['datum_odlaska']);
                $datum_odlaska = date_format($date, 'd. m. Y.');

                $this->formatUpdateModalPersonalUserList($oib);
                $this->formatRemoveUser($oib);
                echo " 
<!-- personal user list --> 

<link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>
       

	   <div class='w3-panel w3-round-xlarge w3-light-grey ' >
		
		<div class='w3-panel w3-center w3-round-xlarge w3-pale-blue'>
		<h2> <b>Osobni list korisnika &nbsp; - &nbsp;  $row[Ime] $row[Prezime]</b></h2>
		
		
		
		</div>

        <div class='w3-section'>
	<!--<section class='w3-panel w3-center w3-round-xlarge w3-pale-blue'>-->
		<div class='w3-row-padding'>
			 <!-- first big half section -->
			<div class='w3-half' >
			

	<table class='w3-table-all w3-border w3-card-4'>		
		 <tr  class = 'w3-pale-yellow '>
			<th class = 'w3-center' colspan='2'  >Podaci o štičeniku</th>
			
		</tr>
		<tr>
		
		</tr>
		
		
			
		<tr>
			<td>Redni broj iz matične knjige: </td> 
			<td>$row[rbm]</td>
		</tr>
		
		<tr>
			<td>Ime:</td>
			<td> $row[Ime] </td>
		</tr>
		
		<tr>
			<td>Prezime: </td>
			<td> $row[Prezime] </td>
		</tr>
		
		<tr>
			<td>Ime oca:</td>
			<td>$row[ime_oca]</td>
		</tr>
		
		<tr>
			<td>Djevojačko prezime: </td>
			<td> $row[djevojacko_prezime] </td>
        </tr>
		
		<tr>
			<td>Datum rođenja: </td>
			<td>" . $datum_rod . " </td>
		</tr>
		
		<tr>
			<td>Mjesto rođenja: </td>
			<td>$row[mjesto_rodjenja] </td>
        </tr>
		
		<tr>
			<td>Državljanstvo: </td>
			<td>$row[drzavljanstvo]</td>
		</tr>
		
		<tr>
			<td>JMBG: </td>
			<td>$row[jmbg]</td>
		</tr>
		
		<tr>
			<td>OIB: </td>
			<td>$row[OIB] </td>
		</tr>
		
		<tr>
			<td>Broj osobne iskaznice: </td>
			<td>$row[br_osobne]</td>
		</tr>
		
		<tr>
			<td>Adresa (prije dolaska u dom):</td>
			<td> $row[adresa]</td>
		</tr>
		
		<tr>
			<td>Bračno Stanje: </td>
			<td> $row[bracno_stanje]</td>
		</tr>
		
		<tr>
		
			<td>Ime i prezime bračnog druga: </td>
			<td>$row[ime_b_druga] $row[prez_b_druga] </td>
		</tr>
		
		<tr>
			<td>Školska sprema: </td>
			<td>$row[s_sprema] </td>
		</tr>
		
		<tr>
			<td>Zvanje: </td>
			<td> $row[zvanje] </td>
			
		</tr>
		
		<tr>
			<td>Rješenje/ugovor o smještaju (klasa,urbroj,datum): </td>
			<td>$row[ugovor] </td>
		</tr>
		
		<tr>
			<td>Rješenje CZSS o skrbništvu (klasa,urbroj, datum): </td>
			<td>$row[czss] </td>
        </tr>
		
		<tr>
			<td>Datum prijema u dom: </td>
			<td> ".$datum_prijema." </td>
		</tr>
		
		<tr>
			<td>Zdravstveno stanje prilikom dolaska u dom: </td>
			<td>$row[Napomena] </td>
		</tr>
			
		<tr>
			<td>Datum odlaska iz doma: </td>
			<td> ".$datum_odlaska." </td>
		</tr>
		
		<tr>
			<td>Razlog odlaska: </td>
			<td> $row[razlog]</td>
		</tr>
		
		<tr>
		   <td>Nova adresa: </td>
		   <td>$row[nova_adresa]</td>
		</tr>
	</table>	

		
		</div>
	<!-- end big half section -->		
 <!-- second big half section -->
		<div class='w3-half'>
		<table class='w3-table-all w3-card-4'>		
		 <tr  class = 'w3-pale-yellow '>
			<th class = 'w3-center' colspan='2'  >Podaci o skrbniku</th>
			
		</tr>
		
      
		<tr>	
			<td>Ime: </td>
			<td>$row[sk_ime] </td>
		</tr>
		
		<tr>
			<td>Prezime: </td>
			<td>$row[sk_prezime] </td>
		
		</tr>
		
		<tr>
			<td>Adresa: </td>
			<td>$row[sk_adresa]</td>
		</tr>
		  
		<tr>
			<td>Srodstvo s korisnikom:</td>
			<td>$row[sk_srodstvo] </td>
        </tr>
	
		</table>
		  <!-- end of second big half section -->
		</div>


			</div>
			<!--</section>-->				
			<div class='w3-row-padding'>
				<div class='w3-third w3-centar'>
		 
	
			<button onclick=\"document.getElementById('id02').style.display='block'\" class='w3-btn-block w3-green w3-round-large w3-section w3-padding'>Promjeni podatke korisnika</button>
		 
		 
		 </div>
		 <div class='w3-third'>
		 <button class='w3-btn-block w3-green w3-round-large w3-section w3-padding' type='submit' action = ''>Preuzmi dokument</button>
		  </div>
		 <div class='w3-third'>
		 <button onclick=\"document.getElementById('id11').style.display='block'\" class='w3-btn-block w3-red w3-round-large w3-section w3-padding' type='submit' action = 'add'>Ispiši korisnika</button>
		  </div>
        
		</div>
       
	   </div>
	    <!-- end form insert data -->
      </div>
  ";
            }
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>";
        }
    }

    public function addUser() {
        $oib = $_POST['oib'];
        $name = $_POST['name'];
        $surn = $_POST['surname'];
        $room = $_POST['room'];
        $rbm = $_POST['rbm'];

        $f_name = $_POST['f_name']; //ime oca
        $d_surname = $_POST['d_surname']; //djevojačko prezive

        $room = $_POST['room'];
        $drz = $_POST['drz']; //državljanstvo
        $bday = $_POST['bday']; //datum rođenja
        $m_rod = $_POST['b_place']; //mjesto rođenja
        $stanje = $_POST['stanje'];
        $sla = $_POST['sla'];
        $czss = $_POST['czss'];
        $b_ime = $_POST['b_ime']; //ime bračnog druga
        $d_p = $_POST['first_day'];
        $gender = $_POST['gender'];
        $n_i = $_POST['no_id']; //broj osobne
        $jmbg = $_POST['jmbg'];
        $adress = $_POST['adress']; //prije dolaska
        $d_p = $_POST['first_day'];
        $brak = $_POST['brak'];
        $b_prezime = $_POST['b_prezime'];
        $d_p = $_POST['first_day'];
        $ss = $_POST['ss'];
        $zvanje = $_POST['zvanje'];
        $nap = $_POST['napomena'];
        $sk_name = $_POST['sk_name'];
        $sk_surname = $_POST['sk_surname'];
        $sk_adress = $_POST['sk_adresa'];
        $srod = $_POST['srodstvo'];
        $contact = $_POST['contact'];







        $sql = "INSERT INTO korisnici (OIB,Ime,Prezime,Godina_rodjenja,Spol,Soba,Napomena,ime_oca,djevojacko_prezime,mjesto_rodjenja,drzavljanstvo,jmbg,br_osobne,adresa,bracno_stanje,ime_b_druga,prez_b_druga,s_sprema,zvanje,sk_ime,sk_prezime,sk_adresa, sk_srodstvo,ugovor,czss,datum_prijema,z_stanje,kontakt,rbm) 
		                    VALUES (:oib,:name,:surname,:bday, :gender,:room,:nap,:f_name,:d_prez,:b_place,:drz , :jmbg,:br_os,:adress,:b_stanje,:b_drug_ime,:b_drug_prez,:ss,:zvanje, :skrbnik_ime, :skrbnik_prezime,:sk_adress,:sk_srodstvo, :sla,:czss,:f_day,:z_stanje,:contact,:rbm)";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surn, PDO::PARAM_STR);
            $stmt->bindParam(':room', $room, PDO::PARAM_INT);
            $stmt->bindParam(':rbm', $rbm, PDO::PARAM_STR);
            $stmt->bindParam(':bday', $bday, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);

            $stmt->bindParam(':nap', $nap, PDO::PARAM_STR);


            $stmt->bindParam(':f_name', $f_name, PDO::PARAM_STR); //ime oca
            $stmt->bindParam(':d_prez', $d_surname, PDO::PARAM_STR); //djevojacko prezime
            $stmt->bindParam(':b_place', $m_rod, PDO::PARAM_STR);
            $stmt->bindParam(':drz', $drz, PDO::PARAM_STR);
            $stmt->bindParam(':jmbg', $jmbg, PDO::PARAM_STR);
            $stmt->bindParam(':br_os', $n_i, PDO::PARAM_STR); // identity no
            $stmt->bindParam(':adress', $adress, PDO::PARAM_STR);
            $stmt->bindParam(':b_stanje', $brak, PDO::PARAM_STR);
            $stmt->bindParam(':b_drug_ime', $b_ime, PDO::PARAM_STR);
            $stmt->bindParam(':b_drug_prez', $b_prezime, PDO::PARAM_STR);
            $stmt->bindParam(':ss', $ss, PDO::PARAM_STR); //stručna sprema
            $stmt->bindParam(':zvanje', $zvanje, PDO::PARAM_STR);
            $stmt->bindParam(':skrbnik_ime', $sk_name, PDO::PARAM_STR);
            $stmt->bindParam(':skrbnik_prezime', $sk_surname, PDO::PARAM_STR);
            $stmt->bindParam(':sk_adress', $sk_adress, PDO::PARAM_STR);
            $stmt->bindParam(':sk_srodstvo', $srod, PDO::PARAM_STR);
            $stmt->bindParam(':sla', $sla, PDO::PARAM_STR); //ugovor
            $stmt->bindParam(':czss', $czss, PDO::PARAM_STR);
            $stmt->bindParam(':f_day', $d_p, PDO::PARAM_STR); //datum prijema
            $stmt->bindParam(':z_stanje', $stanje, PDO::PARAM_STR);
            $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);

            $stmt->execute();
            $stmt->closeCursor();

            //return $this->_db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateUser() {



        $name = $_POST['name'];
        $surn = $_POST['surname'];
        $room = $_POST['room'];
        $rbm = $_POST['rbm'];
        $f_name = $_POST['f_name']; //ime oca
        $d_surname = $_POST['d_surname']; //djevojačko prezive
        $oibb = $_POST['oib'];

        $oibb = '45454545454';
        $room = $_POST['room'];
        $drz = $_POST['drz']; //državljanstvo
        $bday = $_POST['bday']; //datum rođenja
        $m_rod = $_POST['b_place']; //mjesto rođenja
        $stanje = $_POST['stanje'];
        $sla = $_POST['sla'];
        $czss = $_POST['czss'];
        $b_ime = $_POST['b_ime']; //ime bračnog druga
        $d_p = $_POST['first_day'];
        $gender = $_POST['gender'];
        $n_i = $_POST['no_id']; //broj osobne
        $jmbg = $_POST['jmbg'];
        $adress = $_POST['adress']; //prije dolaska
        $d_p = $_POST['first_day'];
        $brak = $_POST['brak'];
        $b_prezime = $_POST['b_prezime'];
        $d_p = $_POST['first_day'];
        $ss = $_POST['ss'];
        $zvanje = $_POST['zvanje'];
        $nap = $_POST['napomena'];
        $sk_name = $_POST['sk_name'];
        $sk_surname = $_POST['sk_surname'];
        $sk_adress = $_POST['sk_adresa'];
        $srod = $_POST['srodstvo'];
        $contact = $_POST['contact'];

        /* $sql = "UPDATE list_items
          SET ListText=:text
          WHERE ListItemID=:id
          LIMIT 1"; */
        $sql = "UPDATE korisnici SET Ime= :name, Prezime =:surname,Godina_rodjenja =:bday,Spol=:gender,Soba=:room,Napomena=:nap,ime_oca=:f_name,
					djevojacko_prezime=:d_prez, mjesto_rodjenja=:b_place,drzavljanstvo= :drz,jmbg=:jmbg,br_osobne=:br_os,adresa=:adress,bracno_stanje=:b_stanje,
					ime_b_druga=:b_drug_ime,prez_b_druga=:b_drug_prez,s_sprema=:ss,zvanje=:zvanje,sk_ime=:skrbnik_ime,sk_prezime=:skrbnik_prezime,
						sk_adresa =:sk_adress,sk_srodstvo=:sk_srodstvo,ugovor=:sla, czss=:czss,datum_prijema=:f_day,z_stanje=:z_stanje,kontakt=:contact, rbm = :rbm WHERE OIB = :oib";




        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':oib', $oibb, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surn, PDO::PARAM_STR);
            $stmt->bindParam(':room', $room, PDO::PARAM_INT);
            $stmt->bindParam(':rbm', $rbm, PDO::PARAM_STR);
            $stmt->bindParam(':bday', $bday, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);

            $stmt->bindParam(':nap', $nap, PDO::PARAM_STR);


            $stmt->bindParam(':f_name', $f_name, PDO::PARAM_STR); //ime oca
            $stmt->bindParam(':d_prez', $d_surname, PDO::PARAM_STR); //djevojacko prezime
            $stmt->bindParam(':b_place', $m_rod, PDO::PARAM_STR);
            $stmt->bindParam(':drz', $drz, PDO::PARAM_STR);
            $stmt->bindParam(':jmbg', $jmbg, PDO::PARAM_STR);
            $stmt->bindParam(':br_os', $n_i, PDO::PARAM_STR); // identity no
            $stmt->bindParam(':adress', $adress, PDO::PARAM_STR);
            $stmt->bindParam(':b_stanje', $brak, PDO::PARAM_STR);
            $stmt->bindParam(':b_drug_ime', $b_ime, PDO::PARAM_STR);
            $stmt->bindParam(':b_drug_prez', $b_prezime, PDO::PARAM_STR);
            $stmt->bindParam(':ss', $ss, PDO::PARAM_STR); //stručna sprema
            $stmt->bindParam(':zvanje', $zvanje, PDO::PARAM_STR);
            $stmt->bindParam(':skrbnik_ime', $sk_name, PDO::PARAM_STR);
            $stmt->bindParam(':skrbnik_prezime', $sk_surname, PDO::PARAM_STR);
            $stmt->bindParam(':sk_adress', $sk_adress, PDO::PARAM_STR);
            $stmt->bindParam(':sk_srodstvo', $srod, PDO::PARAM_STR);
            $stmt->bindParam(':sla', $sla, PDO::PARAM_STR); //ugovor
            $stmt->bindParam(':czss', $czss, PDO::PARAM_STR);
            $stmt->bindParam(':f_day', $d_p, PDO::PARAM_STR); //datum prijema
            $stmt->bindParam(':z_stanje', $stanje, PDO::PARAM_STR);
            $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);

            $stmt->execute();
            $stmt->closeCursor();

            //return $this->_db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function removeUser() {
        $oib = $_POST['oib'];
        $day = $_POST['rest_day'];
        $nap = $_POST['napomena'];
        $adr = $_POST['new_adress'];
        $status = "Napustio";
        $null = "NULL";

        $sql = "UPDATE korisnici SET status= :status, Soba = NULL,  datum_odlaska = :date,
					razlog =:razlog, nova_adresa = :adress WHERE OIB = :oib";



        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':date', $day, PDO::PARAM_STR);
            $stmt->bindParam(':razlog', $nap, PDO::PARAM_STR);
            $stmt->bindParam(':adress', $adr, PDO::PARAM_STR);
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            //$stmt->bindParam(':null', $null, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            //return "Success!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Returns the CSS class that determines color for the list item
     *
     * @param int $color    the color code of an item
     * @return string       the corresponding CSS class for the color code
     */
    private function getColorClass($color) {
        switch ($color) {
            case 1:
                return 'colorBlue';
            case 2:
                return 'colorYellow';
            case 3:
                return 'colorRed';
            default:
                return 'colorGreen';
        }
    }

    public function changeListItemPosition() {
        $listid = (int) $_POST['currentListID'];
        $startPos = (int) $_POST['startPos'];
        $currentPos = (int) $_POST['currentPos'];
        $direction = $_POST['direction'];

        if ($direction == 'up') {
            /*
             * This query modifies all items with a position between the item's
             * original position and the position it was moved to. If the
             * change makes the item's position greater than the item's
             * starting position, then the query sets its position to the new
             * position. Otherwise, the position is simply incremented.
             */
            $sql = "UPDATE list_items
                    SET ListItemPosition=(
                        CASE
                            WHEN ListItemPosition 1>$startPos THEN $currentPos
                            ELSE ListItemPosition 1
                        END)
                    WHERE ListID=$listid
                    AND ListItemPosition BETWEEN $currentPos AND $startPos";
        } else {
            /*
             * Same as above, except item positions are decremented, and if the
             * item's changed position is less than the starting position, its
             * position is set to the new position.
             */
            $sql = "UPDATE list_items
                    SET ListItemPosition=(
                        CASE
                            WHEN ListItemPosition-1<$startPos THEN $currentPos
                            ELSE ListItemPosition-1
                        END)
                    WHERE ListID=$listid
                    AND ListItemPosition BETWEEN $startPos AND $currentPos";
        }

        $rows = $this->_db->exec($sql);
        echo "Query executed successfully. ",
        "Affected rows: $rows";
    }

    public function changeListItemColor() {
        $sql = "UPDATE list_items
                SET ListItemColor=:color
                WHERE ListItemID=:item
                LIMIT 1";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':color', $_POST['color'], PDO::PARAM_INT);
            $stmt->bindParam(':item', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function toggleListItemDone() {
        $sql = "UPDATE list_items
                SET ListItemDone=:done
                WHERE ListItemID=:item
                LIMIT 1";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':done', $_POST['done'], PDO::PARAM_INT);
            $stmt->bindParam(':item', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            return TRUE;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

?>