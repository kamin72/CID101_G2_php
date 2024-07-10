<?php
try {
    //連線mysql
    require_once ("../../front/connectDataBase.php");

    //準備sql指令
    $sql = "select * from discount_type";

    //編譯sql指令(若上述資料有未知數)
    //代入資料
    //執行sql指令
    $discount = $pdo->query($sql);

    //執行

    //如果找到資料，取回資料，送出JSON
    if ($discount->rowCount() > 0) {
        $discountRow = $discount->fetchAll(PDO::FETCH_ASSOC);
        $result = ['error' => false, 'msg' => '', 'discount' => $discountRow];
        echo json_encode($result, JSON_NUMERIC_CHECK);
    } else {
        $result = ['error' => true, 'msg' => '無資料', 'discount' => []];
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }
} catch (PDOException $e) {
    $msg = '錯誤原因:' . $e->getMessage() . "," . "錯誤行號:" . $e->getLine() . "," . "錯誤文件:" . $e->getFile();
    // echo "系統暫時不能正常運行，請稍後再試<br>";
    $result = ['error' => true, 'msg' => $msg];
    echo json_encode($result, JSON_NUMERIC_CHECK);
}
?>