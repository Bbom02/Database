<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("review_id", $_GET)) {
    $review_id = $_GET["review_id"];
    $query = "select * from product natural join review where review_id = $review_id";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_assoc($res);
}
?>
    <div class="container fullwidth">

        <h3>리뷰 상세 보기</h3>
        
        <p>
            <label for="review_name">작성자</label>
            <input readonly type="text" id="review_name" name="review_name" value="<?= $review['review_name'] ?>"/>
        </p>

        <p>
            <label for="product_name">제품 이름</label>
            <input readonly type="text" id="product_name" name="product_name" value="<?=$review['product_name']?>"/>
            
        </p>
        <p>
            <label for="knowhow">제품에 대한 생각 및 나만의 사용방법</label>
            <input readonly type="text" id="knowhow" name="knowhow" value="<?= $review['knowhow'] ?>"/>
        </p>

        <p>
            <label for="recommendation">추천 여부</label>
            <input readonly type="text" id="recommendation" name="recommendation" value="<?= $review['recommendation'] ?>"/>
        </p>

        <p>
            <label for="product_price">가격</label>
            <input readonly type="number" id="product_price" name="product_price" value="<?= $review['product_price'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>