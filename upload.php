
	<?php 


	require('db.php');
	require('PHPMailer/PHPMailerAutoload.php');


	session_start();
	$email = $_SESSION['email'];


	$empDetailsQuery = "SELECT * from employee where empEmail = '$email' ";



		$result = mysqli_query($conn, $empDetailsQuery);

		$fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);

		mysqli_free_result($result);



		//var_dump($fetch);
		foreach ($fetch as $key) {

			$school1 = $key['school'];
			$grade1 = $key['grade'];
			$division1 = $key['division'];
		}

			//echo "$grade";




	if (isset($_POST['submit'])) {






		/////////////////////////////////////query for employee details
			
			$fileName = $_FILES['myFile'] ['name'];
			$fileTmpName = $_FILES['myFile'] ['tmp_name'];

			//find file extension

			$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
			//echo $fileExtension;

			//allowed extenstion

			$allowed = array('csv');
			if(!in_array($fileExtension, $allowed)){?>
				<div class="alert alert-danger">
					Invalid File extension
				</div> 

			<?php } else {


				$handle = fopen($fileTmpName, 'r');

				while (($myData = fgetcsv($handle, 1000, ',')) !== FALSE) {
					
					$student_id = $myData[0];
					$studFname = $myData[1];
					$studLname = $myData[2];
					$school = $myData[3];
					$grade = $myData[4];
					$division = $myData[5];
					$assessment_date = $myData[6];
					$assessment_type = $myData[7];
					$subject = $myData[8];
					$empEmail = $myData[9];
					$assessment_score = $myData[10];

					//echo "$assessment_date";

					//query

					if($school == $school1 && $grade == $grade1 && $division == $division1 ){

					$assessmentInsert = "INSERT INTO assessment (student_id, studfname, studlname, school, grade, division,assessment_date,assessment_type, subject, empemail, avg_score) VALUES ('$student_id', '$studFname', '$studLname', '$school', '$grade', '$division', '$assessment_date', '$assessment_type', '$subject', '$empEmail', '$assessment_score' )";

					//run
					$run = mysqli_query($conn, $assessmentInsert);



				}

				

	    		
	}

		
		$status = '';
		error_reporting(0);
		if(mysqli_query($conn, $assessmentInsert)){

	            echo "<script type='text/javascript'>alert('You have successfully Uploaded the CSV, , as this free host does not contain a mail server hence mail cant be sent but the code does work on Localhost');</script>";
	            $status = "Your file has been successfully Uploaded ";
	           }

	           else
	           {

	            echo "<script type='text/javascript'>alert('You do not have permission, , as this free host does not contain a mail server hence mail cant be sent but the code does work on Localhost');</script>";

	            $status = "You do not have permission to upload file for this grade and division, as this free host does not contain a mail server hence mail cant be sent but the code does work on Localhost";;
	           }


	           //Mail
	           $mailer = new PHPMailer;
				$mailer->isSMTP();
				$mailer->Host = 'tls://smtp.gmail.com';
				
				$mailer->Port = 465; //can be 587
				
				$mailer->SMTPAuth = TRUE;

				$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
				
				// Change this to your gmail address
				$mailer->Username = 'nikhil.aher@gmail.com';  
				// Change this to your gmail password
				$mailer->Password = 'Motoming@123';  
				// Change this to your gmail address
				$mailer->From = 'nikhil.aher@gmail.com';  
				// This will reflect as from name in the email to be sent
				$mailer->FromName = 'Insight'; 
				$mailer->Body = $status;
				$mailer->Subject = 'Assessment upload status';
				// This is where you want your email to be sent
				$mailer->AddAddress($email);  /////To mail
				if(!$mailer->Send())
				{
				    //echo "Message was not sent<br/ >";
				   // echo "Mailer Error: " . $mailer->ErrorInfo;
				    
				}
				else
				{
					//echo "Success";
				     
				}


	       		} //outer if


	}

	 ?>


	<html>
	<head>

		<?php include('header.php');?>
		<title>Upload</title>

		
	</head>
	<body>

	<br><br>
	<span class="border border-primary"></span>
	<div class="container border">
		<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group" style="border:thin">
	      <label for="exampleInputFile <br>">File input</label>
	      <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="myFile">
	      <small id="fileHelp" class="form-text text-muted"></small>
	      <input type="submit" name="submit" class="btn btn-primary" >
	    </div>

	</form>
	</div>

	</body>
	</html>