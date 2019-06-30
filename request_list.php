<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from request_board natural join type";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>번호</th>
            <th>요청제품유형</th>
            <th>요청제품명</th>
            <th>브랜드</th>
            <th>가격</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['type_name']}</td>";
            echo "<td>{$row['request_name']}</td>";
            echo "<td>{$row['request_brand']}</td>";
            echo "<td>{$row['request_price']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
