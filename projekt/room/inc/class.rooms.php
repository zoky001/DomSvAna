<?php
include_once "../common/base.php";
class Rooms
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
	
	public function loadRoom()
    {
        $sql = "select * from Sobe order by Odjel";
        if($stmt = $this->_db->prepare($sql))
        {
           // $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while($row = $stmt->fetch())
            {
              //  $LID = $row['Broj_sobe'];
                //$URL = $row['ListURL'];
              //  echo $row['Ime'];
				
				echo $this->formatRoomCard($row);
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>";
        }
 
        
    }
//<button class='w3-button w3-block w3-black w3-margin-bottom' > Više..</button>
	private function formatRoomCard($row)
    {
            
        
 /*return "tttt<li id='$row[ListItemID]' rel='$order' "
            . "class='$c' color='$row[ListItemColor]'>$ss"
            . htmlentities(strip_tags($row['ListText'])).$d
            . "$se</li>n";*/
        return 	  "<div class='w3-third w3-card-12 w3-white w3-margin-bottom'>
      <img src='$row[pictures]' alt='room_pic' style='width:100%; height:200px'>
      <div class='w3-container w3-white'>
        <h3>Soba: $row[Broj_sobe]</h3>
		<h3>".$this-> RoomNum($row['Broj_kreveta'])."</h3>
        <h6 >Broj kreveta: $row[Broj_kreveta] </h6>
		<h6 >Odjel: $row[Odjel] </h6>
        <h6 >Slobodni kreveti: ".$this->NumFreeBedInRoom ($row['Broj_sobe'])  ." </h6>
        <p>Površina: $row[Povrsina]m<sup>2</sup></p>
        
		 <a href='".P."room/room.php?num_room=$row[Broj_sobe]' target='iframe_a'> <button class='w3-button w3-block w3-black w3-margin-bottom'>   Više...  </button></a>
        
      </div>
    </div>";
    }
	
	
	private function RoomNum($no)
    {
             switch($no)
    {
        case '1':
           
		  return "Jednokrevetna soba";
		  
		  
            break;
			
		case '2':
           
			return "Dvokrevetna soba";
		  
		  
            break;
		case '3':
           
		  return "Trokrevetna soba";
		  
		  
            break;
			
		case '4':
           
		  return "Četverokrevetna soba";
		      
		  
            break;
        case '5':
		
           return "Peterokrevetna soba";
		   
            break;
       
        default:
			
            return $no." - krevetna soba";
            break;
        
 
	}
    }
	
	public function NumFreeBedInRoom ($id)
	
	{
		  $sql = "select * from sobe_i_s_kreveti where Broj_sobe =  :id ";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
          
            if($row = $stmt->fetch())
            {
              
              return $row['Broj slobodnih kreveta'];
				
				
            }
			else {return 0;}
			
			
			
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>";
        }
		
		
	}
	
	public function FormatContent($num_room)
    {
		
		
        $sql = "select * from Sobe where Broj_sobe = :num ";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':num', $num_room, PDO::PARAM_STR);
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
              
				
				echo "
				<!-- Slideshow Header -->
  <div class='w3-container' id='apartment'>
    <h2 class='w3-text-green'>". $this->RoomNum($row['Broj_kreveta'])."</h2>
    <div class='w3-display-container mySlides'>
    <img src='$row[pictures]' style='width:100%;margin-bottom:-6px'>
      <div class='w3-display-bottomleft w3-container w3-black'>
        <p>Soba: $row[Broj_sobe]</p>
      </div>
    </div>
    <div class='w3-display-container mySlides'>
    <img src='/w3images/diningroom.jpg' style='width:100%;margin-bottom:-6px'>
      <div class='w3-display-bottomleft w3-container w3-black'>
        <p>Dining Room</p>
      </div>
    </div>
    <div class='w3-display-container mySlides'>
    <img src='/w3images/bedroom.jpg' style='width:100%;margin-bottom:-6px'>
      <div class='w3-display-bottomleft w3-container w3-black'>
        <p>Bedroom</p>
      </div>
    </div>
    <div class='w3-display-container mySlides'>
    <img src='/w3images/livingroom2.jpg' style='width:100%;margin-bottom:-6px'>
      <div class='w3-display-bottomleft w3-container w3-black'>
        <p>Living Room II</p>
      </div>
    </div>
  </div>
  
  
  <div class='w3-row-padding w3-section'>
    <div class='w3-col s3'>
      <img class='demo w3-opacity w3-hover-opacity-off' src='$row[pictures]' style='width:100%;cursor:pointer' onclick='currentDiv(1)' title='Room'>
    </div>
    <div class='w3-col s3'>
      <img class='demo w3-opacity w3-hover-opacity-off' src='/w3images/diningroom.jpg' style='width:100%;cursor:pointer' onclick='currentDiv(2)' title='Dining room'>
    </div>
    <div class='w3-col s3'>
      <img class='demo w3-opacity w3-hover-opacity-off' src='/w3images/bedroom.jpg' style='width:100%;cursor:pointer' onclick='currentDiv(3)' title='Bedroom'>
    </div>
    <div class='w3-col s3'>
      <img class='demo w3-opacity w3-hover-opacity-off' src='/w3images/livingroom2.jpg' style='width:100%;cursor:pointer' onclick='currentDiv(4)' title='Second Living Room'>
    </div>
  </div>
				
				";
           echo $this->FormatInfo($row); 
		   
		   }
            
			
			
			$stmt->closeCursor();
 
           
        }
        else
        {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>";
        }
 
        
    }
	
	private function FormatInfo($row)
    {
            
        $free = $this->NumFreeBedInRoom($row['Broj_sobe']);
		$res = $row['Broj_kreveta'] - $free;

        return 	  "<div class='w3-container'>
    <h4><strong>Informacije</strong></h4>
    <div class='w3-row w3-large'>
      <div class='w3-col s6'>
        <p><i class='fa fa-fw fa-male'></i> Trenutni broj smještenih: ".$res." </p>
        
        <p><i class='fa fa-fw fa-bed'></i> Broj slobodnih kreveta: ".$free."</p>
		<p><i class='fa fa-fw fa-female '></i>Spol: $row[Muska_zenska]</p>
        <p><i class='fa fa-bank'></i> Odjel: $row[Odjel]</p>
		<p><i class='fa fa-cube'></i> Površina sobe: $row[Povrsina]m<sup>2</sup></p>
      </div>
      <div class='w3-col s6'>
        <p><i class='fa fa-fw fa-shower'></i> Kupaonica</p>
        
        <p><i class='fa fa-fw fa-tv'></i> TV priključak</p>
		
        <p><i class='fa fa-fw fa-thermometer'></i> Grijanje</p>
        <p><i class='fa fa-fw fa-wheelchair'></i> Pristupačno kolicima</p>
			
      </div>
    </div>
    <hr>
   
    
    <h4><strong>Opis</strong></h4>
    <p>$row[Opis]</p>
   
    <hr>
    
   
  </div>";
    }
	
	
	
	private function formatRemoveUser($oib)
	
	{ 
		      
		  $D=date("Y-m-d");
		  
		 // echo $D;
		
	echo " <!-- modal add new user -->
	
	<div class='w3-container w3-center w3-right' >
  <div id='id11' class='w3-modal' style = 'width:300 height:200'>
    <div class='w3-modal-content w3-card-32 w3-animate-zoom' >

      <div class='w3-center'><br>
        <span onclick=\"document.getElementById('id11').style.display='none'\" class='w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright' title='Close Modal'>&times;</span>
       
      </div>
 <!-- begin form for insert data -->
      <form class='w3-container'   action='".P."korisnici/db-interaction/users.php'  method='post' value ='add' >
	<input type='hidden' id='12' name='act' value='remove' />
        <div class='w3-section'>
		
		   <div class='w3-container'style='margin-left:-17px'>
		   <label class='w3-left' ><b>Datum odlaska iz doma:</b></label>
		    
		   </div>
		    <input  type='hidden' value = '".$oib."' name='oib'  >
		   
		    <div class='w3-container'style='margin-left:-17px;'>
		   <label class='w3-left' >
		
		    <input class = 'w3-date w3-border w3-margin-bottom'  type='date' value ='".$D."'  name='rest_day' required>
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
	
	
	
	
	
	public function addRoom()
    {
       //upload slike
			
			
			
			$target_dir = "D:/xampp/htdocs/ostalo/room/images/";
			$target_dir1 = P."room/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file1 = $target_dir1 . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if ($target_file1 == $target_dir1 )
{
$target_file = $target_dir."room.png";
$target_file1 = $target_dir1."room.png";
	

	
	
}

else {

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
		
		
        $uploadOk = 0;
    }
}



	
	

// Check if file already exists 

$i = 1;
while (file_exists($target_file)) {
    $target_file1 =$target_dir1 .$i.  basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir .$i. basename($_FILES["fileToUpload"]["name"]);
	$i++;
    $uploadOk = 1;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}




// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}
		
	
		
		
		
		
 
        $sql = "INSERT INTO sobe (Broj_sobe, Broj_kreveta, Muska_zenska, Odjel, Opis, Povrsina, pictures) 
		                    VALUES (:no_room,:no_bed,:gender,:odjel, :opis, :pov, :pic)";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':no_room', $_POST['no_room'], PDO::PARAM_STR);
            $stmt->bindParam(':no_bed', $_POST['no_bed'], PDO::PARAM_STR);
            $stmt->bindParam(':gender', $_POST['gender'], PDO::PARAM_STR);
            $stmt->bindParam(':odjel', $_POST['odjel'], PDO::PARAM_STR);
			$stmt->bindParam(':opis', $_POST['opis'], PDO::PARAM_STR);
			$stmt->bindParam(':pov', $_POST['m2'], PDO::PARAM_INT);
			$stmt->bindParam(':pic', $target_file1, PDO::PARAM_STR);
			
			
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
 
 	public function removeUser()
    {
        $oib = $_POST['oib'];
        $day = $_POST['rest_day'];
        $nap = $_POST['napomena'];
		$adr = $_POST['new_adress'];
		$status = "Napustio";
		$null = "NULL";
		
        $sql = "UPDATE korisnici SET status= :status, Soba = NULL,  datum_odlaska = :date,
					razlog =:razlog, nova_adresa = :adress WHERE OIB = :oib";
		
        
            
            try
            {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(':status', $status , PDO::PARAM_STR);
                $stmt->bindParam(':date', $day, PDO::PARAM_STR);
				 $stmt->bindParam(':razlog', $nap, PDO::PARAM_STR);
				  $stmt->bindParam(':adress', $adr, PDO::PARAM_STR);
				   $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
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
 
 
	
	
	public function changeListItemPosition()
    {
        $listid = (int) $_POST['currentListID'];
        $startPos = (int) $_POST['startPos'];
        $currentPos = (int) $_POST['currentPos'];
        $direction = $_POST['direction'];
 
        if($direction == 'up')
        {
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
        }
        else
        {
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
	 public function changeListItemColor()
    {
        $sql = "UPDATE list_items
                SET ListItemColor=:color
                WHERE ListItemID=:item
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':color', $_POST['color'], PDO::PARAM_INT);
            $stmt->bindParam(':item', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            return TRUE;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

	
 
 public function toggleListItemDone()
    {
        $sql = "UPDATE list_items
                SET ListItemDone=:done
                WHERE ListItemID=:item
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':done', $_POST['done'], PDO::PARAM_INT);
            $stmt->bindParam(':item', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            return TRUE;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

	
}
?>