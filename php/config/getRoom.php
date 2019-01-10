<?php
$db = new mysqli(host, usr, pssw, db);
$db->set_charset('utf8');

$roomsF = array();
$roomsB = array();
$roomsBtF = array();
$roomsBdF = array();

$query = "SELECT * FROM rooms WHERE sts = 'fr';";
$query .= "SELECT * FROM rooms WHERE sts = 'bs';";

if($db->multi_query($query)){
  $resF = $db->store_result();
  $db->next_result();
  $resB = $db->store_result();
  $db->close();
}

while($rowF = $resF->fetch_assoc()){
  $roomsF[] = $rowF['nr'];
}

while($rowB = $resB->fetch_assoc()){
  $roomsB[] = $rowB['nr'];
  $roomsBtF[] = $rowB['htf'];
  $roomsBdF[] = $rowB['dtf'];
}
?>