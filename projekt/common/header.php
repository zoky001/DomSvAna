<!DOCTYPE html>
<html>
<head>
<title> Dom Svete Ane - <?php echo $pageTitle; ?> </title>
<meta charset="UTF-8">

<!--<meta charset="UTF-8">-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-highway.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-colors-food.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

 <link rel="stylesheet" href="<?php include_once "../inc/constants.inc.php";echo P;?>w3.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>
</head>


<body class = "w3-food-egg">

<!-- Navigation Bar -->


<nav class="navbar navbar-inverse navbar-fixed-top">  
<div class="container-fluid ">



<?php ; 

//include_once "//localhost/ostalo/common/base.php";

 $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/ostalo/common/base.php";
   include_once($path);

 if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
    

?>

 <div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  
		<a class="navbar-brand " href="<?php echo P; ?>"><i class="fa fa-bed w3-margin-right"></i>Dom Svete Ane</a>
		
	  </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
		 <ul class="nav navbar-nav">
		<li><a href="<?php echo P; ?>room" >Sobe</a></li>
		<li><a href="<?php echo P; ?>korisnici/">Korisnici</a></li>
		<li><a href="<?php echo P; ?>korisnici/portfolio.php">Zaposlenici</a></li>  
	   </ul>
		  
		<ul class=" nav navbar-nav navbar-right  navbar-right">
	
	  <li class="navbar-text">  <?php echo $_SESSION['Username']; ?>  </li>
      <li><a href="<?php echo P; ?>korisnici/portfolio.php?oib=1231425478"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
      <li><a href="<?php echo P; ?>logout.php"><span class="glyphicon glyphicon-log-in"></span> Odjava </a></li>
    </ul>
	
		    </div>
		

		
<?php else: ?>
 <div class="navbar-header">
	
       <a class="navbar-brand " href="<?php echo P; ?>"><i class="fa fa-bed w3-margin-right"></i>Dom Svete Ane</a>
	  </div>
				
				
<?php endif; ?>
</div>
</nav> 






