<?php

include "db_connect.php";

for($i=1;$i<=260;$i++){
	$sql = "drop table topics_of_".$i;
	
	$conn->query($sql);

}
echo "ok";



?>