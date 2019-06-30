<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>지니 Genie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class='navbar fixed'>
        <div>
            <a class='pull-left title' href="index.php">지니 Genie</a>
            <ul class='pull-right'>
                <li><a href='request_form.php'>제품 등록 요청</a></li>
                <li class="left-est"><a href='site_info.php'>SITE</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container">
    	<div class='search'>
    		<form action="product_list.php" method="post">
    			<input type="text" name="search_keyword" class="input" placeholder="무엇을 찾고 계세요?"> 
    			<input type="image" src="images/genie.jpg" class="image">
    		</form>
    	</div>
    </div>