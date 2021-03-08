<?php
include "../classes/classes.php";
$name = $_POST['name'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$email = $_POST['email'];
$submit = $_POST['submit'];


if(!empty($submit)){

	$nameok = true;
	$unameok = true;
	$pwdok = true;
	$emailok = true;

	$person = new Users();

	if(empty($name)){
		echo "<script>$('#name-empty-error').css('display','block'); </script>";
		$nameok = false;
	}
	if(empty($uname)){
		echo "<script>$('#uname-empty-error').css('display','block'); </script>";
		$unameok = false;
	}else{
		$unamefound = $person->isUnameExists($uname);
		if($unamefound){
			echo $unamefound;
			$unameok = false;
		}else{
			$unameok = true;
		}
	}
	if(empty($pwd)){
		echo "<script>$('#pwd-empty-error').css('display','block');  </script>";
		$pwdok = false;
	}elseif (strlen($pwd)<8) {
		echo "<script> $('#pwd-length-error').css('display','block');  </script>";
		$pwdok = false;
	}
	if(empty($email)){
		echo "<script> $('#email-empty-error').css('display','block'); </script>";
		$emailok = false;
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script>$('#email-invalid-error').css('display','block');  </script>";
		$emailok = false;
	}else{
		$emailfound = $person->isEmailExists($email);
		if($emailfound){
			echo $emailfound;
			$emailok = false;
		}else{
			$emailok = true;
		}
	}
}
	if($nameok == true && $unameok == true && $pwdok == true && $emailok == true){
		$person = new Users();
		echo $person->set($name, $uname, $email, $pwd);
	}

?>