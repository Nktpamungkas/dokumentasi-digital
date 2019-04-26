<?php

//error_reporting(0);

$server = mysql_connect('localhost', 'root', '');

if ($server) {
    $serverNote = '  ';

    $database = mysql_select_db('asm');

    if ($database) {

        $databaseNote = '';
    } else {
        $databaseNote = 'Tidak Terkoneksi dengan Database';
    }
} else {
    $serverNote = 'Sambungan Server Tidak Terhubung dan ';
}

echo $database = $serverNote.' - '.$databaseNote;
?>
