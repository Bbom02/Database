<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$review_id = $_GET['review_id'];

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

$ret = mysqli_query($conn, "delete from review where review_id = \"$review_id\"");

if(!$ret) {
	mysqli_error($conn, "rollback"); // rollback
    msg('Query Error : '.mysqli_error($conn));
}
else {
	mysqli_query($conn, "commit"); // commit
    s_msg ('성공적으로 삭제 되었습니다. 메인화면으로 이동합니다');
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}

?>

