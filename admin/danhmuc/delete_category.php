<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM danhmuc WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Danh mục đã được xóa";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
header("Location: ../index.php?act=listdm");
?>
