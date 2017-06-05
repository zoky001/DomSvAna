<?php 
include_once "inc/constants.inc.php";
include_once "common/base.php";
 $pageTitle = "Prijava";
include_once "common/header.php";
?>

<!-- Header -->
<div class="w3-display-container w3-content" style="max-width:1500px;">
  <img class="w3-image" src="login_svana.jpg" alt="SV ana" style="min-width:1000px" width="100%" height="500">
<?php 



    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):

?>

<p>Već ste <strong>prijavljeni.</strong></p>
        <p><a href="logout.php">Odjava</a></p>


		


  <?php
    elseif(!empty($_POST['username']) && !empty($_POST['password'])):
        include_once 'inc/class.users.inc.php';
        $users = new ColoredListsUsers($db);
        if($users->accountLogin()===TRUE):
		echo "prijavljen uspješno";
           echo "<meta http-equiv='refresh' content='0;".P."'>";
            exit;
        else:
?>
   <h2>Login Failed&mdash;Try Again?</h2>
  <div class="w3-display-middle w3-padding w3-col l6 m8">
    <div class="w3-container w3-food-banana">
      <h2><i class="fa fa-male w3-margin-right"></i>Prijava djelatnika</h2>
    </div>
    <div class="w3-container w3-white w3-padding-16">
      <form method="post" action="Prijava.php" name="loginform" id="loginform">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-margin-bottom">
            <label><i class="fa fa-male"></i> Korisničko ime</label>
            <input class="w3-input w3-border" type="text" id="username" placeholder="Vaše korisničko ime" name="username" required>
          </div>
          
        </div>
        <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-margin-bottom">
            <label><i class="fa fa-password"></i> Lozinka</label>
            <input class="w3-input w3-border" type="password" id="password" placeholder="Lozinka" name="password" required>
          </div>
          
        </div>
        <button class="w3-btn w3-dark-grey" type="submit"><i class="fa fa-arrow-right w3-margin-left "></i> Prijava</button>
      </form>
    </div>
  </div>
  
  <?php
        endif;
    else:
?>
 
  <div class="w3-display-middle w3-padding w3-col l6 m8">
    <div class="w3-container w3-food-banana">
      <h2><i class="fa fa-male w3-margin-right"></i>Prijava djelatnika</h2>
    </div>
    <div class="w3-container w3-white w3-padding-16">
      <form method="post" action="Prijava.php" name="loginform" id="loginform" >
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-margin-bottom">
            <label><i class="fa fa-male"></i> Korisničko ime</label>
           
			<input class="w3-input w3-border" type="text" name="username" id="username" placeholder="Vaše korisničko ime" name="k_ime" required />
			
          </div>
          
        </div>
        <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-margin-bottom">
            <label><i class="fa fa-password"></i> Lozinka</label>
            
			 <input class="w3-input w3-border" type="password" name="password" placeholder="Lozinka" name="Loz"id="password"required />
          </div>
          
        </div>
        <button class="w3-btn w3-dark-grey" type="submit"><i class="fa fa-arrow-right w3-margin-left "></i> Prijava</button>
      </form>
    </div>
  </div>
  <?php
    endif;
?>

  
</div>


<?php 

include_once "common/footer.php";

?>