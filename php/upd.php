<?php
include 'config/config.php';

$db = new mysqli(host, usr, pssw, db);
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}
$db->set_charset('utf8');

$idtu = array();

$q = "SELECT id, nom, ape FROM users where fna = ''";
$res = $db->query($q);

while($row = $res->fetch_assoc()){
	$idtu[] = $row['id'];
	$fnatu[] = $row['nom'] . ' ' .$row['ape'];
}

$cc = count($idtu);

for($i = 0; $i < $cc; $i++){
	$send = "UPDATE users SET fna = '$fnatu[$i]' WHERE id = '$idtu[$i]'";
	if(!$db->query($send)){
		echo $db->error;
		exit();
	}
}

?>