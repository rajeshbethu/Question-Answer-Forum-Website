<?php
	include "../classes/classes.php";
	$sname = $_POST["space_name"];
	$sid = $_POST["sid"];
	$followspace = new SpacesOfUser();
	echo $followspace->set($sname,$sid);
?>