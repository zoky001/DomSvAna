
<?php
include_once "../inc/constants.inc.php";
include_once "../common/base.php";
$pageTitle = "Korisnici";
include_once "../common/header.php";
//include_once "inc/class.lists.user.inc.php";
?>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
<?php
if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):
    ?>




    <div class="w3-container " style="margin-top: 50px;">





        <!-- Sidenav/menu -->

        <nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>



            <?php
            if (isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])): {

                    include_once 'inc/class.lists.user.inc.php';
                    $l = new UserAna($db);

                    $l->formatUserSidebar($_GET["oib"]); //get oib
                }
                ?>


            <?php endif; ?>







            <a href="portfolio.php?oib=<?php echo $_GET["oib"]; ?>&show=osobni_list" onclick="w3_close()" class="w3-text-teal  <?php if ($_GET["show"] == 'osobni_list')  echo 'w3-light-grey'?> "><i class="fa fa-user fa-fw w3-margin-right"></i>Osobni list korisnika</a>  
            <a href="portfolio.php?oib=<?php echo $_GET["oib"]; ?>&show=biljeske" onclick="w3_close()" class=" w3-text-teal <?php if ($_GET["show"] == 'biljeske')  echo 'w3-light-grey'?> " ><i class="fa fa-envelope fa-fw w3-margin-right"></i>Bilješke</a>
            <a href="portfolio.php?oib=<?php echo $_GET["oib"]; ?>&show=terapija" onclick="w3_close()" class=" w3-text-teal <?php if ($_GET["show"] == 'terapija')  echo 'w3-light-grey'?> "><i class="fa fa-th-large fa-fw w3-margin-right"></i>Terapija</a> 



            <a href="#portfolio" onclick="w3_close()" class=" w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Kupanje</a>
            <a href="#portfolio" onclick="w3_close()" class="w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Induvidualni plan</a>
            <a href="#anamneza" onclick="w3_close()" class="w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Anamneza</a>
            <!-- <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Plačanja</a> -->
            <a href="#portfolio" onclick="w3_close()" class="w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Pregled ugovora</a>

            <div class="w3-dropdown-hover">
                <a href="#" class="w3-text-teal"> <i class="fa fa-th-large fa-fw w3-margin-right"></i>Dropdown <i class=" fa fa-caret-down"></i></a>
                <div class="w3-dropdown-content w3-white w3-card-4">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>

        </nav>


        <!-- Overlay effect when opening sidenav on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main " style="margin-left:300px; margin-top: 50px;">



            <!-- Header -->


            <!-- personal user list --> 
            <div class="w3-row-padding">

                <div class="w3-col m10">


                    <!--biljeske -->
                    <?php
                    // include_once "../biljeske/biljeske.php";

                    if (isset($_GET['show'])) {

                        switch ($_GET['show']) {
                            case 'osobni_list':
                                $l->formatPersonalUserListTable($_GET["oib"]);


                                break;

                            case 'terapija':
                                include_once "terapija.php";

                                break;
                            case 'biljeske':
                                include_once "../biljeske/biljeske.php";

                                break;

                            default:

                                include_once "../biljeske/biljeske.php";
                                break;
                        }
                    } else {
                        include_once "../biljeske/biljeske.php";
                    }
                    ?>

                    <!-- end middle column-->
                </div>


                <!-- Right Column -->
                <div class="w3-col m2">

                    <div class="w3-panel w3-round-xlarge w3-light-grey">
                        <h1>Buduća događanja</h1>
                    </div>

                    <!--biljeske -->

                    <?php
                    include_once "../biljeske/events_user.php";
                    ?>


                    <!-- End right-->
                </div>

            </div>
        </div>
        <!-- End page content -->


        <script>
            // Script to open and close sidenav
            function w3_open() {
                document.getElementById("mySidenav").style.display = "block";
                document.getElementById("myOverlay").style.display = "block";
            }

            function w3_close() {
                document.getElementById("mySidenav").style.display = "none";
                document.getElementById("myOverlay").style.display = "none";
            }
        </script>
    </div>
    </div>
    <!-- new login -->
    <?php
else:
    echo "<meta http-equiv='refresh' content='0;" . P . "Prijava.php'>";
    ?>

<?php
endif;
?>

<?php
include_once "../common/footer.php";
?>
