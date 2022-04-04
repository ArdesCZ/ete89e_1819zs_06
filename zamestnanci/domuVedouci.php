<?php
  session_start();
if ($_SESSION['vedouci'] == null) {//když není vedoucí zobrazí se chyba   ?>
        <div style="color: red">Nemáte oprávnění na tento web!</div> 
        <meta http-equiv="refresh" content="2;url=../index.html"> 
<?php
die();
session_destroy();
}else {//když je vedoucí zobrazí obsah ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ivo">
	
    <title>Docházkový systém na PEF</title>
    <link rel="shortcut icon" href="https://anet.eu/cz/wp-content/uploads/sites/2/2015/09/ANeT_Guard_100x100.png" type="image/x-icon">
    	
	<link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">   	
  </head>
  
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="./domuVedouci.php">Docházkový systém na PEF</a>
        <span class="navbar-text">Studentský projekt</span>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
		    <li class="nav-item">
              <a class="nav-link btn btn-outline-primary text-white" href="./domuVedouci.php">Domů</a>
              <span class="glyphicon glyphicon-home"></span>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-primary text-white" href="./nastenka_zamestnanceVedouci.php">Nástěnka zaměstnance</a>
              <span class="glyphicon glyphicon-zamestnance"></span>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-primary text-white" href="./pracovni_vykaz.php">Pracovní výkaz</a>
              <span class="glyphicon glyphicon-info-vedeni"></span>
            </li>
			<li class="nav-item login">
              <a class="btn btn-primary" href="../conf/logout.php">Logout</a>
              <span class="glyphicon glyphicon-info-sign"></span>
            </li>  
          </ul>
        </div>
      </div>
    </nav>
    
	<header class="masthead" style="background-image: url('../img/czu.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover">
      <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading"></div>                   
                </div>
            </div>
        </div>
    </header>
    
    <main id='main'>
		<div class="container">
	     <div class="row">
            <div class="col align-self-center"><h1>Vítejte v sekci pro vedení fakulty! </h1></div> 
            <div class="col"> <img src="../img/vel.png" class="img-fluid" alt="vel.png, 37kB"> </div>  
        </div>
      </div>
    </main>
    
    <footer class="py-5 bg-dark" id="footer">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Docházkový systém na CZU</p>
      </div>
	    <div class="container">
        <p class="m-0 text-center text-white">Zpracovali: <a href="mailto:XGECI001@studenti.czu.cz" class="text-warning"> Ivo Gec </a> | <a href="mailto:XSKOM023@studenti.czu.cz" class="text-warning"> Martin Škorník </a></p>
      </div>
	  <div class="container">
        <p class="m-0 text-center text-white">Fotografie: <a href="https://www.pef.czu.cz/cs/r-7006-o-fakulte/r-7018-pr-a-media/r-8569-fotogalerie" class="text-warning"> PEF CZU v Praze</a> </p>
      </div>
    </footer>
	
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../js/page.js"></script>  
  </body>
</html>
<?php } ?>
