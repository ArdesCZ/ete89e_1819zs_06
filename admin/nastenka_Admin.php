<?php
session_start();
include "../conf/connect.php";
// Turn off all error reporting
error_reporting(0);
if ($_SESSION['admin'] == null) {//když není admin zobrazí se chyba   
    ?>
    <div style="color: red">Nemáte oprávnění na tento web!</div> 
    <meta http-equiv="refresh" content="2;url=../index.html"> 
    <?php
    die();
    session_destroy();
} else {//když je admin zobrazí obsah 
    $admi = $_SESSION['admin'];
    ?>

    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="ivo nejen ty :P Fantomas">

            <title>Docházkový systém na PEF</title>
            <link rel="shortcut icon" href="https://anet.eu/cz/wp-content/uploads/sites/2/2015/09/ANeT_Guard_100x100.png" type="image/x-icon">

            <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
            <link href="../css/style.css" rel="stylesheet" type="text/css">
            <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <style>
                #vyberUkonceni {
                    width: 70%;
                    height: 34px;
                    border: 1px solid #000;
                }

                #tlacitko {
                    background-color: #4CAF50;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 5px 2px;
                    cursor: pointer;
                }

                #tlacitko2 {
                    background-color: #FF0000;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 5px 2px;
                    cursor: pointer;   
                }

                .business-card {
                    border: 1px solid #cccccc;
                    background-color: lightgray;
                    padding: 2%;
                    margin:2%;
                    border-radius: 4px;
                    width: 100%;
                }

                #img{    
                    width: 65%;
                }

                .job {
                    color: #333333;
                    font-size: 17px;
                }

                .mail a{
                    font-size: 16px;
                    color: #00b8e6;
                }

                #table{
                    margin:1%;
                    padding:1%;
                }
                #tlacitko2{
                    display: none;
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
                                <span class="glyphicon glyphicon-admin"></span>
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

            <main>
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-6">            
                            <div class="business-card text-center">
                                <div class="media">
                                    <?php
                                    $dotazFoto = mysqli_query($spojeni, "select foto from uzivatele where uzivatele.uzivJM = '$admi'");
                                    $rowFoto = mysqli_fetch_array($dotazFoto); // fetch the array
                                    $foto = $rowFoto['foto'];
                                    echo ('<img class="img-fluid img-thumbnail" alt="database picture" id="img" src="data:image/jpeg;base64,' . base64_encode($rowFoto['foto']) . '"/>'); //img je uložen jako longblob proto tenhle nesmysl (blob - binární soubor)
                                    ?>  

                                    <div class="media-body">
                                        <h2 class="media-heading">
                                            <?php
                                            $dotazJmeno = mysqli_query($spojeni, "select concat(jmeno, ' ', prijmeni) as jmenoPrij from uzivatele where uzivatele.uzivJM = '$admi'"); // concat spojeni dvou sloupcu v jeden
                                            $rowJm = mysqli_fetch_array($dotazJmeno); // fetch the array
                                            $jmeno = $rowJm['jmenoPrij'];
                                            echo($jmeno);
                                            ?>                               
                                        </h2>
                                        <div class="job">
                                            <?php
                                            $dotazPozice = mysqli_query($spojeni, "select pozice from uzivatele where uzivatele.uzivJM = '$admi'");
                                            $rowPozice = mysqli_fetch_array($dotazPozice); // fetch the array
                                            $pozice = $rowPozice['pozice'];
                                            echo($pozice);
                                            ?>  
                                        </div>
                                        <div class="age"> Věk: 
                                            <?php
                                            $dotazVek = mysqli_query($spojeni, "select vek from uzivatele where uzivatele.uzivJM = '$admi'");
                                            $rowVek = mysqli_fetch_array($dotazVek); // fetch the array
                                            $vek = $rowVek['vek'];
                                            echo($vek);
                                            ?>  
                                        </div>                                
                                        <div class="mail">
                                            <a href="mailto:mala@gmail.com">
                                                <?php
                                                $dotazMail = mysqli_query($spojeni, "select email from uzivatele where uzivatele.uzivJM = '$admi'");
                                                $rowMail = mysqli_fetch_array($dotazMail); // fetch the array
                                                $mail = $rowMail['email'];
                                                echo($mail);
                                                ?>  
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="col-md-6 align-self-center">         
                            <div class="business-card text-center">
                                <h2 id="h2nepracuje">  Momentálně nepracujete! </h2>  
                                <h2 id="h2pracujeOD" style="display: none">  Začal jste pracovat v: <div id="zacHodina"></div></h2> 
                                <h2 id="h2pracuje" style="display: none">  Právě pracujete: <div id="cas">0</div> hodin!</h2>  

                                <input type="submit" id="tlacitko" class="tlacitko mx-auto" value="Začátek pracovní doby" onclick="casovac()">
                                <form action="" method="POST">
                                    <input type="submit" id="tlacitko2" name="tlacitko2" class="tlacitko mx-auto" value="Konec pracovní doby" onclick="vymazCas()">
                                </form>
                            </div>
                        </div>  
                    </div> 
                </div> 
                <div class="row justify-content-center"> 
                    <div class="col-md-8" id="table">
                        <table class="table table-bordered table-striped table-hover bg-light text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" id="zmiz">#</th>
                                    <th scope="col">Jméno</th>
                                    <th scope="col">Pozice</th>
                                    <th scope="col">Datum</th>
                                    <th scope="col">Začátek pracovní doby</th>
                                    <th scope="col">Konec pracovní doby</th>
                                    <th scope="col">Odpracoval hodin</th>                                 
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th scope="col" id="zmiz">#</th>
                                    <th scope="col">Jméno</th>
                                    <th scope="col">Pozice</th>
                                    <th scope="col">Datum</th>
                                    <th scope="col">Začátek pracovní doby</th>
                                    <th scope="col">Konec pracovní doby</th>                              
                                    <th scope="col">Odpracoval hodin</th>                                    
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $dotazTabu = mysqli_query($spojeni, "select * from dochazka join uzivatele on dochazka.id_uzivatele = uzivatele.idUzivatel where uzivatele.uzivJM = '$admi'");
                                while ($row = mysqli_fetch_array($dotazTabu)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row[0] ?></td>
                                        <td><?php echo $row["celeJmeno"] ?></td>
                                        <td><?php echo $row["pozice"] ?></td>
                                        <td><?php echo $row["datum"] ?></td>
                                        <td><?php echo $row["zacatekPracovniDoby"] ?></td>
                                        <td><?php echo $row["konecPracovniDoby"] ?></td> 
                                        <td><?php echo $row["pocetodpracovanychHodit"] ?></td>                                    
                                    </tr>

                                    <?php
                                }
                                ?>               
                            </tbody>
                        </table>
                    </div>       
                </div>     
            </main>

            <footer class="py-5 bg-dark" id="footer">
                <div class="container">
                    <p class="m-0 text-center text-white">Copyright &copy; Docházkový systém na ČZU</p>
                </div>
                <div class="container">
                    <p class="m-0 text-center text-white">Zpracovali: <a href="mailto:XGECI001@studenti.czu.cz" class="text-warning"> Ivo Gec </a> | <a href="mailto:XSKOM023@studenti.czu.cz" class="text-warning"> Martin Škorník </a></p>
                </div>
                <div class="container">
                    <p class="m-0 text-center text-white">Fotografie: <a href="https://www.pef.czu.cz/cs/r-7006-o-fakulte/r-7018-pr-a-media/r-8569-fotogalerie" class="text-warning"> PEF ČZU v Praze</a> </p>
                </div>
            </footer>

            <script src="../vendor/jquery/jquery.min.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="../js/page.js"></script>
            <script type="text/javascript">
                                        var interval;
                                        var odpracovanyCas;
                                        var terminOD;

                                        function casovac() {
                                            var i = 0;
                                            document.getElementById("h2nepracuje").style.display = 'none';
                                            document.getElementById("h2pracuje").style.display = 'block';
                                            document.getElementById("h2pracujeOD").style.display = 'block';
                                            document.getElementById("tlacitko").style.display = 'none';
                                            document.getElementById("tlacitko2").style.display = 'block';

                                            var d = new Date();
                                            var h = d.getHours();
                                            var m = d.getMinutes();
                                            var s = d.getSeconds();

                                            document.getElementById("zacHodina").innerHTML = h + " : " + m + " : " + s;
                                            if (h < 10) {
                                                h = "0" + h;
                                            }
                                            if (m < 10) {
                                                m = "0" + m;
                                            }
                                            if (s < 10) {
                                                s = "0" + s;
                                            }
                                            terminOD = h + ":" + m + ":" + s;
                                            document.cookie = "zacalAdminOD=" + (terminOD);
                                           //nastavený vteřiny z důvodu rychlého otestování funkcionality, jinak by se muselo čekat hodinu
                                            interval = setInterval(hodinovyCas, 3600000);//3600000 je 1 hodina v ms
                                            function hodinovyCas() {
                                                document.getElementById("cas").innerHTML = i + 1;
                                                odpracovanyCas = i + 1;
                                                document.cookie = "odpraovanoAdminC=" + odpracovanyCas; //odpraovanoAdminC
                                                return odpracovanyCas;
                                            }
                                        }

                                        function vymazCas() {
                                            document.getElementById("h2nepracuje").style.display = 'block';
                                            document.getElementById("h2pracuje").style.display = 'none';
                                            document.getElementById("h2pracujeOD").style.display = 'none';
                                            document.getElementById("tlacitko").style.display = 'block';
                                            document.getElementById("tlacitko2").style.display = 'none';
                                            clearInterval(interval);
                                        }

            </script>
            <?php
            if (@$_POST['tlacitko2']) {
                date_default_timezone_set("Europe/Prague");
                $aktualniDatum = date("Y-m-d");
                $odpracovanoOD = $_COOKIE[zacalAdminOD];
                $odpracovanoDO = date("H:i:s");
                $odpracovanoCelkem = $_COOKIE[odpraovanoAdminC];
                $dotazNaId = mysqli_query($spojeni, "select uzivatele.idUzivatel from uzivatele where uzivatele.uzivJM = '$admi'");
                $rowID = mysqli_fetch_array($dotazNaId); // fetch the array
                $id = $rowID['idUzivatel'];
                $dotaz = "INSERT INTO dochazka VALUES ('','$jmeno','$pozice','$aktualniDatum','$odpracovanoOD','$odpracovanoDO','$odpracovanoCelkem','$id')";
                $proved = mysqli_query($spojeni, $dotaz);
                echo "<script>window.location = '../conf/logout.php'</script>"; //odhlašení uživatele
            }
            ?>

        </body>
    </html>

<?php } ?>

