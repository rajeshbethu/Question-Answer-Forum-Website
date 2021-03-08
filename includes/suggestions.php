<?php
	require "../db_connect.php";
	if(isset($_POST["name"])){
		$name = $_POST["name"];
		if(!empty($name)){
			$sql = "select uid,fname,profession from users;";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$fname = $row["fname"];
					if(stripos($fname,$name)!==false){
						$prof = $row["profession"];
						$uid = $row["uid"];
						echo "<p class='sug_list'><span id='name_sug'>$fname</span><span id='prof_sug'>$prof</span><span onclick='add_rqst($uid)' id= 'rqst_icon'><i class='fas fa-plus-circle' style='font-size:20px;color:#155da7' id='icon_$uid'></i></span></p>";
					}
				}
			}
		}
	}
?>