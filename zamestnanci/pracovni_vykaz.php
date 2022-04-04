<?php
session_start();
include "../conf/connect.php";
//error_reporting(0); // vypnutí zobrazení poplachů
if ($_SESSION['vedouci'] == null) {//když není vedoucí nebo admin zobrazí se chyba   
    ?>
    <div style="color: red">Nemáte oprávnění na tento web!</div> 
    <meta http-equiv="refresh" content="2;url=../index.html"> 
    <?php
    die();
    session_destroy();
} else { //Když je vedoucí zobrazí obsah
    
    ?>

    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="ivo, nejen ty ;P">

            <title>Docházkový systém na PEF</title>
            <link rel="shortcut icon" href="https://anet.eu/cz/wp-content/uploads/sites/2/2015/09/ANeT_Guard_100x100.png" type="image/x-icon">

            <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
            <link href="../css/style.css" rel="stylesheet" type="text/css">
            <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <style>    
                /* Martin pridal css pro pravy side bar*/

                #sidebar {
                    padding: 1%;
                    height: 100%;
                    color: white;
                    background-color: #262626;   
                }

                #sidebar ul li{
                    color: white;
                    padding: 1%;
                    border-bottom: 1px solid grey;
                }

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

            <main> 
                <div class="row">
                    <div class="col-md-3">
                        <div id="sidebar">  
                            <form action=" " method="post" name="formFiltr">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><h1>Filtr:</h1></li>
                                    <li class="nav-item"><h3>Zaměstnanci</h3></li>
                                    <li class="nav-item">
                                        <select class="form-control" name="selectZam">
                                            <?php                                            
                                            $dotazZamestnanci = mysqli_query($spojeni, "select idUzivatel, concat(jmeno, ' ', prijmeni) as jmenoPrij  from uzivatele");
                                            while ($row = mysqli_fetch_array($dotazZamestnanci)) {
                                                echo "<option value=". $row[0] .">" . $row["jmenoPrij"] . "</option>";
                                            }
                                            ?>                      
                                        </select> 
                                    </li>
                                    <li class="nav-item">
                                        <input type="submit" name="submit" value="Filtruj" class="btn btn-primary">
                                    </li>
                                </ul>
                            </form>   
                        </div>
                    </div>                
                    <div class="col-md-8" id="table"> 
                        <table class="table table-bordered table-striped table-hover bg-light text-center" id="zmizNaFilter">
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
                             if (isset($_POST['submit'])) {
                              $zvolenaHodnota = $_POST["selectZam"];
                              $dotazTabuFil = mysqli_query($spojeni, "select * from uzivatele join dochazka on uzivatele.idUzivatel = dochazka.id_uzivatele where uzivatele.idUzivatel = $zvolenaHodnota");
                                  if (!$dotazTabuFil) {
                                printf("Error: %s\n", mysqli_error($spojeni));
                                 exit();
                                    }  
                                    while ($radek = mysqli_fetch_array($dotazTabuFil)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $radek["idUzivatel"] ?></td>
                                            <td><?php echo $radek["celeJmeno"] ?></td>
                                            <td><?php echo $radek["pozice"] ?></td>
                                            <td><?php echo $radek["datum"] ?></td>
                                            <td><?php echo $radek["zacatekPracovniDoby"] ?></td>
                                            <td><?php echo $radek["konecPracovniDoby"] ?></td> 
                                            <td><?php echo $radek["pocetodpracovanychHodit"] ?></td>
                                        </tr>

                                        <?php
                                    }
                                 }else{   
                                $dotazTabu = mysqli_query($spojeni, "select * from dochazka");
                                while ($row = mysqli_fetch_array($dotazTabu)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row["idDochazka"] ?></td>
                                        <td><?php echo $row["celeJmeno"] ?></td>
                                        <td><?php echo $row["pozice"] ?></td>
                                        <td><?php echo $row["datum"] ?></td>
                                        <td><?php echo $row["zacatekPracovniDoby"] ?></td>
                                        <td><?php echo $row["konecPracovniDoby"] ?></td> 
                                        <td><?php echo $row["pocetodpracovanychHodit"] ?></td>
                                    </tr>

                                    <?php
                                }
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

        </body>
    </html>

<?php } ?>
