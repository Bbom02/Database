<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	
	<?
		$conn = dbconnect($host, $dbid, $dbpass, $dbname);
		$mode = '작성';
		if (array_key_exists("product_id", $_GET)) {
		    $product_id = $_GET["product_id"];
		    $query = "select * from review natural join product natural join type where product_id = $product_id";
		    $res = mysqli_query($conn, $query);
		}
		if (array_key_exists("review_id", $_GET)) {
		    $review_id = $_GET["review_id"];
		}
	?>
	
	<table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>추천제품</th>
            <th>유형</th>
            <th>가격</th>
            <th>추천</th>
            <th>확인</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['review_name']}</td>";
            echo "<td>{$row['product_name']}</td>";
            echo "<td>{$row['type_name']}</td>";
            echo "<td>{$row['product_price']}</td>";
            echo "<td>{$row['recommendation']}</td>";
            echo "<td width='17%'>
                <a href='review_detail.php?review_id={$row['review_id']}'><button class='button primary small'>자세히</button></a>
                <a href='review_form.php?review_id={$row['review_id']}'><button class='button primary small'>수정</button></a>
				<button onclick='javascript:deleteConfirm({$row['review_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    
    <script>
        function deleteConfirm(review_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "review_delete.php?review_id=" + review_id;
            }else{   //취소
                return;
            }
        }
    </script>
    
    <?
     mysqli_data_seek($res, 0);
     $row = mysqli_fetch_array($res); 
     echo "<a href='review_form.php?product_id={$row['product_id']}'><button class='button primary large'>작성</button></a>";
    ?>
</div>
<? include("footer.php") ?>