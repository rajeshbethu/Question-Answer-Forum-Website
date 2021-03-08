<?php
include "../classes/classes.php";
if(isset($_POST["submit"])){

	$sname = $_POST["sname"];
    $sdesc = $_POST["sdesc"];
    $ldesc = $_POST["ldesc"];
    


    	$snameok = true;
		$sdescok = true;
		

		$space = new Spaces();

		if(empty($sname)){
			echo "<script> $('#sname-empty-error').css('display','block'); </script>";
			$snameok = false;
			
		}else{
			$snamefound = $space->isSpaceExists($sname);
			if($snamefound){
				echo $snamefound;
				$snameok = false;
			}else{
				$snameok = true;
			}
		}

		if(empty($sdesc)){
			echo "<script>$('#sdesc-empty-error').css('display','block'); </script>";

		}
		
	


	if($snameok == true && $sdescok == true){
		
		echo $space->set($sname, $sdesc, $ldesc);
	}

}	

?>