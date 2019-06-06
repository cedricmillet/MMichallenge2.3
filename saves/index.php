<?php

echo '<meta charset="UTF-8" />';
$user='root';
$pass='';
$host='localhost';
$dbname = "mmichallenge";
$dump_name = hash('md5', uniqid())."__".date("d-m-Y_H\hi").'.sql';


echo '>> Génération du dump de la base de données via mysqldump.exe...<br>';

$cmd='C:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump --user='.$user.' --password='.$pass .' --host=localhost '.$dbname.' > '.$dump_name;
//var_dump($cmd);exit;
exec($cmd, $output, $return);
if ($return != 0) { //0 is ok
    die('Error: ' . implode("\r\n", $output));
}

echo ">> Dump de la base de données effectué.<br>";

if(file_exists($dump_name))
	echo '>> Fichier enregistré avec succès.';
else
	echo '>> ERREUR - le fichier a rencontré une erreur lors de sa génération !';