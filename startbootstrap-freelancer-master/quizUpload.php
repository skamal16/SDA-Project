<?php


if(isset($_POST["submit"])){
	
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

	$server = "localhost";
	$userName = "root";
	$pass = "";
	$db = "sda_final_project";

	$conn = mysqli_connect($server, $userName, $pass, $db);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";


	//$sql = "select * from answers where answer1 = '$question1' and answer2 = '$question2' and  answer3 = '$question3' and  answer4 = '$question4' and  answer5 = '$question5'";

	$sql = "INSERT INTO quiz (answer1, answer2, answer3, answer4, answer5) VALUES ('$question1','$question2', '$question3','$question4','$question5')";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	echo "Results".$row;

	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
	} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

}
else{
	echo "button not pressed";
}





?>