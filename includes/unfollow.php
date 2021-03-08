<?php
include "../classes/classes.php";
if(isset($_POST["space_id"])){
	$space_id = $_POST["space_id"];
	$delete_space = new SpacesOfUser();
	echo $delete_space->remove($space_id);
}

?>