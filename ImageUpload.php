<?php
class ImageUpload {
    private $targetDir;

    public function __construct($targetDir) {
        $this->targetDir = $targetDir;
    }

    public function getFileName($file) {
        return basename($file["name"]);
    }

    public function moveFile($file, $newFileName) {
        $targetPath = $this->targetDir . "/" . $newFileName;
        return move_uploaded_file($file["tmp_name"], $targetPath);
    }

    public function checkFile($file) {
 
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $fileSizeLimit = 10 * 1024 * 1024; 

        if (!in_array($fileExtension, $allowedFormats)) {
            return "File không hợp lệ. Chỉ được phép tải lên các file hình ảnh (jpg, jpeg, png, gif).";
        }

        if ($file["size"] > $fileSizeLimit) {
            return "Kích thước file vượt quá giới hạn. Vui lòng tải lên file nhỏ hơn 10MB.";
        }

        return ""; 
    }
}
?>
