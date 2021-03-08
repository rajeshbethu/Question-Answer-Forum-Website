<?php
	include "../classes/classes.php";
	$to = $_POST["to"];
	$type = $_POST["type"];
	$link = $_POST["link"];
	if($type == 1){
		$new_notification = new NotificationsOfUser();
		echo $new_notification->set($to,$type,$link);
	}elseif ($type == 2) {
		$conn = new Database();
		$conn = $conn->connect();
		$sql = "select uid from qtns where qid=$link";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$to = $row["uid"];
		$new_notification = new NotificationsOfUser();
		echo $new_notification->set($to,$type,$link);
	}
	
?>