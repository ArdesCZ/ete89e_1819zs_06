<?php
$databaze = 'ete89e_1819zs_06';
$uzivatel = 'ete89e_1819zs_06';
$heslo = 'WwWtfH';

if (!($cnn = mysqli_connect('localhost', $uzivatel, $heslo)))
	die('Nepodarilo se pripojit k databazovemu serveru.');
if (!mysqli_select_db($cnn, $databaze))
	die('Nepodarilo se otevrit databazi.');

echo 'Pripojeni k databazi bylo uspesne.';
