<!DOCTYPE html>
<html lang='ko'>
	<head>
	    <title>My Name Is - Post</title>
	    <meta charset="UTF-8">
	</head>
	
	<body>
		<?php
			$first_name = $_POST["name1"];
			$last_name = $_POST["name2"];
		?>
		
		<p>
			Her or His fisrt name is 
				<?php echo $first_name;?>
			and last name is
				<?php echo $last_name;?>.
		</p>
	</body>
</html>