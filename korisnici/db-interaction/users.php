<?php
 
session_start();
 
include_once "../../inc/constants.inc.php";
include_once "../inc/class.lists.user.inc.php";

 
if(!empty($_POST['act'])
)
{
    $listObj = new UserAna();
    switch($_POST['act'])
    {
        case 'add':
           //echo "addd";
		  echo $listObj->addUser();
		  header("Location: " .P. "korisnici");
		  
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