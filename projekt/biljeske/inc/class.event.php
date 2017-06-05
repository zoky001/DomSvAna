<?php
 
//include_once "constants.inc.php";
class Event
{
    
    private $_db;
 
 
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
	
	
			public function loadAllEvent()
    {	
        $sql = "select * from buduci_dogadjaji where Obavljeno = 0 order by Datum asc";
        if($stmt = $this->_db->prepare($sql))
        {
           //$stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
               
           
				//echo $this -> formatmodalEvent($row);
				echo $this->formatAllEvent($row);
			
				
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<p>Error:</p> ", $db->errorInfo, "</li>";
        }
 
        
    }
		public function loadUserEvent($oib)
    {	
        $sql = "select * from buduci_dogadjaji where ID_korisnika = :oib and Obavljeno = 0 order by Datum asc limit 5";
        if($stmt = $this->_db->prepare($sql))
        {
           $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
               
           
				
				echo $this->formatEvent($row);
			
				
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "<p>Error:</p> ", $db->errorInfo, "</li>";
        }
 
        
    }
private function formatAllEvent($row)
    {
		
		echo $this -> formatmodalAllEvent($row);
            
			
	if($row['Datum'] < date('Y-m-d H:i:s')):



        return " 
	  <div class='w3-card-2 w3-round w3-white w3-center' style='margin-top:10px'>
        <div class='w3-container ' >
          <p >  <b> $row[Naslov] </b> </p>
         <img src='".P."images/attention.png' alt='Forrst' style='width:50%;'>
         
          <p style='margin-top:5px'>  $row[Datum]</p>
		  
		 
	
          <p><button onclick='document.getElementById(\"$row[ID_event]\").style.display=\"block\"' class='w3-btn w3-btn-block w3-theme-l4'>Info</button></p>
     
       
        </div>
      </div>
	  ";
	  
	  else:
	  
	      return " 
	  <div class='w3-card-2 w3-round w3-white w3-center' style='margin-top:10px'>
        <div class='w3-container ' >
          <p >  <b> $row[Naslov] </b> </p>
          <img src='".P."images/event.jpg' alt='Event' style='width:50%;'>
         
          <p style='margin-top:5px'>  $row[Datum]</p>
		  
		 
	
          <p><button onclick='document.getElementById(\"$row[ID_event]\").style.display=\"block\"' class='w3-btn w3-btn-block w3-theme-l4'>Info</button></p>
     
       
        </div>
      </div>
	  ";
	  
 
 endif; 
 
    }
	private function formatmodalAllEvent($row)
    {
            
        return " 
<!-- modal add new user -->
  <div id='$row[ID_event]' class='w3-modal w3-center' style = 'width:300 height:200'>
    <div class='w3-modal-content w3-card-32 w3-animate-zoom' >

      <div class='w3-center'><br>
	  
	  <b class='w3-xlarge'> $row[Naslov] </b> <br>
        <span onclick='document.getElementById(\"$row[ID_event]\").style.display=\"none\"' class='w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright' title='Close Modal'>&times;</span>
        <img src='".P."images/event.jpg' alt='Avatar' style='width:30%' class='w3-circle w3-margin-top'>
      </div>
 <!-- begin form for insert data -->
 <form class='w3-container'   action='".P."biljeske/db-interaction/event.php'  method='post'  >
		   
		   
		   <input type='hidden' id='12' name='act' value='done_all' /> 
		      <input type='hidden' id='142' name='ID_event' value=$row[ID_event] /> 
		  
			     <input type='hidden' id='142' name='oib' value=$row[ID_korisnika] /> 
			
		 
		   
		
		   
		   
		   
	  <label class='w3-left' ><b class='w3-large'> Vrijeme: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[Datum]'  name='title' disabled >
        <div class='form-group'>
		 <label class='w3-left' ><b class='w3-large'> Opis: </b></label>
          <textarea class='form-control' rows='3' name = 'tekst' disabled>  $row[Tekst]</textarea>
        </div>
		<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Događaj zapisao: </b>".$this->showUserName($row['ID_djelatnika'])."  <p></div>
		
		
        <button type='submit' class='w3-btn-block w3-green w3-round-large w3-section w3-padding'>Označi kao obavljeno</button>
      </form>

      <div class='w3-container w3-border-top w3-padding-16 w3-light-grey'>
        <button onclick='document.getElementById(\"$row[ID_event]\").style.display=\"none\"' type='button' class='w3-btn w3-round-large w3-red'>Odustani</button>
       
      </div>

    </div>

  </div>
	  ";
 
 
 
    }
	private function formatEvent($row)
    {
		
		echo $this -> formatmodalEvent($row);
            
			
	if($row['Datum'] < date('Y-m-d H:i:s')):



        return " 
	  <div class='w3-card-2 w3-round w3-white w3-center' style='margin-top:10px'>
        <div class='w3-container ' >
          <p >  <b> $row[Naslov] </b> </p>
         <img src='".P."images/attention.png' alt='Forrst' style='width:50%;'>
         
          <p style='margin-top:5px'>  $row[Datum]</p>
		  
		 
	
          <p><button onclick='document.getElementById(\"$row[ID_event]\").style.display=\"block\"' class='w3-btn w3-btn-block w3-theme-l4'>Info</button></p>
     
       
        </div>
      </div>
	  ";
	  
	  else:
	  
	      return " 
	  <div class='w3-card-2 w3-round w3-white w3-center' style='margin-top:10px'>
        <div class='w3-container ' >
          <p >  <b> $row[Naslov] </b> </p>
          <img src='".P."images/event.jpg' alt='Event' style='width:50%;'>
         
          <p style='margin-top:5px'>  $row[Datum]</p>
		  
		 
	
          <p><button onclick='document.getElementById(\"$row[ID_event]\").style.display=\"block\"' class='w3-btn w3-btn-block w3-theme-l4'>Info</button></p>
     
       
        </div>
      </div>
	  ";
	  
 
 endif; 
 
    }
	
