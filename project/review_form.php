<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "작성";
$action = "review_insert.php";

if (array_key_exists("review_id", $_GET)) {
    $review_id = $_GET["review_id"];
    $query = "select * from product natural join review where review_id = $review_id";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_assoc($res);
    if(!$review) {
        msg("리뷰가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "review_modify.php";
}

if (array_key_exists("product_id", $_GET)) {
	$product_id = $_GET["product_id"];
}

?>

    <div class="container">
        <form name="review_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" id="product_id" name="product_id" value="<?=$product_id?>"/>
            <input type="hidden" id="review_id" name="review_id" value="<?=$review['review_id']?>" />
            <h3>리뷰 <?=$mode?></h3>
            <p>
                <label for="review_name">작성자</label>
                <input type="text" placeholder="이름을 작성하세요." id="review_name" name="review_name" value="<?=$review['review_name']?>"/>
            </p>
            <p>
                <label for="knowhow">제품에 대한 나의 생각</label>
                <textarea placeholder="제품을 사용하면서 생긴 생각이나 나만의 사용법이 있다면 공유해주세요!" id="knowhow" name="knowhow"><?=$review['knowhow']?></textarea>
            </p>

            <p>
                <label for="recommendation">추천 </label>
                <input type="checkbox" id="recommendation" name="recommendation" value="해요"><label>해요</label>
			    <input type="checkbox" id="recommendation" name="recommendation" value="마요"><label>마요</label>
            </p>
            <p align="center"><button class="button primary large" onclick="return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("review_name").value == "") {
                        alert ("리뷰에 들어갈 본인의 이름을 입력해 주세요."); 
                        return false;
                    }
                    else if(document.getElementById("knowhow").value == "") {
                        alert ("나만의 노하우를 입력해 주세요."); 
                        return false;
                    }
                    else if(document.getElementById("recommendation").value != "해요" or "마요") {
                        alert ("추천 해요마요를 골라주세요."); 
                        return false;
                    }
                    return true;
                }
            </script>
        </form>
    </div>
<? include("footer.php") ?>