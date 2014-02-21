<?php
	include_once("validator.class.php");
	
	$names = "";

	$u = new Validator("Names",$names);
	
	echo $u->getValue();
	
	if(Validator::isError()) { 
		echo "There was an error";
		echo Validator::displayErrors();
	}
	else {
		echo "All was good :D";
	}
	
?>