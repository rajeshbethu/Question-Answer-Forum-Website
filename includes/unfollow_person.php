<?php
	include "../classes/classes.php";
	$following = $_POST["following"];
	$fgid = $_POST["fgid"];
	$curr_uid = $_POST["curr_uid"];
	$unfollow_this = new FollowingOfUser();
	echo $unfollow_this->unfollow($following,$fgid,$curr_uid);
?>