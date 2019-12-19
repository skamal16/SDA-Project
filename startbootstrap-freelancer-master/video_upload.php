<?php

$server = "localhost";
$userName = "root";
$pass = "";
$db = "sda_final_project";

$conn = mysqli_connect($server, $userName, $pass, $db);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

//UPLOADING FILES

$title = $_POST["title"];

$title = trim($title);

$target_dir = "video_uploads/";
$uploadOk = 1;
$target_file = $target_dir . basename($_FILES["video"]["name"]);

$videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
	echo "Sorry, file already exists. ";
	$uploadOk = 0;
}

if ($_FILES["video"]["size"] > 10000000000) {
	echo "Sorry, your file is too large. ";
	echo $_FILES["video"]["size"];
	$uploadOk = 0;
}

if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
} else {
	if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["video"]["name"]). " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}

class Notifications_Publisher{
	public $subscribers;

	function __construct(){
		$this->subscribers = [];
	}
	
	function subscribe($subscriber){
		array_push($this->subscribers, $subscriber);
	}

	function update_notifications($conn, $new_video){
		foreach($this->subscribers as $subscriber){
			$subscriber->update($conn, $new_video);
		}
	}
}

class Student_Subscriber{
	public $name;
	public $new_videos;

	function __construct($name, $new_videos){
		$this->name = $name;
		$this->new_videos = $new_videos;
	}

	function update($conn, $new_video){
		
		$videos = explode(" ", $this->new_videos);

		$num_of_videos = $videos[0];

		$video_string = "";
		foreach (array_slice($videos, 1) as $video){
			if($video == $new_video) $new_video = false;
			$video_string = $video_string.$video." ";
		}

		if ($new_video != false) {
			$num_of_videos++;
			$video_string = $video_string." ".$new_video;
		}

		$video_string = $num_of_videos." ".$video_string;

		$sql = "UPDATE student_notification SET new_videos = '$video_string' WHERE student_name = '$this->name'";

		$conn->query($sql);
	}
}

//UPDATING TEACHER VIDEOS
session_start();

$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];

$sql = "SELECT video_names FROM teacher_video WHERE teacher_name = '$fname $lname'";

$raw = $conn->query($sql);
$result = $raw->fetch_assoc();

$videos = explode(" ", $result["video_names"]);

$num_of_videos = $videos[0];

$video_string = "";
foreach (array_slice($videos, 1) as $video){
	if($video == $title) $title = false;
	$video_string = $video_string.$video." ";
}

if ($title != false) {
	$num_of_videos++;
	$video_string = $video_string." ".$title;
}

$video_string = $num_of_videos." ".$video_string;

$sql = "UPDATE teacher_video SET video_names = '$video_string' WHERE teacher_name = '$fname $lname'";

$conn->query($sql);

//UPDATING STUDENT NOTIFICATIONS

$sql = "SELECT * FROM student_notification";

$raw = $conn->query($sql);

$publisher = new Notifications_Publisher();

while ($student = $raw->fetch_assoc()){

	$name = $student["student_name"];
	$new_videos = $student["new_videos"];

	$subscriber = new Student_Subscriber($name, $new_videos);
	$publisher->subscribe($subscriber);
}

$publisher->update_notifications($conn, $title);

//LOADING ALL VIDEOS IN DIRECTORY

$videoW = 320;
$videoH = 240;

if ($dh = opendir($target_dir)){

	$i = 0;

	while (($file = readdir($dh)) !== false){
		$i = $i + 1;

		if($file != '.' && $file != '..'){

			echo 
			"
				<div style='display: block'>
					<video width=\"$videoW\" height=\"$videoH\" controls>
					  <source src=\"". $target_dir . $file ."\" type=\"video/mp4\">
					  <source src=\"". $target_dir . $file ."\" type=\"video/ogg\">
					</video>
				</div>

				<!-- Portfolio Item $i -->
                        <div class=\"col-md-6 col-lg-4\">
                            <div class=\"portfolio-item mx-auto\" data-toggle=\"modal\" data-target=\"#portfolioModal$i\">
                                <div class=\"portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100\">
                                    <div class=\"portfolio-item-caption-content text-center text-white\">
                                        <i class=\"fas fa-plus fa-3x\"></i>
									</div>
									<div style='display: block'>
										<video width=\"$videoW\" height=\"$videoH\" controls>
										<source src=\"". $target_dir . $file ."\" type=\"video/mp4\">
										<source src=\"". $target_dir . $file ."\" type=\"video/ogg\">
										</video>
									</div>
                                </div>
                            </div>
                        </div>
			";

		}

	}

	closedir($dh);

  }

?>