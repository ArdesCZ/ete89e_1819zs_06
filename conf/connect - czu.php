<?php

/*
  Soubor pro p�ipojen� aplikace k datab�zi
 */

$db_server = 'localhost'; // N�zev serveru, ke kter�mu se budeme p�ipojovat
$db_login = 'ete89e_1819zs_06'; // Jm�no opr�vn�n�ho u�ivatele v databazi
$db_password = 'WwWtfH'; // Heslo u�ivatele v databazi 
$db_name = 'ete89e_1819zs_06'; // N�zev datab�ze, ve kter� jsme si vytvo�ili tabulku
$spojeni = mysqli_connect($db_server, $db_login, $db_password);
mysqli_select_db($spojeni, $db_name)or die('<p style="color: red">Nastala chyba v pripojeni k databazi' . mysqli_connect_error());
mysqli_query($spojeni, "SET CHARACTER SET utf8");
//mysql_query("set names utf8");

?>