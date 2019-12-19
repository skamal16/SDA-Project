<?php

if (isset($_POST['submit'])) {
    # code...


	$server = "localhost";
	$userName = "root";
	$pass = "";
	$db = "sda_final_project";

	$conn = mysqli_connect($server, $userName, $pass, $db);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";




	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$question1 = test_input($_POST["answer1"]);
	$question2 = test_input($_POST["answer2"]);
	$question3 = test_input($_POST["answer3"]);
	$question4 = test_input($_POST["answer4"]);
	$question5 = test_input($_POST["final"]);
	}

	function test_input($data) {
	  $data = trim($data);
	  return $data;
	}

	$q1 = mysqli_query($con,"SELECT * FROM quiz WHERE answer1 = $question1");
    $row1 = mysqli_fetch_assoc($q1);

    if($row1) {
    	echo "<br> Question 1 was answered correctly!";
    }
    else {
    	echo "<br> Question 1 was answered incorrectly!";
    }

    $q2 = mysqli_query($con,"SELECT * FROM quiz WHERE answer2 = $question2");
    $row2 = mysqli_fetch_assoc($q2);

    if($row2) {
    	echo "<br> Question 2 was answered correctly!";
    }
    else {
    	echo "<br> Question 2 was answered incorrectly!";
    }

    $q3 = mysqli_query($con,"SELECT * FROM quiz WHERE answer3 = $question3");
    $row3 = mysqli_fetch_assoc($q3);

    if($row3) {
    	echo "<br> Question 3 was answered correctly!";
    }
    else {
    	echo "<br> Question 3 was answered incorrectly!";
    }

    $q4 = mysqli_query($con,"SELECT * FROM quiz WHERE answer4 = $question4");
    $row4 = mysqli_fetch_assoc($q4);

  	if($row4) {
    	echo "<br> Question 4 was answered correctly!";
    }
    else {
    	echo "<br> Question 4 was answered incorrectly!";
    }

    $q5 = mysqli_query($con,"SELECT * FROM quiz WHERE answer5 = $question5");
    $row5 = mysqli_fetch_assoc($q5);

  	if($row5) {
    	echo "<br> Question 5 was answered correctly!";
    }
    else {
    	echo "<br> Question 5 was answered incorrectly!";
    }
	
	$sql = "INSERT INTO quiz (answer1, answer2, answer3, answer4, answer5) VALUES ('$question1','$question2', '$question3','$question4','$question5')";

	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo "Results".$row;

	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
	} 
	else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
?>