<?php

/*
  Soubor pro pøipojení aplikace k databázi
 */

$db_server = 'localhost'; // Název serveru, ke kterému se budeme pøipojovat
$db_login = 'ete89e_1819zs_06'; // Jméno oprávnìného uživatele v databazi
$db_password = 'WwWtfH'; // Heslo uživatele v databazi 
$db_name = 'ete89e_1819zs_06'; // Název databáze, ve které jsme si vytvoøili tabulku
$spojeni = mysqli_connect($db_server, $db_login, $db_password);
mysqli_select_db($spojeni, $db_name)or die('<p style="color: red">Nastala chyba v pripojeni k databazi' . mysqli_connect_error());
mysqli_query($spojeni, "SET CHARACTER SET utf8");
//mysql_query("set names utf8");

?>