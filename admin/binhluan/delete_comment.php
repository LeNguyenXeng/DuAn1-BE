<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID bình luận
$id_bl = $_GET['id'];

// Xóa bình luận
$sql = "DELETE FROM binh_luan WHERE id_bl = $id_bl";

if ($conn->query($sql) === TRUE) {
    echo "Bình luận đã được xóa.";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
header("Location: ../index.php?act=binhluan");
?>