	private function formatmodalEvent($row)
    {
            
        return " 
<!-- modal add new user -->
  <div id='$row[ID_event]' class='w3-modal w3-center' style = 'width:300 height:200'>
    <div class='w3-modal-content w3-card-32 w3-animate-zoom' >

      <div class='w3-center'><br>
	  
	  <b class='w3-xlarge'> $row[Naslov] </b> <br>
        <span onclick='document.getElementById(\"$row[ID_event]\").style.display=\"none\"' class='w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright' title='Close Modal'>&times;</span>
        <img src='".P."images/event.jpg' alt='Avatar' style='width:30%' class='w3-circle w3-margin-top'>
      </div>
 <!-- begin form for insert data -->
 <form class='w3-container'   action='".P."biljeske/db-interaction/event.php'  method='post'  >
		   
		   
		   <input type='hidden' id='12' name='act' value='done' /> 
		      <input type='hidden' id='142' name='ID_event' value=$row[ID_event] /> 
		  
			     <input type='hidden' id='142' name='oib' value=$row[ID_korisnika] /> 
			
		 
		   
		
		   
		   
		   
	  <label class='w3-left' ><b class='w3-large'> Vrijeme: </b></label>
          <input class='w3-input w3-border w3-margin-bottom w3-margin-bottom' type='text' value = '$row[Datum]'  name='title' disabled >
        <div class='form-group'>
		 <label class='w3-left' ><b class='w3-large'> Opis: </b></label>
          <textarea class='form-control' rows='3' name = 'tekst' disabled>  $row[Tekst]</textarea>
        </div>
		<div class='w3-left-align'><p class ='w3-medium '><b class='w3-medium'>Događaj zapisao: </b>".$this->showUserName($row['ID_djelatnika'])."  <p></div>
		
		
        <button type='submit' class='w3-btn-block w3-green w3-round-large w3-section w3-padding'>Označi kao obavljeno</button>
      </form>

      <div class='w3-container w3-border-top w3-padding-16 w3-light-grey'>
        <button onclick='document.getElementById(\"$row[ID_event]\").style.display=\"none\"' type='button' class='w3-btn w3-round-large w3-red'>Odustani</button>
       
      </div>

    </div>

  </div>
	  ";
 
 
 
    }
			
