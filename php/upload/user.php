<?php

$rannam = "";

$chars = "abcdefghijklmnopqrstuvwxyz1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
for($i = 0; $i < 25; $i++){
	$rannam .= substr($chars,rand(0,62),1);
}

if($_FILES["file"]["error"] > 0){
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}else{
	move_uploaded_file($_FILES["file"]["tmp_name"],"../../img/users/".$rannam.".png");
	
  global $file;
  $file = $rannam.".png";
	
	echo $file;
}