<?php 
	include "../classes/classes.php";

	$qid = $_POST["qid"];
	$action = $_POST["action"];
	$like = new Qtn_Likes();
	if($action == 0){
		echo $like->removeLike($qid);
	}elseif ($action == 1) {
		echo $like->addLike($qid);
	}
?>