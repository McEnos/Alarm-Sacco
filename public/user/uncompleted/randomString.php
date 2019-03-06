<?php
	function GenerateString($length) {
		$strings = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$stringLength = strlen($strings);
		$newStrings = '';
		for ($i = 0; $i < $length; $i++) {
			$newStrings .= $strings[rand(0, $stringLength - 1)];
		}
		return $newStrings;
	}
 
	if(ISSET($_POST['generate'])){
		$length = $_POST['length'];
		echo '<center><h3 style="border:1px solid #000; padding:5px;" class="text-success">'.GenerateString($length).'</h3></center>';
	}
?>