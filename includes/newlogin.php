<?php
include "../classes/classes.php";

	$submit = $_POST['submit'];

	if(!empty($submit)){
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		if(empty($email)){
			echo "<script>$('#login-info').html('Please type your email');</script>";
		}
		if(empty($pwd)){
			echo "<script>$('#login-info').html('Please type your password');</script>";
		}
		if(!empty($email) && !empty($pwd)){
			$person = new Users();
			echo $person->login($email,$pwd);
		}
	}
?>