<!DOCTYPE html>
<html>
<head>
<title>Dom Svete Ane</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-highway.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>
</head>


<body class="w3-light-grey">
<div id="page-wrap">
<!-- Navigation Bar -->
<ul class="w3-navbar w3-white w3-large">  



<?php ; 

include_once "common/base.php";

 if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
    

?>
		<li><a href="#" class="w3-food-banana"><i class="fa fa-bed w3-margin-right"></i>Dom Svete Ane</a></li>
		<li><a href="ostalo.html/#room">Sobe</a></li>
		<li><a href="ostalo.html#about">Korisnici</a></li>
		<li><a href="#contact">Zaposlenici</a></li>  
		<li> </li>
		
		<ul class="w3-navbar w3-white w3-large navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Odjava </a></li>
    </ul>
	
		 
		

		
<?php else: ?>
		<li><a href="#" class="w3-food-banana"><i class="fa fa-bed w3-margin-right"></i>Dom Svete Ane</a></li>
                

				
				
<?php endif; ?>

 

        
  
  
  
</ul>