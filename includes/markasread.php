<?php
	include "../classes/classes.php";
	$nid = $_POST["nid"];
	$notification = new NotificationsOfUser();
	echo $notification->markAsRead($nid);
?>