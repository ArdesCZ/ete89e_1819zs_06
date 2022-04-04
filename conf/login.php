<?php
/*
  PPřihlašovací stránka zaměstnance
 */
session_start();
include "../conf/connect.php";

if (isset($_POST["submit"])) {

    $login = mysqli_real_escape_string($spojeni, $_POST["login"]); //Užívatelské jméno ve formuláři pro login
    $password = mysqli_real_escape_string($spojeni, $_POST["password"]); // Heslo zadané ve formuláři pro login
    $sha1password = sha1($password); //zahešuje vlozene heslo

//Overeni pravosti prihlasovacich udaju
    $dotaz = mysqli_query($spojeni, "select * from uzivatele where uzivJM = '$login' and heslo = '$sha1password'"); // SQL dotaz, který zjistí zda daný uživatel existuje existuje
    $overeni = mysqli_num_rows($dotaz); //Kolik uživatelů existuje s daným jménem a heslem
    $row = mysqli_fetch_array($dotaz, MYSQLI_BOTH); //Z identifikátoru získat konkrétní hodnotu
   
    $vedouci = mysqli_query($spojeni, "select * from uzivatele where uzivJM = '$login' and heslo = '$sha1password' and vedouci = 1");
    $vedouciPo = mysqli_num_rows($vedouci);
    $admin = mysqli_query($spojeni, "select * from uzivatele where uzivJM = '$login' and heslo = '$sha1password' and admin = 1");
    $adminPo = mysqli_num_rows($admin);

    if ($overeni == 1) {//Existuje daný uživatel? 
        if ($vedouciPo == 1) { //zde bylo > 0 
            $_SESSION['vedouci'] = stripslashes($login);
            $_SESSION['idVedouciho'] = $row[0]; //Uloženo idecko vedouciho pro pozdější vklad do databáze
            ?>    
            <script>
                window.location.href = "../zamestnanci/domuVedouci.php";
            </script> 
            <?php
            //Přesměrování na stránku domuVedouci  
            die();
        } elseif ($adminPo == 1) {
            $_SESSION['admin'] = stripslashes($login);
            $_SESSION['idAdmina'] = $row[0];
             ?>    
            <script>
                window.location.href = "../admin/domuAdmin.php";
            </script> 
            <?php
            //Přesměrování na stránku domuAdmin
            die();
        } else {
            $_SESSION['zamestnanec'] = stripslashes($login);
            $_SESSION['idZamestnance'] = $row[0]; //Uloženo idecko zaměstnance pro pozdější vklad do databáze
            ?>    
            <script>
                window.location.href = "../zamestnanci/domu.php";
            </script> 
            <?php
            //Přesměrování na stránku domu

            die();
        }
    } else {
        ?> 
        <div style="color: red">Zadali jste špatné uživatelské jméno nebo heslo!</div> 
        <meta http-equiv="refresh" content="1;url=../index.html">    <?php
    }
}
?>

