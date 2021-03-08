<?php
include "../classes/classes.php";
if(isset($_POST["topic_id"])){
	$topic_id = $_POST["topic_id"];
	$delete_topic = new TopicsOfUser();
	echo $delete_topic->remove($topic_id);
}

?>