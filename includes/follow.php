<?php
	include "../classes/classes.php";
	$username = $_POST["username"];
	$frid = $_POST["frid"];
	$follow = new FollowingOfUser();
	echo $follow->set($username,$frid);
?>