<?php
header("Access-Control-Allow-Origin:*");
header('Content-Type: application/json');
require_once ("../../front/connectDataBase.php");

try {
    // 修改：檢查是否有上傳新圖片
    if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] == 0) {
        $uploadDir = '../../../img/';
        $uploadFile = $uploadDir . basename($_FILES['course_image']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // 檢查文件是否為實際圖像
        $check = getimagesize($_FILES["course_image"]["tmp_name"]);
        if ($check === false) {
            throw new Exception("文件不是圖像。");
        }

        // 檢查文件大小
        if ($_FILES["course_image"]["size"] > 800000) {
            throw new Exception("抱歉，您的文件太大。");
        }

        // 允許特定的文件格式
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            throw new Exception("抱歉，只允許 JPG, JPEG, PNG 文件。");
        }

        if (move_uploaded_file($_FILES["course_image"]["tmp_name"], $uploadFile)) {
            $imagePath = basename($_FILES['course_image']['name']);
        } else {
            throw new Exception("抱歉，上傳文件時出錯。");
        }
    } else {
        // 如果沒有上傳新圖片，保留原有圖片路徑
        $stmt = $pdo->prepare("SELECT course_image FROM course WHERE course_id = :id");
        $stmt->execute([':id' => $_POST['course_id']]);
        $imagePath = $stmt->fetchColumn();
    }

    $sql = "UPDATE course SET 
            course_name = :name, 
            course_teacher = :teacher, 
            course_startTime = :startTime, 
            course_endTime = :endTime, 
            course_room = :room, 
            course_price = :price, 
            course_discount = :discount, 
            course_status = :status, 
            course_ribbon = :ribbon, 
            course_image = :image, 
            course_desc = :desc, 
            course_intro = :intro, 
            course_content = :content 
            WHERE course_id = :id";

    $stmt = $pdo->prepare($sql);
    $params = [
        ':name' => $_POST['course_name'],
        ':teacher' => $_POST['course_teacher'],
        ':startTime' => $_POST['course_startTime'],
        ':endTime' => $_POST['course_endTime'],
        ':room' => $_POST['course_room'],
        ':price' => $_POST['course_price'],
        ':discount' => $_POST['course_discount'],
        ':status' => $_POST['course_status'],
        ':ribbon' => $_POST['course_ribbon'],
        ':image' => $imagePath,
        ':desc' => $_POST['course_desc'],
        ':intro' => $_POST['course_intro'],
        ':content' => $_POST['course_content'],
        ':id' => $_POST['course_id']
    ];

    $result = $stmt->execute($params);

    if ($result) {
        echo json_encode(['success' => true, 'message' => '課程更新成功']);
    } else {
        echo json_encode(['success' => false, 'message' => '課程更新失敗']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>