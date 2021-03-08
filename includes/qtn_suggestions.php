<?php
	require "../db_connect.php";
	if(isset($_POST["qtn_text_input"])){
		$qtn_text_input = $_POST["qtn_text_input"];
		if(!empty($qtn_text_input)){
			$sql = "select qid,qtn_text from qtns;";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					$qtn_text = $row["qtn_text"];

					if(stripos($qtn_text, $qtn_text_input)!==false){
						// echo "<script>alert('$qtn_text');</script>";
						$qid = $row["qid"];
						echo "<p class='qtn_suggest_item'><a href='qtn.php?id=$qid'>$qtn_text</a></p>";
					}
				}
			}
		}
	}
?>