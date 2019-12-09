<?php
	
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