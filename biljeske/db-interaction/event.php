<?php
 
session_start();
 
include_once "../../inc/constants.inc.php";
include_once "../inc/class.event.php";

 
if(!empty($_POST['act'])
)
{
    $listObj = new Event();
    switch($_POST['act'])
    {
        case 'add':
           //echo "addd";
		  echo $listObj->addEvent();
		  header("Location: " .P. "korisnici/portfolio.php?oib=".$_POST['oib']);
		  
            break;
			
		case 'add_all':
           
		  echo $listObj->addEventAll();
		  header("Location: " .P);
		  
            break;
		case 'done':
           //echo "addd";
		  echo $listObj->doneEvent();
		    header("Location: " .P. "korisnici/portfolio.php?oib=".$_POST['oib']);
		  
            break;
			
			case 'done_all':
           //echo "addd";
		  echo $listObj->doneEvent();
		      header("Location: " .P);
		  
            break;
        case 'update':
		//echo "KIZO";
           $listObj->updateUser();
		   header("Location: " .P. "korisnici/portfolio.php?oib=".$_POST['oib']);
            break;
        case 'remove':
            $listObj->removeUser();
			header("Location: " .P. "korisnici");
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
{ echo "bok";
    //header("Location: //localhost/list");
    exit;
}
 
?>