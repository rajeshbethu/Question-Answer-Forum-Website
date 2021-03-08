<?php
include "../classes/classes.php";
if(isset($_POST["submit"])){
	$answer_text = $_POST["answer_text"];
	if(empty($answer_text)){
		echo "<script>$('#answer-empty-error').css('display','block');</script>";
	}else{
		$qid = $_POST["qid"];
		$answer = new Answers();
		echo $answer->set($answer_text,$qid);
	}
}



?>