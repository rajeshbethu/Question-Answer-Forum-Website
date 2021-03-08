<?php
require "../db_connect.php";
include "../classes/classes.php";
if(isset($_POST["topic_typed"])){
	$topic_typed = $_POST["topic_typed"];
	if(!empty($topic_typed)){
		$sql = "select * from all_topics;";
		$result = $conn->query($sql);
		$match = false;
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$db_topic = $row["topics"];
				if(stripos($db_topic,$topic_typed)!==false){
					$check = new TopicsOfUser();
					if($check->isexists($db_topic)){
						// continue;
						$tid = $row["atid"];
						echo "<div class='sugg_topic_item'><a>$db_topic</a><span class='add_topic_btn topic_added' id='topic_$tid'>added</span></div>";
						$match = true;
					}else{
						$tid = $row["atid"];
						echo "<div class='sugg_topic_item'><a>$db_topic</a><span class='add_topic_btn' onclick=\"add_topic('$db_topic',$tid)\" id='topic_$tid'>add</span></div>";
						$match = true;
					}
					
				}
			}
			if($match == false){
				echo "<div class='sugg_topic_item'><a>No match</a></div>";
			}
		}
	}
}


?>