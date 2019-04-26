<?php
include_once 'p_controller/database/connection.php';

$target = $_GET['id_dok'];

$deletefile = mysql_query("DELETE FROM tb_dokumen WHERE id_dok='$target'");

if (file_exists($deletefile)){
	unlink($deletefile); //delete now
}

if (file_exists($deletefile)){
	echo "Problem Deleting " . $deletefile;
}else{
	echo"Successfully Deleting " . $deletefile;
}
?>
