<?php
echo "php working";



if(isset($_POST["sendMessageButton"])){
	$type = $_POST["gender"];
	$fname = $_POST["first_name"];
	$lname = $_POST["last_name"];
	$address = $_POST["address"];
	$email = $_POST["email"];
	$phoneNo = $_POST["phone"];
	$password = $_POST["password"];
	$purpose = $_POST["purpose"];
	$classes = $_POST["site"];

	echo $password;


	$type = trim($type);
	$fname = trim($fname);
	$lname = trim($lname);
	$address = trim($address);
	$email = trim($email);
	$phoneNo = trim($phoneNo);
	$password = trim($password);
	$purpose = trim($purpose);
	$classes = trim($classes);

	$server = "localhost";
	$userName = "root";
	$pass = "";
	$db = "sda_final_project";

	$conn = mysqli_connect($server, $userName, $pass, $db);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";

	$sql = "INSERT INTO sign_up (type, fname, lname, address, email, phone_no, password, purpose, classes) VALUES ('$type','$fname', '$lname','$address','$email','$phoneNo','$password','$purpose','$classes')";

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