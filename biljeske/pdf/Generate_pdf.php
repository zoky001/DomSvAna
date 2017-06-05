<?php

require('fpdf.php');
//include_once "../inc/constants.inc.php";
include_once "../inc/class.note.php";

class PDF extends FPDF {

    private $title;

    function Header() {
        //global $title;
        // Arial bold 15
        //$this->Image('logo.png',10,6,30);

        $this->SetFont('Arial', 'B', 15);
        // Calculate width of title and position
        $w = $this->GetStringWidth($this->title) + 6;
        $this->SetX((210 - $w) / 2);
        // Colors of frame, background and text
        $this->SetDrawColor(0, 80, 180);
        $this->SetFillColor(230, 230, 0);
        $this->SetTextColor(220, 50, 50);
        // Thickness of frame (1 mm)
        $this->SetLineWidth(1);
        // Title
        $this->Cell($w, 9, $this->title, 1, 1, 'C', true);
        // Line break
        $this->Ln(15);
    }

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0, 10, 'Stranica ' . $this->PageNo(), 0, 0, 'C');
    }

    function ChapterTitle($num, $user, $title) {
        // Arial 12
        $this->SetFont('Arial', '', 14);
        // Background color
        $this->SetFillColor(200, 220, 255);
        // Title
        $this->Cell(0, 6, "$num. $user - $title ", 0, 1, 'L', true);
        // Line break
        $this->Ln(4);
    }

    function ChapterBody($file, $author, $date) {
        // Read text file
        //$txt = file_get_contents($file);
        // Times 12
        $this->SetFont('Times', '', 12);
        // Output justified text
        $this->MultiCell(0, 5, $file);
        // Line break
        $this->Ln();
        // Mention in italics
        $this->SetFont('', 'I');
        $this->Cell(0, 5, "(Napisao: $author, $date)");

        $this->Ln();
        $this->Ln();
    }

    function PrintChapter($num, $title, $file, $user, $author, $date) {
        //$this->AddPage();
        $this->ChapterTitle($num, $user, $title);
        $this->ChapterBody($file, $author, $date);
    }

    public function CreateUserReport($oib, $from, $to) {
        $note = new Note();

        $sql = "select * from korisnici_biljeske where ID_korisnika = :oib and (Datum BETWEEN :from AND :to) order by Datum desc";
        if ($stmt = $note->_db->prepare($sql)) {
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->bindParam(':from', $from, PDO::PARAM_STR);
            $stmt->bindParam(':to', $to, PDO::PARAM_STR);
            $stmt->execute();

            // $pdf = new PDF();

            $this->title = $this->ReplaceLetter('Izvještaj korisnika - ' . $this->ReplaceLetter($note->showProtegeName($oib)));
            //$pdf->SetTitle($title);
            $this->SetAuthor('');
            $this->AddPage();
            $i = 1;
            while ($row = $stmt->fetch()) {

                $this->PrintChapter($i++, $this->ReplaceLetter($row['Naslov']), $this->ReplaceLetter($row['Tekst']), $this->ReplaceLetter($note->showProtegeName($row['ID_korisnika'])), $this->ReplaceLetter($note->showUserName($row['ID_djelatnika'])), $row['Datum']);
                //$pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt',1,'A RUNAWAY REEF','20k_c1.txt');
            }

            $this->Output();
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    public function CreateAllUserReport($from, $to) {
        $note = new Note();

        $sql = "select * from korisnici_biljeske where (Datum BETWEEN :from AND :to) order by Datum desc";
        if ($stmt = $note->_db->prepare($sql)) {
            
            $stmt->bindParam(':from', $from, PDO::PARAM_STR);
            $stmt->bindParam(':to', $to, PDO::PARAM_STR);
            $stmt->execute();

            // $pdf = new PDF();

            $this->title = $this->ReplaceLetter('Izvještaj svih korisnika: '.$from.' - '.$to );
            //$pdf->SetTitle($title);
            $this->SetAuthor('');
            $this->AddPage();
            $i = 1;
            while ($row = $stmt->fetch()) {

                $this->PrintChapter($i++, $this->ReplaceLetter($row['Naslov']), $this->ReplaceLetter($row['Tekst']), $this->ReplaceLetter($note->showProtegeName($row['ID_korisnika'])), $this->ReplaceLetter($note->showUserName($row['ID_djelatnika'])), $row['Datum']);
                //$pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt',1,'A RUNAWAY REEF','20k_c1.txt');
            }

            $this->Output();
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
    }

    public function ReplaceLetter($text) {

        $text = str_replace("č", "c", $text);
        $text = str_replace("ć", "c", $text);
        $text = str_replace("đ", "dj", $text);
        $text = str_replace("š", "s", $text);
        $text = str_replace("ž", "z", $text);

        $text = str_replace("Č", "C", $text);
        $text = str_replace("Ć", "C", $text);
        $text = str_replace("Đ", "Dj", $text);
        $text = str_replace("Š", "S", $text);
        $text = str_replace("Ž", "Z", $text);


        $text = str_replace("č", "c", $text);
        return $text;
    }

}

//$pdf = new PDF();
//$title = "dva anslova";
//$title = "naslovsaf";
//$pdf->CreateUserReport('12345678901');
//echo $pdf->ReplaceLetter('mačak u željeznim čižmama i šarenom badiću u Đakovu');

/*
  $title = '20000 Leagues Under the Seas';
  $pdf->SetTitle($title);
  $pdf->SetAuthor('Jules Verne');
  $pdf->PrintChapter(1, 'A RUNAWAY REEF', '20k_c1.txt', 1, 'A RUNAWAY REEF', '20k_c1.txt');
  $pdf->PrintChapter(2, 'THE PROS AND CONS', '20k_c2.txt', 1, 'A RUNAWAY REEF', '20k_c1.txt');
  $pdf->Output(); */
?>