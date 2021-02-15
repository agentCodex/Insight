	<?php

		require('db.php');
		session_start();


	//$_SESSION['school'] = mysqli_escape_string($school);
	//$_SESSION['grade'] = $grade;
	//$_SESSION['division'] = $division;

		$email = $_SESSION['email'];
		$password = $_SESSION['password'];




		$empDetailsQuery = "SELECT * from employee where empEmail = '$email' ";



		$result = mysqli_query($conn, $empDetailsQuery);

		$fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);

		mysqli_free_result($result);



		//var_dump($fetch);
		foreach ($fetch as $key) {

			$school = $key['school'];
			$grade = $key['grade'];
			$division = $key['division'];
		}

		$studentDetailsQuery = "SELECT * from student where school ='$school' and grade ='$grade' and division ='$division' ";


		$resultStudent = mysqli_query($conn, $studentDetailsQuery);

		$fetchStudent = mysqli_fetch_all($resultStudent, MYSQLI_ASSOC);
		//var_dump($fetchStudent);

		mysqli_free_result($resultStudent);

		mysqli_close($conn);


	?>

	<html>
	<head>

		<?php include('header.php');?>
		<title>Main Page</title>

		
	</head>
	<body>
	  
	  	<div class="well">
	  	<?php foreach ($fetch as $empFetch) : ?>
	  		<div>
	  			<h6 align="center"><?php echo "<br><br>Welcome ".$empFetch['empfname'].", Subject : ".$empFetch['subject'].", Grade ".$empFetch['grade'].", Division ".$empFetch['division']."<br>"; ?> <h6>
	  			
		  		</div>
		  	<?php endforeach ; ?>
		  		</div>

		  		<div class="container border">
		  		<table class="table">
		  			<tr><br>
		  				<th>Student ID</th>
		  				<th>First Name</th>
		  				<th>Last Name</th>
		  				<th>Gender</th>
		  				<th>School</th>
		  				<th>Grade</th>
		  				<th>Division</th>
		  			</tr>
		  		<div>
		  			<?php foreach($fetchStudent as $student): ?>

		  				<?php echo "<tr><td>".$student["Student_Id"]."</td><td>".$student['firstName']."</td><td>".$student["lastName"]."</td><td>".$student["gender"]."</td><td>".$student["school"]."</td><td>".$student["grade"]."</td><td>".$student["division"]."</td></tr>"; ?>

		  			<?php endforeach ; ?>
		  		</div>
		  	</table>
		  </div>

	</body>
	</html>