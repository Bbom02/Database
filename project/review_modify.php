<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$product_id = $_POST['product_id'];
$review_id = $_POST['review_id'];
$review_name = $_POST['review_name'];
$knowhow = $_POST['knowhow'];
$recommendation = $_POST['recommendation'];

mysqli_query($conn, "set autocommit = 0"); // remove autocommit
mysqli_query($conn, "set transaction isolation level serializable"); // set isolation level 
mysqli_query($conn, "begin"); // begin transaction

$query = "select review_id from review where review_id = '$review_id'";
$res = mysqli_query($conn, $query);

if(!$res) {
	msg ('Query Error : '.mysqli_error($conn));
}

$row = mysqli_fetch_array($res);

if($row['review_id']!=$review_id) {
	mysqli_query($conn, "rollback"); // rollback
	msg ('Query Error : '.mysqli_error($conn));
} // echo unequal
else {
} // echo equal

$ret = mysqli_query($conn, "update review set review_name = \"$review_name\", knowhow = \"$knowhow\", recommendation = \"$recommendation\" where review_id = \"$review_id\"");

if(!$ret) {
    mysqli_error($conn, "rollback"); // rollback
    msg('Query Error : '.mysqli_error($conn));
}
else {
    mysqli_query($conn, "commit"); // commit
    s_msg ('성공적으로 수정 되었습니다. 수정된 리뷰를 확인해보세요!');
    echo "<meta http-equiv='refresh' content='0;url=review_detail.php?review_id=\"$review_id\"'>";
}

?>