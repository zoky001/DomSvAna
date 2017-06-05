<?php

class UserAna
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
	
	public function loadUser()
    {
        $sql = "select * from korisnici order by Prezime";
        if($stmt = $this->_db->prepare($sql))
        {
           // $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while($row = $stmt->fetch())
            {
                $LID = $row['OIB'];
                //$URL = $row['ListURL'];
              //  echo $row['Ime'];
				
				echo $this->formatUserCard($row);
            }
            $stmt->closeCursor();
 
           
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        return array($LID);
    }

	private function formatUserCard($row)
    {
            $ss = NULL;
            $se = NULL;
        
 /*return "tttt<li id='$row[ListItemID]' rel='$order' "
            . "class='$c' color='$row[ListItemColor]'>$ss"
            . htmlentities(strip_tags($row['ListText'])).$d
            . "$se</li>n";*/
        return 	  " <div class='w3-quarter w3-margin-bottom'>
	
 <div  class='w3-card-2  w3-ripple w3-round w3-hover-shadow w3-white ' style='margin-top:10px' id=\"$row[OIB]\">
        <div class='w3-container'>
         <h4 class='w3-center'>$row[Prezime] $row[Ime]</h4>
         <p class='w3-center'><img src=\"" .P."images/avatar.png\" class='w3-circle' style='height:106px;width:106px' alt='Avatar'></p>
         <hr>
         <p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i> Korisnik</p>
         <p><i class='fa fa-home fa-fw w3-margin-right w3-text-theme'></i> $row[OIB] </p>
         <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i> $row[Godina_rodjenja]</p>
        </div>
      </div>
	  
	
	   </div>";
    }
	
	public function addUser()
    {
        $oib = $_POST['oib'];
        $name = $_POST['name'];
        $surn = $_POST['surname'];
		$room = $_POST['room'];
 
        $sql = "INSERT INTO korisnici
                    (OIB, Ime, Prezime,Soba)
                VALUES (:oib, :name, :surname, :room)";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':oib', $oib, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surn, PDO::PARAM_STR);
            $stmt->bindParam(':room', $room, PDO::PARAM_INT);
			$stmt->execute();
            $stmt->closeCursor();
 
            //return $this->_db->lastInsertId();
        }
        catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }
 
    /**
     * Returns the CSS class that determines color for the list item
     *
     * @param int $color    the color code of an item
     * @return string       the corresponding CSS class for the color code
     */
    private function getColorClass($color)
    {
        switch($color)
        {
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
	 public function updateListItem()
    {
        $listItemID = $_POST["listItemID"];
        $newValue = strip_tags(urldecode(trim($_POST["value"])), WHITELIST);
 
        $sql = "UPDATE list_items
                SET ListText=:text
                WHERE ListItemID=:id
                LIMIT 1";
        if($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':text', $newValue, PDO::PARAM_STR);
            $stmt->bindParam(':id', $listItemID, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
 
            echo $newValue;
        } else {
            echo "Error saving, sorry about that!";
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
	public function deleteListItem()
    {
        $list = $_POST['list'];
        $item = $_POST['id'];
 
        $sql = "DELETE FROM list_items
                WHERE ListItemID=:item
                AND ListID=:list
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':item', $item, PDO::PARAM_INT);
            $stmt->bindParam(':list', $list, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
 
            $sql = "UPDATE list_items
                    SET ListItemPosition=ListItemPosition-1
                    WHERE ListID=:list
                    AND ListItemPosition>:pos";
            try
            {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(':list', $list, PDO::PARAM_INT);
                $stmt->bindParam(':pos', $_POST['pos'], PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
                return "Success!";
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
	
}
?>