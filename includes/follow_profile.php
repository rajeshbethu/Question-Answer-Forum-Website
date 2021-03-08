<?php
	include "../classes/classes.php";
	
	$profile_uid = $_POST["profile_uid"];
	$profile_uname = $_POST["profile_uname"];
	$follow = new FollowingOfUser();
	echo $follow->addFollowing($profile_uid,$profile_uname);
?>