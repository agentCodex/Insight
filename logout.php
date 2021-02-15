	<?php
	ob_start();
	session_start();
	if($_SESSION['email']){
	unset($_SESSION['email']); // destroys the specified session.

	}

	header('Location:index.php'); //redirect to preferred page after unset the session

	?>