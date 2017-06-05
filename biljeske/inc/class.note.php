<?php

//include_once "constants.inc.php";
//include_once "pdf/create_pdf.php";

class Note {

    public $_db;

    public function __construct($db = NULL) {
        if (is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    public function loadUserNote($oib) {
        $sql = "select * from korisnici_biljeske where ID_korisnika = :oib order by Datum desc limit 10";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $ID_note = $row['ID_biljeske'];


                echo $this->formatNote($row);
            }
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    public function showByDate($oib, $from, $to) {
        $sql = "select * from korisnici_biljeske where ID_korisnika = :oib and (Datum BETWEEN :from AND :to)  order by Datum desc";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->bindParam(':from', $from, PDO::PARAM_STR);
            $stmt->bindParam(':to', $to, PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $ID_note = $row['ID_biljeske'];


                echo $this->formatNote($row);
            }
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    private function formatNote($row) {

        $date = date_create($row['Datum']);
        $datum = date_format($date, 'd. m. Y.');

        return "   <div class='col-sm-12 w3-panel w3-round-xlarge w3-sand' >
     
	  <h2> $row[Naslov]</h2>
	  
      <h5><span class='glyphicon glyphicon-time'></span> Napisao: " . $this->showUserName($row['ID_djelatnika']) . ", " . $datum . "</h5>
      <hr>
      <p>$row[Tekst]</p>
      <br><br>
	  </div>
	  ";
    }

    public function loadAllEmpNote() {
        $sql = "select * from zaposlenici_biljeske WHERE `Datum` > DATE_SUB(NOW(),INTERVAL 7 DAY) order by Datum desc ";
        if ($stmt = $this->_db->prepare($sql)) {

            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $ID_note = $row['ID_biljeske'];


                echo $this->formatAllEmpNote($row);
            }
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    private function formatAllEmpNote($row) {
        $date = date_create($row['Datum']);
        $datum = date_format($date, 'd. m. Y. H:i:s');
        
        return "   <div class='col-sm-12 w3-panel w3-round-xlarge w3-sand' >
     
	  <p class='w3-xxlarge'>  $row[Naslov]  </p>
	  
      <h5><span class='glyphicon glyphicon-time'></span> Napisao: " . $this->showUserName($row['ID_djelatnika']) . ", ".$datum."</h5>
      <hr>
      <p>$row[Tekst]</p>
      <br><br>
	  </div>
	  ";
    }

    public function loadAllNote() {
        $sql = "select * from korisnici_biljeske WHERE `Datum` > DATE_SUB(NOW(),INTERVAL 7 DAY) order by Datum desc ";
        if ($stmt = $this->_db->prepare($sql)) {

            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $ID_note = $row['ID_biljeske'];


                echo $this->formatAllNote($row);
            }
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    private function formatAllNote($row) {
        
          $date = date_create($row['Datum']);
        $datum = date_format($date, 'd. m. Y. H:i:s');

        return "   <div class='col-sm-12 w3-panel w3-round-xlarge w3-sand' >
     
	  <h3>  <span class='w3-xxlarge'> <a href = '" . P . "korisnici/portfolio.php?oib=$row[ID_korisnika]' > " . $this->showProtegeName($row['ID_korisnika']) . " </a> </span> - $row[Naslov]</h3>
	  
      <h5><span class='glyphicon glyphicon-time'></span> Napisao: " . $this->showUserName($row['ID_djelatnika']) . ", ".$datum."</h5>
      <hr>
      <p>$row[Tekst]</p>
      <br><br>
	  </div>
	  ";
    }

    public function showUserName($ID) {
        $sql = "select * from zaposlenici where ID_Zaposlenika = :oib";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $ID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();


            return $row['Ime'] . " " . $row['Prezime'];
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    public function showProtegeName($ID) {
        $sql = "select * from Korisnici where OIB = :oib";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $ID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();


            return $row['Ime'] . " " . $row['Prezime'];
            $stmt->closeCursor();
        } else {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    public function addNoteEmp() {
        //$_SESSION['Username']
        //$datum =  date('m/d/Y h:i:s a', time());
        $datum = date('Y-m-d H:i:s');
        $oib = $_POST['oib'];
        $sql = "INSERT INTO zaposlenici_biljeske (Naslov, Tekst, Datum, ID_djelatnika) 
		                    VALUES (:naslov,:tekst, :datum,  :dje)";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':naslov', $_POST['title'], PDO::PARAM_STR);
            $stmt->bindParam(':tekst', $_POST['tekst'], PDO::PARAM_STR);
            $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);

            $stmt->bindParam(':dje', $_SESSION['ID'], PDO::PARAM_STR);





            $stmt->execute();
            $stmt->closeCursor();

            //return $this->_db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addNote() {
        //$_SESSION['Username']
        //$datum =  date('m/d/Y h:i:s a', time());
        $datum = date('Y-m-d H:i:s');
        $oib = $_POST['oib'];
        $sql = "INSERT INTO korisnici_biljeske (Naslov, Tekst, Datum, ID_korisnika, ID_djelatnika) 
		                    VALUES (:naslov,:tekst, :datum, :kor, :dje)";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':naslov', $_POST['title'], PDO::PARAM_STR);
            $stmt->bindParam(':tekst', $_POST['tekst'], PDO::PARAM_STR);
            $stmt->bindParam(':datum', $datum, PDO::PARAM_STR);
            $stmt->bindParam(':kor', $oib, PDO::PARAM_STR);
            $stmt->bindParam(':dje', $_SESSION['ID'], PDO::PARAM_STR);





            $stmt->execute();
            $stmt->closeCursor();

            //return $this->_db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function CreatePDF($oib) {

        $sql = "select * from korisnici_biljeske where ID_korisnika = :oib order by Datum desc limit 10";
        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->execute();

            $pdf = new PDF();

            $title = 'Izvjestaj korisnika';
            $pdf->SetTitle($title);
            $pdf->SetAuthor('Zoran Hrnčić');
            $pdf->AddPage();
            $i = 1;
            while ($row = $stmt->fetch()) {

                $pdf->PrintChapter($i++, $row['Naslov'], $row['Tekst'], $this->showProtegeName($row['ID_korisnika']), $this->showUserName($row['ID_djelatnika']), $row['Datum']);
                //$pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt',1,'A RUNAWAY REEF','20k_c1.txt');
            }

            $pdf->Output();
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

}

/*
  $pdf = new PDF();
  $title = '20000 Leagues Under the Seas';
  $pdf->SetTitle('fdfdsfd');
  $pdf->SetAuthor('Jules Verne');
  $pdf->AddPage();

  $pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt',1,'A RUNAWAY REEF','20k_c1.txt');
  $pdf->PrintChapter(2,'THE PROS AND CONS','20k_c2.txt',1,'A RUNAWAY REEF','20k_c1.txt');

  //$pdf->PrintChapter('$i++', '$row[]', '$row[]', '$this->showProtegeName($row',' $this->showUserName(',' $row[Datum])');



  $pdf->Output();


  // */
?>