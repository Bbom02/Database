<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$request_name = $_POST['request_name'];
$request_brand = $_POST['request_brand'];
$type_id = $_POST['type_id'];
$request_price = $_POST['request_price'];

mysqli_query($conn, "set autocommit = 0"); // remove autocommit
mysqli_query($conn, "set transaction isolation level serializable"); // set isolation level 
mysqli_query($conn, "begin"); // begin transaction

$query = "select type_id from type where type_id = '$type_id'";
$res = mysqli_query($conn, $query);

if(!$res) {
	msg ('Query Error : '.mysqli_error($conn));
}

$row = mysqli_fetch_array($res);

if($row['type_id']!=$type_id) {
	mysqli_query($conn, "rollback"); // rollback
	msg ('Query Error : '.mysqli_error($conn));
} // echo unequal
else {
} // echo equal

$ret = mysqli_query($conn, "insert into request_board set type_id = \"$type_id\", request_name = \"$request_name\", request_brand = \"$request_brand\", request_price = \"$request_price\"");

if(!$ret) {
	mysqli_error($conn, "rollback"); // rollback
	msg ('Query Error : '.mysqli_error($conn));
}
else {
	mysqli_query($conn, "commit"); // commit
	s_msg ('성공적으로 입력 되었습니다');
	echo "<meta http-equiv='refresh' content='0;url=request_list.php'>";
}