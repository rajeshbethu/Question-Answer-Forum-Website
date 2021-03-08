<?php
	if(setcookie("login_info", "", time() - 3600, "/")){
		echo "<script> location.reload(true);  </script>";
	}else{
		echo "<script> alert('logout failed');</script>";
	}
?>