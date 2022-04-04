<?php
session_start();
include "../conf/connect.php";
if ($_SESSION['admin'] == null) {//když není admin zobrazí se chyba   
    ?>
    <div style="color: red">Nemáte oprávnění na tento web!</div> 
    <meta http-equiv="refresh" content="2;url=../index.html"> 
    <?php
    die();
    session_destroy();
} else {
     //když je admin zobrazí obsah 
    //pokud se stiklo tlačítko pro přidání uživatelů
    if (isset($_POST["pridat"])) {
        $uzivJM = mysqli_real_escape_string($spojeni, $_POST["uzivJM"]);
        $heslo = mysqli_real_escape_string($spojeni, $_POST["heslo"]);
        $sha1heslo = sha1($heslo);
        $vedouci = mysqli_real_escape_string($spojeni, $_POST["jeVedouci"]);
        $admin = mysqli_real_escape_string($spojeni, $_POST["jeAdmin"]);
        $jmeno = mysqli_real_escape_string($spojeni, $_POST["jmeno"]);
        $prijmeni = mysqli_real_escape_string($spojeni, $_POST["prijmeni"]);
        $pozice = mysqli_real_escape_string($spojeni, $_POST["pozice"]);
        $vek = mysqli_real_escape_string($spojeni, $_POST["vek"]);
        $email = mysqli_real_escape_string($spojeni, $_POST["email"]);
        $image = addslashes(file_get_contents($_FILES['fotoUzivatele']['tmp_name']));

        $dotaz = "INSERT INTO uzivatele VALUES ('','$uzivJM','$sha1heslo','$vedouci','$admin','$jmeno','$prijmeni','$pozice','$vek','$email','$image')";
        $proved = mysqli_query($spojeni, $dotaz);
    }

    //pokud se stisklo tlačítko pro odebrání uživatelů
    if (isset($_POST["uzivJmOdeber"])) {
        $uzivJMOdeber = mysqli_real_escape_string($spojeni, $_POST["uzivJmOdeber"]);
        $dotazOdeber = "DELETE FROM uzivatele WHERE uzivJm ='$uzivJMOdeber'";
        $provedOdeber = mysqli_query($spojeni, $dotazOdeber);
    }

    //pokud se stisklo tlačítko pro změnu uživatelského jména
    if (isset($_POST["upravitJenUzivJM"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $uzivJmUprava = mysqli_real_escape_string($spojeni, $_POST["uzivJmUprava"]);
        $dotazUpravaJen = " UPDATE uzivatele SET uzivJM = '$uzivJmUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUpravaJen = mysqli_query($spojeni, $dotazUpravaJen);
    }
    //pokud se stisklo tlačítko pro změnu hesla
    if (isset($_POST["upravitJenHeslo"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $hesloUprava = mysqli_real_escape_string($spojeni, $_POST["hesloUprava"]);
        $sha1hesloUprava = sha1($hesloUprava);
        $dotazUpravaJen = " UPDATE uzivatele SET heslo = '$sha1hesloUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUpravaJen = mysqli_query($spojeni, $dotazUpravaJen);
    }
    //pokud se stisklo tlačítko pro změnu příjmení
    if (isset($_POST["upravitJenPrijmeni"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $prijmeniUprava = mysqli_real_escape_string($spojeni, $_POST["prijmeniUprava"]);
        $dotazUpravaJen = " UPDATE uzivatele SET prijmeni = '$prijmeniUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUpravaJen = mysqli_query($spojeni, $dotazUpravaJen);
    }
    //pokud se stisklo tlačítko pro změnu pozice
    if (isset($_POST["upravitJenPozici"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $poziceUprava = mysqli_real_escape_string($spojeni, $_POST["poziceUprava"]);
        $dotazUpravaJen = " UPDATE uzivatele SET pozice = '$poziceUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUpravaJen = mysqli_query($spojeni, $dotazUpravaJen);
    }
    //pokud se stisklo tlačítko pro změnu věku
    if (isset($_POST["upravitJenVek"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $vekUprava = mysqli_real_escape_string($spojeni, $_POST["vekUprava"]);
        $dotazUpravaJen = " UPDATE uzivatele SET vek = '$vekUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUpravaJen = mysqli_query($spojeni, $dotazUpravaJen);
    }
    //pokud se stisklo tlačítko pro změnu uživatelského jména
    if (isset($_POST["upravitJenEmail"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $emailUprava = mysqli_real_escape_string($spojeni, $_POST["emailUprava"]);
        $dotazUpravaJen = " UPDATE uzivatele SET email = '$emailUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUpravaJen = mysqli_query($spojeni, $dotazUpravaJen);
    }

    //pokud se stisklo tlačítko pro úpravu všech údajů
    if (isset($_POST["upravitUdaje"])) {
        $idUprava = mysqli_real_escape_string($spojeni, $_POST["idUprava"]);
        $uzivJmUprava = mysqli_real_escape_string($spojeni, $_POST["uzivJmUprava"]);
        $hesloUprava = mysqli_real_escape_string($spojeni, $_POST["hesloUprava"]);
        $sha1hesloUprava = sha1($hesloUprava);
        $prijmeniUprava = mysqli_real_escape_string($spojeni, $_POST["prijmeniUprava"]);
        $poziceUprava = mysqli_real_escape_string($spojeni, $_POST["poziceUprava"]);
        $vekUprava = mysqli_real_escape_string($spojeni, $_POST["vekUprava"]);
        $emailUprava = mysqli_real_escape_string($spojeni, $_POST["emailUprava"]);

        $dotazUprava = " UPDATE uzivatele SET uzivJM = '$uzivJmUprava', heslo = '$sha1hesloUprava', prijmeni = '$prijmeniUprava', pozice = '$poziceUprava', vek = '$vekUprava', email = '$emailUprava' WHERE uzivatele.idUzivatel ='$idUprava'";
        $provedUprava = mysqli_query($spojeni, $dotazUprava);
    }
    ?>

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

            <style>
                #table{
                    margin:1%;
                    padding:1%;
                }

                @media only screen and (max-width: 600px) {
                    #zmiz {
                        display:none;
                    }
                }  
            </style>
        </head>

        <body>
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="./domuAdmin.php">Docházkový systém na PEF</a>
                    <span class="navbar-text">Studentský projekt</span>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary text-white" href="./domuAdmin.php">Domů</a>
                                <span class="glyphicon glyphicon-home"></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary text-white" href="./nastenka_Admin.php">Nástěnka zaměstnance</a>
                                <span class="glyphicon glyphicon-zamestnance"></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary text-white" href="./pracovni_vykazAdmin.php">Pracovní výkaz</a>
                                <span class="glyphicon glyphicon-info-vedeni"></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary text-white" href="./administrace.php">Administrace</a>
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
                <div class="container ">
                    <br />
                    <h2 align="center">Výpis zpráv</h2>
                    
                    <div class="mx-auto" id="table"> 
                        <table class="table table-bordered table-striped table-hover bg-light text-center" id="zmizNaFilter">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" id="zmiz">#</th>
                                    <th scope="col">Jméno a příjmení</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Subejkt zprávy</th>
                                    <th scope="col">Tělo zprávy</th> 
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th scope="col" id="zmiz">#</th>
                                    <th scope="col">Jméno a příjmení</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Subejkt zprávy</th>
                                    <th scope="col">Tělo zprávy</th> 
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $dotazZprava = mysqli_query($spojeni, "SELECT * FROM zprava");
                                while ($row = mysqli_fetch_array($dotazZprava)) {
                                    ?>
                                    <tr>
                                        <td id="zmiz"><?php echo ($row["idZprava"]); ?></td>
                                        <td><?php echo ($row["celeJmeno"]); ?></td>
                                        <td><?php echo ($row["email"]); ?></td>
                                        <td><?php echo ($row["subjekt"]); ?></td> 
                                        <td><?php echo ($row["telozpravy"]); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                          
                            </tbody>
                        </table>
                    </div>
                    
                    <h1 align="center">Administrace uživatelů </h1>
                    <br />
                    <h2 align="center">Výpis uživatelů </h2>
                    <div class="mx-auto" id="table"> 
                        <table class="table table-bordered table-striped table-hover bg-light text-center" id="zmizNaFilter">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" id="zmiz">#</th>
                                    <th scope="col">Uživatelské jméno</th>
                                    <th scope="col">Heslo</th>
                                    <th scope="col" id="zmiz">Je vedouci?</th>
                                    <th scope="col" id="zmiz">Je admin?</th>
                                    <th scope="col">Jméno</th>
                                    <th scope="col">Příjmení</th> 
                                    <th scope="col">Pozice</th>
                                    <th scope="col" id="zmiz">Věk</th> 
                                    <th scope="col" id="zmiz">Email</th> 
                                    <th scope="col" id="zmiz">Foto</th> 
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th scope="col" id="zmiz">#</th>
                                    <th scope="col">Uživatelské jméno</th>
                                    <th scope="col">heslo</th>
                                    <th scope="col" id="zmiz">Je vedouci?</th>
                                    <th scope="col" id="zmiz">Je admin?</th>
                                    <th scope="col">Jméno</th>
                                    <th scope="col">Příjmení</th> 
                                    <th scope="col">Pozice</th> 
                                    <th scope="col" id="zmiz">Věk</th>
                                    <th scope="col" id="zmiz">Email</th> 
                                    <th scope="col" id="zmiz">Foto</th> 
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $dotazTabu = mysqli_query($spojeni, "SELECT * FROM uzivatele");
                                while ($row = mysqli_fetch_array($dotazTabu)) {
                                    ?>
                                    <tr>
                                        <td id="zmiz"><?php echo ($row["idUzivatel"]); ?></td>
                                        <td><?php echo ($row["uzivJM"]); ?></td>
                                        <td><?php echo ($row["heslo"]); ?></td>
                                        <td id="zmiz"><?php echo ($row["vedouci"]); ?></td>
                                        <td id="zmiz"><?php echo ($row["admin"]); ?></td>
                                        <td><?php echo ($row["jmeno"]); ?></td> 
                                        <td><?php echo ($row["prijmeni"]); ?></td>
                                        <td><?php echo ($row["pozice"]); ?></td>
                                        <td id="zmiz"><?php echo ($row["vek"]); ?></td>
                                        <td id="zmiz"><?php echo ($row["email"]); ?></td>
                                        <td id="zmiz"><?php echo ('<img class="img-fluid img-thumbnail" alt="database picture" id="img" src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '"/>'); ?></td> 
                                    </tr>
                                    <?php
                                }
                                ?>                          
                            </tbody>
                        </table>
                    </div>


                    <h2 align="center">Přidání uživatele </h2>
                    <div class="mx-auto col-9"> 
                        <form action="" method="POST" name="pridejUziv" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="uzivJm">Uživatelské jméno</label>
                                <input type="text" class="form-control" id="uzivJm" name="uzivJM">
                            </div>
                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input type="password" class="form-control" id="password" name="heslo">
                            </div>

                            <div class="form-group">
                                <label for="jevedouci">Je vedoucí?</label>
                                <input type="number" class="form-control" id="jevedouci" name="jeVedouci">
                            </div>
                            <div class="form-group">
                                <label for="jeadmin">Je admin?</label>
                                <input type="number" class="form-control" id="jeadmin" name="jeAdmin">
                            </div>
                            <div class="form-group">
                                <label for="jmeno">Jméno</label>
                                <input type="text" class="form-control" id="jmeno" name="jmeno">
                            </div>
                            <div class="form-group">
                                <label for="prijmeni">Příjmení</label>
                                <input type="text" class="form-control" id="prijmeni" name="prijmeni">
                            </div>
                            <div class="form-group">
                                <label for="pozice">Pracovní pozice</label>
                                <input type="text" class="form-control" id="pozice" name="pozice">
                            </div>
                            <div class="form-group">
                                <label for="vek">Věk</label>
                                <input type="number" class="form-control" id="vek" name="vek">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="vloženéFoto">Foto uživatele</label>
                                <input type="file" class="form-control-file" id="vloženéFoto" name="fotoUzivatele">
                            </div>
                            <input type="submit" class="btn btn-success" name="pridat" value="Přidat">
                        </form>    
                    </div>
                    <br/><hr/>


                    <h2 align="center">Odebrání uživatele </h2>
                    <div class="mx-auto  col-9"> 
                        <form action="" method="POST" name="odeberUziv">
                            <div class="form-group">
                                <label for="uzivJmOdeber">Uživatelské jméno</label>
                                <input type="text" class="form-control" id="uzivJmOdeber" name="uzivJmOdeber">
                            </div>
                            <input type="submit" class="btn btn-danger" name="odeber" value="Odebrat">
                        </form>    
                    </div>
                    <br/><hr/>


                    <h2 align="center">Úprava údajů</h2>
                    <div class="mx-auto  col-10"> 
                        <form action="" method="POST" name="upravaUdaju">
                            <div class="form-group">
                                <label for="idUprava">ID uživatele, který se bude upravovat</label>
                                <input type="number" class="form-control" id="idUprava" name="idUprava"><br/>
                                <h3>Nové údaje</h3>
                                <label for="uzivJmUprava">Uživatelské jméno</label>
                                <div class="row">
                                    <div class="col-7">
                                        <input type="text" class="form-control" id="uzivJmUprava" name="uzivJmUprava">
                                    </div>
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-info" name="upravitJenUzivJM" value="Upravit jen uživatelské jméno">
                                    </div>
                                </div>
                                <label for="hesloUprava">Heslo</label>
                                <div class="row">
                                    <div class="col-7">                                
                                        <input type="password" class="form-control" id="hesloUprava" name="hesloUprava">
                                    </div>
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-info" name="upravitJenHeslo" value="Upravit jen heslo">
                                    </div>
                                </div>
                                <label for="prijmeniUprava">Příjmení</label>
                                <div class="row">
                                    <div class="col-7">  
                                        <input type="text" class="form-control" id="prijmeniUprava" name="prijmeniUprava">
                                    </div>
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-info" name="upravitJenPrijmeni" value="Upravit jen příjmení">
                                    </div>
                                </div>
                                <label for="poziceUprava">Pozice</label>
                                <div class="row">
                                    <div class="col-7">  
                                        <input type="text" class="form-control" id="poziceUprava" name="poziceUprava">
                                    </div>
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-info" name="upravitJenPozici" value="Upravit jen pozici">
                                    </div>
                                </div>
                                <label for="vekUprava">Věk</label>
                                <div class="row">
                                    <div class="col-7">
                                        <input type="number" class="form-control" id="vekUprava" name="vekUprava">
                                    </div>
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-info" name="upravitJenVek" value="Upravit jen věk">
                                    </div>
                                </div>
                                <label for="emailUprava">Email</label>
                                <div class="row">
                                    <div class="col-7">
                                        <input type="email" class="form-control" id="emailUprava" name="emailUprava">
                                    </div>
                                    <div class="col-3">
                                        <input type="submit" class="btn btn-info" name="upravitJenEmail" value="Upravit jen email">
                                    </div>
                                </div> 
                            </div>
                            <input type="submit" class="btn btn-primary" name="upravitUdaje" value="Upravit všechny údaje">
                        </form>    
                    </div>
                    <br/><br/>


                </div>
            </main>

            <footer class = "py-5 bg-dark" id = "footer">
                <div class = "container">
                    <p class = "m-0 text-center text-white">Copyright &copy;
                        Docházkový systém na CZU</p>
                </div>
                <div class = "container">
                     <p class="m-0 text-center text-white">Zpracovali: <a href="mailto:XGECI001@studenti.czu.cz" class="text-warning"> Ivo Gec </a> | <a href="mailto:XSKOM023@studenti.czu.cz" class="text-warning"> Martin Škorník </a></p>
                </div>
                <div class = "container">
                    <p class = "m-0 text-center text-white">Fotografie: <a href = "https://www.pef.czu.cz/cs/r-7006-o-fakulte/r-7018-pr-a-media/r-8569-fotogalerie" class = "text-warning"> PEF CZU v Praze</a> </p>
                </div>
            </footer>

        </body>
    </html>
    <?php
}
?>
