<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from product natural join type where category_id = 1";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where product_name like '%$search_keyword%' or main_ingredient like '%$search_keyword%' or product_brand like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>번호</th>
            <th>유형</th>
            <th>상품명</th>
            <th>주요성분</th>
            <th>가격</th>
            <th>브랜드</th>
            <th>리뷰</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['type_name']}</td>";
            echo "<td>{$row['product_name']}</td>";
            echo "<td>{$row['main_ingredient']}</td>";
            echo "<td>{$row['product_price']}</td>";
            echo "<td>{$row['product_brand']}</td>";
            echo "<td><a href='review_list.php?product_id={$row['product_id']}'><button class='button primary small'>리뷰</button></a></td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
