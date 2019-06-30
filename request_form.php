<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "요청";
$action = "request_insert.php";

$type = array();

$query = "select * from type";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $type[$row['type_id']] = $row['type_name'];
}
?>
    <div class="container">
        <form name="request_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="type_id" value="<?=$request_board['request_id']?>"/>
            <h3>제품 <?=$mode?></h3>
            <p>
                <label for="type_id">제품 유형</label>
                <select name="type_id" id="type_id">
                    <option value="-1">제품 유형을 선택해 주세요.</option>
                    <?
                        foreach($type as $id => $name) {
                            if($id == $request_board['type_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="request_name">제품명</label>
                <input type="text" placeholder="제품명 입력" id="request_name" name="request_name" value="<?=$request_board['request_name']?>"/>
            </p>
            <p>
                <label for="request_brand">브랜드명</label>
                <textarea placeholder="브랜드명 입력" id="request_brand" name="request_brand"><?=$request_board['request_brand']?></textarea>
            </p>
            <p>
                <label for="request_price">가격</label>
                <input type="number" placeholder="정수로 입력해주시되, 정확히 입력하지 않으셔도 괜찮습니다." id="request_price" name="request_price" value="<?=$request_board['request_price']?>" />
            </p>

            <p align="center">
            	<button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button>
            	<button class="button primary large"><a href='request_list.php'>목록</a></button>	
            </p>

            <script>
                function validate() {
                    if(document.getElementById("type_id").value == "-1") {
                        alert ("제품 유형을 선택해 주세요."); return false;
                    }
                    else if(document.getElementById("request_name").value == "") {
                        alert ("요청하시는 제품명을 입력해 주세요."); return false;
                    }
                    else if(document.getElementById("request_brand").value == "") {
                        alert ("브랜드명을 입력해 주세요."); return false;
                    }
                    else if(document.getElementById("request_price").value == "") {
                        alert ("가격을 입력해 주세요."); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>