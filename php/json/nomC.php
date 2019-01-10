<?php
include '../config/config.php';

$db = new mysqli (host, usr, pssw, db);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$ced = $_POST['ci'];

$query = "SELECT nom, ape, id_ced FROM users WHERE ci = '$ced'";

$res = $db->query($query);

$nombres = array();

while($row = $res->fetch_assoc()){
	$nombres['nom'] = $row['nom'];
	$nombres['ape'] = $row['ape'];
	$nombres['picure'] = $row['id_ced'];
}

echo json_encode($nombres);

?>