<?php
 
session_start();
 
include_once "../../inc/constants.inc.php";
include_once "../inc/class.therapy.php";

 
if(!empty($_POST['act'])
)
{
    $listObj = new Therapy();
    switch($_POST['act'])
    {
        case 'add':
           //echo "addd";
		  echo $listObj->addTherapy();
		header("Location: " .P. "korisnici/portfolio.php?show=terapija&oib=".$_POST['oib']);
		 
            break;
        case 'update':
		//echo "KIZO";
           $listObj->updateUser();
		   header("Location: " .P. "korisnici/portfolio.php?oib=".$_POST['oib']);
            break;
        case 'delete':
            $listObj->removeTherapy();
			header("Location: " .P. "korisnici/portfolio.php?show=terapija&oib=".$_POST['oib']);
            break;
        case 'color':
            echo $listObj->changeListItemColor();
            break;
        case 'done':
            echo $listObj->toggleListItemDone();
            break;
        case 'delete':
            echo $listObj->deleteListItem();
            break;
        default:
			
            header("Location:".P."");
            break;
    }
}
else
{ 
    //header("Location: //localhost/list");
    exit;
}
 
?>