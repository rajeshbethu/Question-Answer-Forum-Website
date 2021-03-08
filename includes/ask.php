<?php
include "../checklogin.php";
include "../classes/classes.php";
if(isset($_POST['submit'])){
	$qtn_text = $_POST["qtn_text"];
	$date = date("j, F Y");
	$qtn_topics = $_POST["qtn_topics"];
	if(!empty($qtn_text)){
		$askqtn = new Qtns();
		echo $askqtn->ask($qtn_text,$date,$qtn_topics);	
	}else{
		echo "<script> $('#qtn-error').css('display','block');  </script>";
	}

}
?>
