<?php

class Therapy
{
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
    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
	
	public function loadTherapy($oib)
    {
        $sql = "select * from terapija_lijekovi where ID_korisnika = :oib order by datum_pocetka desc";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
                
           
				
				echo $this->formatTherapy($row);
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        
    }
private function formatTherapy($row)
    {
            
        return "    <tr>
      <td>".$this->showDrugName($row['ID_lijeka'])."</td>
      <td class = 'w3-center'>$row[ujutro]</td>
      <td class = 'w3-center'>$row[popodne]</td>
	   <td class = 'w3-center'>$row[navecer]</td>
	   <td class = 'w3-center'>$row[datum_pocetka]</td>
	     <td class = 'w3-center'>$row[datum_zavrsetka]</td>
	   <td> 
	    <form action='".P."korisnici/db-interaction/therapy.php'  method='post'  >
		 <input type='hidden'  name='act' value='delete' />
		 <input type='hidden' name='oib' value= '$row[ID_korisnika]' /> 
     <input type='hidden'  name='ID' value= '$row[ID_terapije]' /> 
	    <section class = 'w3-row-padding'>
  
   <section class = 'w3-half'>
  <button class='w3-btn-block w3-red w3-small w3-round-large w3-section w3-padding' type='submit'>Obriši</button>
  
  </section>
 <section class = 'w3-half'>
  
 <button class='w3-btn-block w3-blue w3-small w3-round-large w3-section w3-padding' disabled >Izmjeni</button>
  </section>

  
  </section>
	   
	   
	   
	   
	 </form>  
	   </td>
    </tr>
	  ";
 
 
 
    }
	
			public function showDrugName($ID)
    {
            $sql = "select * from lijekovi where ID_lijeka = :id";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':id', $ID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
           
		   
		   return $row['Naziv'];;
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
        
		
 
 
 
    }	
	