	public function loadAllEmpNote()
    {
        $sql = "select * from zaposlenici_biljeske WHERE `Datum` > DATE_SUB(NOW(),INTERVAL 7 DAY) order by Datum desc ";
        if($stmt = $this->_db->prepare($sql))
        {
           
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
                $ID_note = $row['ID_biljeske'];
           
				
				echo $this->formatAllEmpNote($row);
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        
    }
			
				private function formatAllEmpNote($row)
    {
            
        return "   <div class='col-sm-12 w3-panel w3-round-xlarge w3-sand' >
     
	  <p class='w3-xxlarge'>  $row[Naslov]  </p>
	  
      <h5><span class='glyphicon glyphicon-time'></span> Napisao: ".$this->showUserName($row['ID_djelatnika']).", $row[Datum]</h5>
      <hr>
      <p>$row[Tekst]</p>
      <br><br>
	  </div>
	  ";
 
 
 
    }
			
			public function loadAllNote()
    {
        $sql = "select * from korisnici_biljeske WHERE `Datum` > DATE_SUB(NOW(),INTERVAL 7 DAY) order by Datum desc ";
        if($stmt = $this->_db->prepare($sql))
        {
           
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
                $ID_note = $row['ID_biljeske'];
           
				
				echo $this->formatAllNote($row);
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        
    }
	private function formatAllNote($row)
    {
            
        return "   <div class='col-sm-12 w3-panel w3-round-xlarge w3-sand' >
     
	  <h3>  <span class='w3-xxlarge'> <a href = '".P."korisnici/portfolio.php?oib=$row[ID_korisnika]' > ".$this->showProtegeName($row['ID_korisnika'])." </a> </span> - $row[Naslov]</h3>
	  
      <h5><span class='glyphicon glyphicon-time'></span> Napisao: ".$this->showUserName($row['ID_djelatnika']).", $row[Datum]</h5>
      <hr>
      <p>$row[Tekst]</p>
      <br><br>
	  </div>
	  ";
 
 
 
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
	
	public function addNoteEmp()
    {
		//$_SESSION['Username']
		//$datum =  date('m/d/Y h:i:s a', time());
		$datum  = date('Y-m-d H:i:s');
	$oib = $_POST['oib'];
	$sql = "INSERT INTO zaposlenici_biljeske (Naslov, Tekst, Datum, ID_djelatnika) 
		                    VALUES (:naslov,:tekst, :datum,  :dje)";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':naslov', $_POST['title'], PDO::PARAM_STR);
            $stmt->bindParam(':tekst', $_POST['tekst'], PDO::PARAM_STR);
            $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
           
			$stmt->bindParam(':dje', $_SESSION['ID'], PDO::PARAM_STR);
		
		
			
		
			
			$stmt->execute();
            $stmt->closeCursor();
 
            //return $this->_db->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	
	}
	public function addEvent()
    {
		//$_SESSION['Username']
		//$datum =  date('m/d/Y h:i:s a', time());
		$datum  = date('Y-m-d');
	$oib = $_POST['oib'];
	$sql = "INSERT INTO buduci_dogadjaji (Naslov, Tekst, Datum, ID_djelatnika, ID_korisnika) 
		                    VALUES (:naslov,:tekst, :datum, :dje,:kor )";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':naslov', $_POST['title'], PDO::PARAM_STR);
            $stmt->bindParam(':tekst', $_POST['tekst'], PDO::PARAM_STR);
            $stmt->bindParam(':datum', $_POST['daytime'], PDO::PARAM_STR);
            $stmt->bindParam(':kor', $oib, PDO::PARAM_STR);
			$stmt->bindParam(':dje', $_SESSION['ID'], PDO::PARAM_STR);
		
		
			
		
			
			$stmt->execute();
            $stmt->closeCursor();
 
            //return $this->_db->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	
	}
		public function addEventAll()
    {
		//$_SESSION['Username']
		//$datum =  date('m/d/Y h:i:s a', time());
		$datum  = date('Y-m-d');
	$oib = $_POST['oib'];
	$sql = "INSERT INTO buduci_dogadjaji (Naslov, Tekst, Datum, ID_djelatnika) 
		                    VALUES (:naslov,:tekst, :datum, :dje)";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':naslov', $_POST['title'], PDO::PARAM_STR);
            $stmt->bindParam(':tekst', $_POST['tekst'], PDO::PARAM_STR);
            $stmt->bindParam(':datum', $_POST['daytime'], PDO::PARAM_STR);
            
			$stmt->bindParam(':dje', $_SESSION['ID'], PDO::PARAM_STR);
		
		
			
		
			
			$stmt->execute();
            $stmt->closeCursor();
 
            //return $this->_db->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	
	}
		
		public function doneEvent()
    {
		//$_SESSION['Username']
		//$datum =  date('m/d/Y h:i:s a', time());
		
		$datum  = date('Y-m-d H:i:s');
	$ID = $_POST['ID_event'];
	$sql = "UPDATE buduci_dogadjaji SET Obavljeno = 1, Vrijeme_obavljanja = :datum where ID_event = :id";
        try
        {
            $stmt = $this->_db->prepare($sql);
          
            $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
			$stmt->bindParam(':id', $ID, PDO::PARAM_STR);
            
		
		
			
		
			
			$stmt->execute();
            $stmt->closeCursor();
 
            //return $this->_db->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
	
	}
}
?>