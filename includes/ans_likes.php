<?php 

	include "../classes/classes.php";
	$aid = $_POST["aid"];
	$action = $_POST["action"];
	$btn = $_POST["btn"];
	$anslike = new Ans_Likes();
	if($action == 0){
		if($btn == 1){
			echo $anslike->removeLike($aid);
		}elseif ($btn == 0) {
			echo $anslike->removeDislike($aid);
		}
	}elseif($action == 1){
		if ($btn == 1) {
			if($anslike->isdisliked($aid)){
				echo $anslike->removeDislike($aid);
				echo $anslike->addLike($aid);
			}else{
				echo $anslike->addLike($aid);
			}
		}elseif ($btn == 0) {
			if($anslike->isliked($aid)){
				echo $anslike->removeLike($aid);
				echo $anslike->addDislike($aid);
			}else{
				echo $anslike->addDislike($aid);
			}			
		}
	}
?>