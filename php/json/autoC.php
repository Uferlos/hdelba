<?php
include '../config/config.php';

$datab = new mysqli (host, usr, pssw, db);
$datab->set_charset('utf8');
if($datab->connect_errno){
  echo $datab->connect_error;
  exit();
}

$consulta = "SELECT ci FROM users";

$res = $datab->query($consulta);

$campos = array();
while($fila = mysqli_fetch_array($res)){
	$campos[] = $fila[0];
}

echo json_encode($campos);
?>