	public function DrugList()
    {
            $sql = "select * from lijekovi";
         if($stmt = $this->_db->prepare($sql))
        {
           
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
                echo " <option value='$row[ID_lijeka]'>$row[Naziv]</option>";
           
				
				
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
        
		
 
 
 
    }
	public function addTherapy()
    {
		//$_SESSION['Username']
		//$datum =  date('m/d/Y h:i:s a', time());
		
		$datum  = date('Y-m-d H:i:s');
	$oib = $_POST['oib'];
	$sql = "INSERT INTO `terapija_lijekovi`(`ID_korisnika`, `ID_lijeka`, `ujutro`, `popodne`, `navecer`, `datum_pocetka`, `ID_djelatnika`,datum_zavrsetka) 
		 VALUES (:kor,:lij,:uju, :pop, :nav, :datum, :dje, :datum_end)";
	
		 
	/*$sql = "	 INSERT INTO `terapija_lijekovi`(`ID_korisnika`, `ID_lijeka`, `ujutro`, `popodne`, `navecer`, `datum_pocetka`, `ID_djelatnika`) 
		 VALUES (16,1,1, 0, 2, 2017-03-07, 22789495176)";*/
		 
        try
        {
            $stmt = $this->_db->prepare($sql);
			
			$stmt->bindParam(':kor', $oib, PDO::PARAM_STR);
			 
			$stmt->bindParam(':lij', $_POST['lijek'], PDO::PARAM_INT);
            $stmt->bindParam(':uju', $_POST['kolicina_u'], PDO::PARAM_INT);
			$stmt->bindParam(':pop', $_POST['kolicina_p'], PDO::PARAM_INT);
			$stmt->bindParam(':nav', $_POST['quantity_n'], PDO::PARAM_INT);
           
            $stmt->bindParam(':datum',$_POST['day'], PDO::PARAM_STR);
            $stmt->bindParam(':datum_end',$_POST['end_day'], PDO::PARAM_STR);
			$stmt->bindParam(':dje', $_SESSION['ID'], PDO::PARAM_STR);
		
		/*
		
			echo $oib."<br>";
			echo $_POST['lijek']."<br>";
			echo "u-".$_POST['kolicina_u']."<br>";
			echo "p-".$_POST['kolicina_p']."<br>";
			echo "n-".$_POST['quantity_n']."<br>";
			echo $_POST['day']."<br>";
			echo $_POST['end_day']."<br>";
			echo $_SESSION['ID']."<br>";
			
		*/
			
			$stmt->execute();
            $stmt->closeCursor();
 
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	
	}
		 public function updateUser()
    {
		
		
		
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
		$b_ime = $_POST['b_ime'];//ime bračnog druga
		$d_p= $_POST['first_day'];
		$gender= $_POST['gender'];
		$n_i= $_POST['no_id']; //broj osobne
		$jmbg= $_POST['jmbg'];
		$adress= $_POST['adress'];//prije dolaska
		$d_p= $_POST['first_day'];
		$brak= $_POST['brak'];
		$b_prezime= $_POST['b_prezime'];
		$d_p= $_POST['first_day'];
		$ss= $_POST['ss'];
		$zvanje= $_POST['zvanje'];
		$nap= $_POST['napomena'];
		$sk_name= $_POST['sk_name'];
		$sk_surname= $_POST['sk_surname'];
		$sk_adress= $_POST['sk_adresa'];
		$srod= $_POST['srodstvo'];
		$contact= $_POST['contact'];
 
       /* $sql = "UPDATE list_items
                SET ListText=:text
                WHERE ListItemID=:id
                LIMIT 1";*/
        $sql = "UPDATE korisnici SET Ime= :name, Prezime =:surname,Godina_rodjenja =:bday,Spol=:gender,Soba=:room,Napomena=:nap,ime_oca=:f_name,
					djevojacko_prezime=:d_prez, mjesto_rodjenja=:b_place,drzavljanstvo= :drz,jmbg=:jmbg,br_osobne=:br_os,adresa=:adress,bracno_stanje=:b_stanje,
					ime_b_druga=:b_drug_ime,prez_b_druga=:b_drug_prez,s_sprema=:ss,zvanje=:zvanje,sk_ime=:skrbnik_ime,sk_prezime=:skrbnik_prezime,
						sk_adresa =:sk_adress,sk_srodstvo=:sk_srodstvo,ugovor=:sla, czss=:czss,datum_prijema=:f_day,z_stanje=:z_stanje,kontakt=:contact, rbm = :rbm WHERE OIB = :oib";
		
		
		
		
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':oib', $oibb, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
           $stmt->bindParam(':surname', $surn, PDO::PARAM_STR);
            $stmt->bindParam(':room', $room, PDO::PARAM_INT);
			 $stmt->bindParam(':rbm', $rbm, PDO::PARAM_STR);
			$stmt->bindParam(':bday', $bday, PDO::PARAM_STR);
			$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
			
			$stmt->bindParam(':nap', $nap, PDO::PARAM_STR);
			
			
			$stmt->bindParam(':f_name', $f_name, PDO::PARAM_STR);//ime oca
			$stmt->bindParam(':d_prez', $d_surname, PDO::PARAM_STR);//djevojacko prezime
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
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
 
 	public function removeTherapy()
    {
       
		
        $sql = "DELETE FROM terapija_lijekovi WHERE ID_terapije = :id";
		
        
            
            try
            {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(':id', $_POST['ID'] , PDO::PARAM_STR);
                
				   //$stmt->bindParam(':null', $null, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
                //return "Success!";
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
               
    }
 
 public function showUserName($ID)
    {
            $sql = "select * from zaposlenici where ID_Zaposlenika = :oib";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':oib', $ID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
           
		   
		   return $row['Ime']." ".$row['Prezime'];
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
        
		
 
 
 
    }
	
			public function showProtegeName($ID)
    {
            $sql = "select * from Korisnici where OIB = :oib";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':oib', $ID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
           
		   
		   return $row['Ime']." ".$row['Prezime'];
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
        
		
 
 
 
    }
  

	
}
?>