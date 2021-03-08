<?php 

	if(!isset($_COOKIE["login_info"])) {
	    header("Location: http://localhost/qa/account.php");
	}else{
		// echo "<script>alert('hello already logged in');</script>";
	}

?>