<?php
include "../classes/classes.php";

if(isset($_POST["save"])){
	$education = $_POST["education"];
    $profession = $_POST["profession"];
    $place = $_POST["place"];
}
$person = new Users();
$result = $person->editProfileInfo($education,$profession,$place);
echo $result;
?>