<?php
// require "db_connect.php";
	include "../classes/classes.php";
	$topic = $_POST["topic"];
	$tid = $_POST["tid"];

	$add_topic = new TopicsOfUser();
	echo $add_topic->set($topic,$tid);
	

?>