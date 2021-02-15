
	<?php



	require('db.php');
	session_start();

		$email = $_SESSION['email'];


		$assessmentDateQuery = "SELECT  DISTINCT assessment_date from assessment where empemail = '$email' ";
		

		$result = mysqli_query($conn, $assessmentDateQuery);
		
		$fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		
		$numOfAssessments = mysqli_num_rows($result);

		//echo $numOfAssessments;

		

		mysqli_free_result($result);
		
		

		

		//take values from 

		if (isset($_POST['submit'])) {

			if (!empty($_POST['select_date'])) {
				
			

			foreach ($_POST['select_date'] as $selectdate) {

				

					//echo "You have selected assessment date as : ".$selectdate." and the type is : ".$selecttype;

					if($selectdate == "Overall Performance"){

							$assessmentOverallQuery = "SELECT student_id, studfname, studlname, school, grade, division, assessment_date, assessment_type, subject, round(AVG( CASE WHEN assessment_type = 'Formative' THEN avg_score * 0.8 WHEN assessment_type = 'Summative' THEN avg_score * 0.2 ELSE 0 END ),0) AS avg_score from assessment where empemail = '$email' group by student_id, assessment_type";


							$classAverage = "SELECT round(AVG( CASE WHEN assessment_type = 'Formative' THEN avg_score * 0.8 WHEN assessment_type = 'Summative' THEN avg_score * 0.2 ELSE 0 END ),0) AS avg_score from assessment where empemail = '$email' group by assessment_type ";

				}

					else {

					$assessmentOverallQuery = "SELECT student_id, studfname, studlname, school, grade, division, assessment_date, assessment_type, subject, avg_score from assessment where empemail = '$email' and assessment_date = '$selectdate' ORDER BY student_id";

					$classAverage = "SELECT AVG(avg_score) AS avg_score from assessment where empemail = '$email' and assessment_date = '$selectdate' group by assessment_date";

						}

					
					$resultOverall = mysqli_query($conn, $assessmentOverallQuery);

					$resultClassAverage = mysqli_query($conn, $classAverage);

					//$resultDateType = mysqli_query($conn, $assessmentDateType);


					$fetchOverall = mysqli_fetch_all($resultOverall, MYSQLI_ASSOC);

					$fetchClassAverage = mysqli_fetch_all($resultClassAverage, MYSQLI_ASSOC);

					//$fetchDateType = mysqli_fetch_all($resultDateType, MYSQLI_ASSOC);

					mysqli_close($conn);
	
		}

	}

	else
	echo "<script type='text/javascript'>alert('Please select Date from the dropdown');</script>";
	 
	 }

	error_reporting(0);


	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Analysis</title>
		<?php include('header.php'); ?>
	</head>
	<body>

		<fieldset>


	  <form method="POST" class="form-horizontal"> 
	  <br><br><br>
	  <div class="container border">
		 <LEGEND><br><h4 align="center">Report Card (Calculates according to CCE component when viewing overall performance)</h4></LEGEND>

		<br><br><h6 align="center">Number of Assessment/s submitted by <?php echo $email." is:"." ";?> <span class="badge badge-success" align="center"><?php echo $numOfAssessments."<br>";?></span></h6>

		<br><h6 align="center">Class Average  <span class="badge badge-success" align="center">
			<?php $sum = 0; ?>

			<?php foreach($fetchClassAverage as $key1) : ?>
	      	
	      	<?php $sum += $key1['avg_score']; ?>
	 
	      <?php endforeach; ?>
	      <?php echo round($sum) ."%"; ?>

			
		</span></h6>

		
			<div class="col px-md-5">
		   <label>Select Date : </label><select class="custom-select" name="select_date[]" placeholder="Select Date">
		    	 <option ></option>
	      <option selected=""> </option>
	      <option >Overall Performance</option>

	      <?php foreach($fetch as $key) : ?>
	      	
	          
	      <?php echo "<option value='" . $key['assessment_date'] . "'>" . $key['assessment_date']."<br>" ; ?>
	      
	       
	      <?php endforeach; ?>

	    </select>
	    <input type="submit" name="submit" class="btn btn-primary" align="center">
			</div>

	  

	   
	  </div>
	  </form>

	</fieldset>

	<br><br>
	<div class="container border">
		  		<table class="table">
		  			<tr><br>
		  				<th>Student ID</th>
		  				<th>First Name</th>
		  				<th>Last Name</th>
		  				<th>School</th>
		  				<th>Grade</th>
		  				<th>Division</th>
		  				<th>Assessment_Type</th>
		  				<th>Subject</th>
		  				<th>Score</th>
		  			</tr>
		  		<div>
		  			<?php foreach($fetchOverall as $studentOverall): ?>

		  				<?php echo "<tr><td>".$studentOverall["student_id"]."</td><td>".$studentOverall['studfname']."</td><td>".$studentOverall["studlname"]."</td><td>".$studentOverall["school"]."</td><td>".$studentOverall["grade"]."</td><td>".$studentOverall["division"]."</td><td>".$studentOverall["assessment_type"]."</td><td>".$studentOverall["subject"]."</td><td>".$studentOverall["avg_score"]."</td></tr>"; ?>

		  			<?php endforeach ; ?>
		  		</div>
		  	</table>
		  </div>
	</body>
	</html>