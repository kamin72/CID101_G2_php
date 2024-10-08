<?php

try {
    //連線mysql
    require_once ("../connectDataBase.php");

    $memId = $_GET['memId'];

    //準備sql指令
    $sql = "select * from member_retailer mr JOIN member m on mr.no = m.no where m.no = $memId";

    //編譯sql指令(若上述資料有未知數)
    //代入資料
    //執行sql指令
    $member = $pdo->query($sql);

    //執行

    //如果找到資料，取回資料，送出JSON
    if ($member->rowCount() > 0) {
        $memberRow = $member->fetchAll(PDO::FETCH_ASSOC);
        $result = ['error' => false, 'msg' => '', 'member' => $memberRow];
        echo json_encode($result);
    } else {
        $result = ['error' => true, 'msg' => '查無會員帳號或密碼錯誤，請重新輸入', 'member' => []];
        echo json_encode($result);
    }
} catch (PDOException $e) {
    $msg = '錯誤原因:' . $e->getMessage() . "," . "錯誤行號:" . $e->getLine() . "," . "錯誤文件:" . $e->getFile();
    // echo "系統暫時不能正常運行，請稍後再試<br>";
    $result = ['error' => true, 'msg' => $msg];
    echo json_encode($result, JSON_NUMERIC_CHECK);
}
?>