<?php

/*
  Soubor pro připojení aplikace k databázi
 */

$db_server = 'localhost'; // Název serveru, ke kterému se budeme připojovat
$db_login = 'adminDochazka'; // Jméno oprávněného uživatele v databazi
$db_password = ''; // Heslo uživatele v databazi 
$db_name = 'dochazka'; // Název databáze, ve které jsme si vytvořili tabulku
$spojeni = mysqli_connect($db_server, $db_login, $db_password);
mysqli_select_db($spojeni, $db_name)or die('<p style="color: red">Nastala chyba v pripojeni k databazi' . mysqli_connect_error());
mysqli_query($spojeni, "SET CHARACTER SET utf8");
//mysql_query("set names utf8");

?>