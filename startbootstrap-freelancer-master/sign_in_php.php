<?php


if(isset($_POST["sendMessageButton"])){
	
	$email = $_POST["email"];
	$password = $_POST["password"];

	session_start();



	$email = trim($email);
	$password = trim($password);


	$server = "localhost";
	$userName = "root";
	$pass = "";
	$db = "sda_final_project";

	$conn = mysqli_connect($server, $userName, $pass, $db);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";


	$sql = "select * from sign_up where email = '$email' and password = '$password'";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	echo "Results".$row;

	if ($row['email'] == $email && $row['password'] == $password) {
		echo "Login success!!!".$row['type'];
		$_SESSION["fname"] = $row['fname'];
		$_SESSION["lname"] = $row['lname'];


		if($row['type'] == "Student"){
			header("Location: student.php");
		}
		else{
			header("Location: teacher.html");
		}
		//header("Location: student.html");
		# code...
	}
	else{
		echo "Failed to login";
	}

}
else{
	echo "button not pressed";
}





?>