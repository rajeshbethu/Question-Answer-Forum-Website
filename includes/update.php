<?php
include "../classes/classes.php";
if(isset($_POST["submit_bio"])){
	$fname = $_POST["edit_name"];
	$bio = $_POST["edit_bio"];
	$bio = htmlspecialchars($bio,ENT_QUOTES);
	$update = new Users();
	echo $update->editBio($fname,$bio);
}

if(isset($_POST["save_email"])){
	$email = $_POST["email"];
	$newemail = new Users();
	echo $newemail->update_email($email);
}

if(isset($_POST["save_pwd"])){
	$pwd = $_POST["pwd"];
	$newpwd = new Users();
	echo $newpwd->update_pwd($pwd);
}

if(isset($_POST["privacy"])){
	$key = $_POST["key"];
	$val = $_POST["val"];
	$privacy = new Settings();
	echo $privacy->updatePrivacy($key,$val);
}

if(isset($_POST["notify"])){
	$key = $_POST["key"];
	$val = $_POST["val"];
	$notify = new Settings();
	echo $notify->updateNotify($key,$val);
}



?>