  <?php

      require('db.php');

      if (isset($_POST['submit'])) {

             
              $empID = $_POST['empid'];
              $empEmail = $_POST['empemail'];
              $empPassword = $_POST['password'];
              $empFname = $_POST['empfname'];
              $empLname = $_POST['emplname'];
              $empSchool = $_POST['school'];
              $empGrade = $_POST['grade'];
              $empDivision = $_POST['division'];
              $empSubject = $_POST['subject'];
              
           
             $empInsert = "INSERT INTO employee (empID, empfname, emplname, empEmail, school, grade, division, subject, password) VALUES ('$empID','$empFname','$empLname','$empEmail','$empSchool','$empGrade','$empDivision','$empSubject','$empPassword')";   

             if(mysqli_query($conn, $empInsert)){
              echo "<script type='text/javascript'>alert('You have successfully Signed Up');</script>";
             }

             else
             {

              echo 'Error: '.mysqli_error($conn);
             }
      }

    



      ?>



  <!DOCTYPE html>
  <html>
  <head>
      <title>Sign Up</title>
      <link rel="stylesheet" href="bootstrap.css" media="screen">
  </head>
  <body>

  <div class="container">
    <form class="form-group"  method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" >
  <a class="btn btn-default" href="index.php"><<<<---Back</a>
    <fieldset>
      <legend>Sign Up</legend>
      

        <div class="form-group">
        <label for="ID">Employee ID</label>
        <input type="text" class="form-control" placeholder="Enter Akanksha Emp Id" name="empid" required="">
        
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="empemail" required="">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required="">
      </div>

      <div class="form-group">
        <label for="empfname">First Name</label>
        <input type="text" class="form-control" placeholder="First Name" name="empfname" required="">
        
      </div>

     <div class="form-group">
        <label for="emplname">Last Name</label>
        <input type="text" class="form-control" placeholder="Last Name" name="emplname" required="">
        
      </div>


      <div class="form-group">
        <label for="exampleSelect1">School</label>
        <select class="form-control" id="exampleSelect1" name="school" required="">
          <option>ANWEMS</option>
          <option>BOPEMS</option>
          <option>KCTVN</option>
          <option>SBP</option>
          <option>CSMEMS</option>
          <option>LAPMEMS</option>
          <option>PKGEMS</option>
          <option>ABMPS</option>
        </select>
      </div>

       <div class="form-group">
        <label for="exampleSelect1">Grade</label>
        <select class="form-control" id="grade" name="grade" required="">
          <option>Jr.Kg</option>
          <option>Sr.Kg</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
      </div>

      <div class="form-group">
        <label for="exampleSelect1">Grade</label>
        <select class="form-control" id="division" name="division" required="">
          <option>A</option>
          <option>B</option>
          <option>C</option>
              </select>
      </div>

      <div class="form-group">
        <label for="exampleSelect1">Grade</label>
        <select class="form-control" id="subject" name="subject" required="">
          <option>English</option>
          <option>Maths</option>
          <option>Science</option>
          <option>Social Studies</option>
          <option>Art</option>
          <option>Marathi</option>
          <option>Hindi</option>
              </select>
      </div>

      
      
      
     
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </fieldset>
  </form>
  </div>

  </body>
  </html>