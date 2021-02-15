<?php
	//require('config.php');
	//$conn = mysqli_connect('sql306.epizy.com','epiz_25138623', 'motoming123', 'epiz_25138623_Insight');
	$conn = mysqli_connect('localhost','root', '', 'insight');

	if(mysqli_connect_errno()){

		echo 'Failed to connect'.mysqli_connect_errno();
	}
?>