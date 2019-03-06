<?php
// function generateKey()
// {
// 	$keyLength = 8;
// 	$string = "1234567890abcdefghijklmnopqrstuvwxyz()/$";
// 	$randString = substr(str_shuffle($string),0,$keyLength);
// 	return $randString;

// }
// echo generateKey();

// function generateKey()
// {
	
	
// 	$randString = uniqid('joshua',true);
// 	return $randString;

// }
// echo generateKey();


function generateKey()
{
	
	
	$randString = uniqid('joshua',true);
	return $randString;

}
// echo generateKey();
print_r(PDO::getAvailableDrivers());
?>