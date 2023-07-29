<?php
require_once 'ImageUpload.php';

// Thư mục lưu trữ hình ảnh đã tải lên
$targetDir = "images"; 
$imageUpload = new ImageUpload($targetDir);

if (isset($_POST["submit"])) {
    $file = $_FILES["image"];

    // Kiểm tra file trước khi tải lên
    $error = $imageUpload->checkFile($file);
    if ($error !== "") {
        echo $error;
    } else {
        $newFileName = $imageUpload->getFileName($file);

        // Di chuyển file vào thư mục lưu trữ
        if ($imageUpload->moveFile($file, $newFileName)) {
            echo "Tải lên thành công.";
        } else {
            echo "Không thể tải lên file.";
        }
    }
}

// Hiển thị các hình ảnh đã tải lên
$uploadedFiles = array_diff(scandir($targetDir), array('..', '.'));
if (!empty($uploadedFiles)) {
    echo "<h2>Hình ảnh đã tải lên:</h2>";
    echo "<div id='uploaded-image'>";
    foreach ($uploadedFiles as $file) {
        echo "<img src='$targetDir/$file' alt='Hình ảnh'>";
    }
    echo "</div>";
}
?>