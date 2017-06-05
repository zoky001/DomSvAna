<!-- personal user list --> 
<?php
include_once "../inc/constants.inc.php";
include_once "../common/base.php";
?>

<div class='w3-panel w3-round-xlarge w3-light-grey ' >

    <div class='w3-panel w3-center w3-round-xlarge w3-pale-blue'>
        <h2> <b>
                Terapija &nbsp; - &nbsp;  
                <?php
                include_once 'inc/class.therapy.php';
                $lists = new Therapy();
                echo $lists->showProtegeName($_GET["oib"]);
                ?>

            </b></h2>



    </div>

    <div class='w3-section'>

        <div class='w3-container'>
            <!-- first big half section -->

            <table class="w3-table-all w3-card-4">
                <tr>
                    <th  >Naziv lijeka</th>
                    <th class = 'w3-center' >Ujutro</th>
                    <th class = 'w3-center' >Popodne</th>
                    <th class = 'w3-center' >Navečer</th>
                    <th class = 'w3-center'>Početak</th>
                    <th class = 'w3-center'>Završetak</th>
                    <th class = 'w3-center' style='width:20%'>Uređivanje </th>
                </tr>
                <?php
                if (isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])): {



                        $lists->loadTherapy($_GET["oib"]);
                    }
                endif;
                ?>

            </table>
            <!--
            <section class = "w3-row-padding">
            
             <section class = "w3-half">
            <p> ana</p>
            
            </section>
           <section class = "w3-half">
            
             <p> ana</p>
            </section>
          
            
            </section>
            -->

            <form  class= "w3-panel w3-round-xlarge w3-khaki" action="<?php echo P; ?>korisnici/db-interaction/therapy.php"  method="post" value ="add" >
                <input type="hidden" id="12" name="act" value="add" />
                <input type='hidden' id='11' name='oib' value= '<?php echo $_GET["oib"]; ?>' /> 
                <table class="w3-table-all w3-card-4" style="margin-top:10px">
                    <tr>
                        <th>Naziv lijeka</th>
                        <th>Ujutro</th>
                        <th>Popodne</th>
                        <th>Navečer</th>
                        <th>Datum početka </th>
                        <th>Datum završetka </th>

                    </tr>
                    <tr>
                        <td>  
                            <select class="w3-select w3-border" style="height:40px" name="lijek" required >

                                <!-- napraviti popunjavanje-->

                                <option value="" disabled selected>Odaberi lijek</option>
<?php $lists->DrugList() ?>
                            </select>
                        </td>
                        <td>  <input type="number" name="kolicina_u"  value = '0' min="0" max="5"></td>
                        <td>  <input type="number" name="kolicina_p"  value = '0' min="0" max="5"></td>
                        <td>  <input type="number" name="quantity_n" value = '0' min="0" max="5"></td>
                        <td> <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="day" required> </td>
                        <td> <input class = "w3-date w3-border w3-margin-bottom"  type="date"   name="end_day" required> </td>
                    </tr>


                </table>
                <button class="w3-btn-block w3-green w3-round-large w3-section w3-padding" type="submit">Dodaj terapiju</button>
            </form>



        </div>


    </div>
    <!-- end form insert data -->
</div>