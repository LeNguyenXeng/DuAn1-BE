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
$sql = "DELETE FROM danh_muc WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: listdm.php");
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
