<?php

@include 'config.php';

session_start();

if (isset($_POST['createStudy'])) {
    $stu_name = mysqli_real_escape_string($conn, $_POST['study_name']);
    $stu_desc = mysqli_real_escape_string($conn, $_POST['study_desc']);
    $stu_loc = mysqli_real_escape_string($conn, $_POST['study_loc']);
    $stu_time = mysqli_real_escape_string($conn, $_POST['study_time']);
    $stu_type = mysqli_real_escape_string($conn, $_POST['study_type']);
    $stu_tags = mysqli_real_escape_string($conn, $_POST['study_tags']);
    $stu_email = mysqli_real_escape_string($conn, $_POST['study_email']);

    #$select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
    #$result = mysqli_query($conn, $select);

	//Checks for empty inputs b/c some studies may not have all info avaliable
	//however currently all inputs require text
	if($stu_name == ''){
		$error[] = 'You must enter a study name.';
	} else {
		if($stu_desc == ''){
			$error[] = 'You must enter a study descrition.';
		} else {
			if($stu_loc == ''){
			$error[] = 'You must enter a study location.';
			} else {
				if($stu_time == ''){
					$error[] = 'You must enter a study time.';
				} else {
					if($stu_type == ''){
						$error[] = 'You must enter a study type.';
					} else {
						if($stu_tags == ''){
							$error[] = 'You must enter a study tag.';
						} else {
							if($stu_email == ''){
								$error[] = 'You must enter a study email.';
							} else {
								$insert2 = "INSERT INTO study_form(study_name, study_desc, study_loc, study_time, study_type, study_tags, study_email) VALUES('$stu_name','$stu_desc','$stu_loc','$stu_time','$stu_type','$stu_tags','$stu_email')";
								mysqli_query($conn, $insert2);
								header('location:studies.php');
							}
						}
					}
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="style4.css"> -->
    <title>Studies</title>
	
	<style>
			.top-header {
   					 		margin: 0;
    					    padding: 20px;
    						text-align: center;
    						background-color: #00853E;
    						color: white;
    						font-size: 30px;
						}

			.content {
    						display: flex;
    						justify-content: center;
    						align-items: center;
    						gap: 20px 20px;
					}	
		</style>
</head>

<body>

 <div class="container">
        <div class="top-header">
            Create Study
        </div><br>

        <div class="content">

			<form action="" method="post">
		
				<?php
				if (isset($error)) {
					foreach ($error as $error) {
						echo '<span class="error-msg">' . $error . '</span>';
					};
				};
				?>
		
				<label for="studyname"><b>Study Name:</b></label><br>
				<input type="text" name="study_name" required placeholder="Enter the study name">
				<br>
		
				<label for="studydescription"><b>Study Description:</b></label><br>
				<input type="text" name="study_desc" required placeholder="Enter the study description">
				<br>
				
				<label for="studylocation"><b>Study location:</b></label><br>
				<input type="text" name="study_loc" required placeholder="Enter the study location">
				<br>
				
				<label for="studytime"><b>Study time:</b></label><br>
				<input type="text" name="study_time" required placeholder="Enter the study time">
				<br>
				
				<label for="studytype"><b>Study type:</b></label><br>
				<input type="text" name="study_type" required placeholder="Enter the study type">
				<br>
				
				<label for="studytags"><b>Study tag(s):</b></label><br>
				<input type="text" name="study_tags" value="tag1" required placeholder="Enter the study tag(s)">
				<br>
		
				<label for="email"><b>Email:</b></label><br>
				<input type="email" name="study_email" required placeholder="Enter an Email">
				<br>
		
				<input type="submit" name="createStudy" value="Create new study" class="form-btn">
				<br>
			</form>
			
         </div>
		<p><a href="studies.php">Cancel</a></p><br>
    </div>
</body>

</html>