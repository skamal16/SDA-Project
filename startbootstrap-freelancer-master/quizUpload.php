<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>

  

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CS Unplugged</title>

  <!-- Custom fonts for this theme -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="css/freelancer.min.css" rel="stylesheet">

  <style type="text/css">
      #mainSection{
        position: relative;
        top: 100px;

      }
  </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">CS Unplugged</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="student.php">Dashboard</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div id="mainSection">
    <div class="container">

      <!-- Contact Section Heading -->
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Results</h2>

      <!-- Icon Divider -->
      <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>



<?php



    


    if (isset($_POST["submit"])) {
        $server = "localhost";
        $userName = "root";
        $pass = "";
        $db = "sda_final_project";

        $conn = mysqli_connect($server, $userName, $pass, $db);

        

        $score = 0;


        $question1 = $_POST["answer1"];
        $question2 = $_POST["answer2"];
        $question3 = $_POST["answer3"];
        $question4 = $_POST["answer4"];
        $question5 = $_POST["final"];

        $question1 = trim($question1);
        $question2 = trim($question2);
        $question3 = trim($question3);
        $question4 = trim($question4);
        $question5 = trim($question5);

        


        $q1 = mysqli_query($conn,"SELECT * FROM quiz_answers WHERE answer1 = '$question1'");
        $row1 = mysqli_fetch_assoc($q1);
        echo $row1;

        if($row1) {
            echo "<br><h4> Question 1 was answered correctly!</h>";
            $score = $score + 2;
        }
        else {
            echo "<br><h4> Question 1 was answered incorrectly!</h4>";
        }

        $q2 = mysqli_query($conn,"SELECT * FROM quiz_answers WHERE answer2 = '$question2'");
        $row2 = mysqli_fetch_assoc($q2);

        if($row2) {
            echo "<br><h4> Question 2 was answered correctly!</h4>";
            $score = $score + 2;
        }
        else {
            echo "<br><h4> Question 2 was answered incorrectly!</h4>";
        }

        $q3 = mysqli_query($conn,"SELECT * FROM quiz_answers WHERE answer3 = '$question3'");
        $row3 = mysqli_fetch_assoc($q3);

        if($row3) {
            echo "<br><h4> Question 3 was answered correctly!</h4>";
            $score = $score + 2;
        }
        else {
            echo "<br><h4> Question 3 was answered incorrectly!</h4>";
        }

        $q4 = mysqli_query($conn,"SELECT * FROM quiz_answers WHERE answer4 = '$question4'");
        $row4 = mysqli_fetch_assoc($q4);

        if($row4) {
            echo "<br><h4> Question 4 was answered correctly!</h4>";
            $score = $score + 2;
        }
        else {
            echo "<br><h4> Question 4 was answered incorrectly!</h4>";
        }

        $q5 = mysqli_query($conn,"SELECT * FROM quiz_answers WHERE answer5 = '$question5'");
        $row5 = mysqli_fetch_assoc($q5);

        if($row5) {
            echo "<br><h4> Question 5 was answered correctly!</h4>";
            $score = $score + 2;
        }
        else {
            echo "<br><h4> Question 5 was answered incorrectly!</h4>";
        }

        echo "<br><h4> Your score is ".$score."</h4>";

        $fname = $_SESSION["fname"];
        $lname = $_SESSION["lname"];

        $sqlScore = "INSERT INTO scores (fname,lname,score) VALUES ('$fname','$lname','$score')";
        $resultScore = mysqli_query($conn, $sqlScore);

        
        $sql = "INSERT INTO quiz (answer1, answer2, answer3, answer4, answer5) VALUES ('$question1','$question2', '$question3','$question4','$question5')";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "Results".$row;

        if (mysqli_query($conn, $sql)) {
        //echo "New record created successfully";
        } 
        else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    else{
        echo "Button not pressed";
    }


	
?>
</div>
</body>
</html>