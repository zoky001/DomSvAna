<?php

session_start();

include_once "../../inc/constants.inc.php";
include_once "../inc/class.note.php";
include_once "../pdf/Generate_pdf.php";


if (!empty($_POST['act'])
) {
    $listObj = new Note();
    $pdf = new PDF();
    switch ($_POST['act']) {
        case 'add':
            //echo "addd";
            echo $listObj->addNote();
            header("Location: " . P . "korisnici/portfolio.php?oib=" . $_POST['oib']);

            break;
        case 'add_emp':
            //echo "addd";
            echo $listObj->addNoteEmp();
            header("Location: " . P);

            break;
        case 'update':
            //echo "KIZO";
            $listObj->updateUser();
            header("Location: " . P . "korisnici/portfolio.php?oib=" . $_POST['oib']);
            break;
        case 'remove':
            $listObj->removeUser();
            header("Location: " . P . "korisnici");
            break;
        case 'pdf':
            // $listObj->CreatePDF($_POST['oib']);

            $pdf->CreateUserReport($_POST['oib'],$_POST['from'],$_POST['to']) ;
           // header("Location: " . P . "korisnici/portfolio.php?oib=" . $_POST['oib']);
            break;
        case 'pdf_all_note':
            // $listObj->CreatePDF($_POST['oib']);

            $pdf->CreateAllUserReport($_POST['from'],$_POST['to']) ;
           // header("Location: " . P . "korisnici/portfolio.php?oib=" . $_POST['oib']);
            break;
        
       
        
        case 'show_by_date':
           // echo $listObj->showByDate($_POST['oib'],$_POST['from'],$_POST['to']);
           echo "bok";
           header("Location: " . P . "korisnici/portfolio.php?oib=" . $_POST['oib']."&from=".$_POST['from']."&to=".$_POST['to']);
            break;
        case 'delete':
            echo $listObj->deleteListItem();
            break;
        default:

            header("Location:" . P . "");
            break;
    }
} else {
    echo "bok";
    //header("Location: //localhost/list");
    exit;
}
?>