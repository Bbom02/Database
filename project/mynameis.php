<!DOCTYPE html>
<html lang='ko'>
	<head>
	    <title>My Name Is - Get </title>
	    <meta charset="UTF-8">
	</head>
	
	<body>
		<?php
			$first_name = $_GET["name1"];
			$last_name = $_GET["name2"];
		?>
		
		<p>
			Her or His fisrt name is 
				<?php echo $first_name;?>
			and last name is
				<?php echo $last_name;?>.
			<br>
		</p>
	</body>
</html>