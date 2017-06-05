  

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
<link rel="stylesheet" href="<?php
include_once "../inc/constants.inc.php";
echo P;
?>w3.css">





<div class="col-sm-12 w3-panel w3-round-xlarge w3-light-grey" id="biljeske">

    <div class="col-sm-12 w3-panel w3-round-xlarge w3-white" id="biljeske">

        <form class="w3-container"   action="<?php echo P; ?>biljeske/db-interaction/note.php"  method="post" value ="add" >
            <input type='hidden' id='12' name='act' value='add' /> 
            <input type='hidden' id='11' name='oib' value= '<?php echo $_GET["oib"]; ?>' /> 
            <label class="w3-left" ><b>Naslov: </b></label>
            <input class="w3-input w3-border w3-margin-bottom w3-margin-bottom" type="text" placeholder="" name="title" required >
            <div class="form-group">
                <label class="w3-left" ><b>Tekst: </b></label>
                <textarea class="form-control" rows="3" name = "tekst" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Dodaj novu bilješku</button>
        </form>
        <br>




    </div >



    <form class="w3-container w3-margin-top"   action="<?php echo P; ?>biljeske/db-interaction/note.php"  method="post" value ="add" >

        <input type='hidden' id='11' name='oib' value= '<?php echo $_GET["oib"]; ?>' /> 

        <table class="w3-table-all w3-card-4" style="margin-top:10px">
            <tr>
                <th>Od:</th>
                <th>Do:</th>
                <th>Akcija</th>


            </tr>
            <tr>

                <td> <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="from" required> </td>
                <td> <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="to" required> </td>
                <td>

                    

                        <section class = 'w3-row-padding'>

                            <section class = 'w3-half'>
                             <button type="submit" target = "_blank"  name = "act" value='pdf' class="btn btn-success">Preuzmi izvještaj</button>

                            </section>
                            <section class = 'w3-half'>

                               <button type="submit" target = "" name = "act" value='show_by_date' class="btn btn-success">Prikaži rezultate</button>
                            </section>


                        </section>




                    




                </td>
            </tr>


        </table>


    </form>
    <br>







    <?php
    if (isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])): {

            include_once 'inc/class.note.php';
            $lists = new Note();
if(isset($_GET['from']) && $_GET['to']):
    $lists->showByDate($_GET["oib"], $_GET['from'], $_GET['to']);
    
else:
            $lists->loadUserNote($_GET["oib"]);
   endif;     
   
   
   
   
    }
        ?>
    <?php endif; ?>
</div >


