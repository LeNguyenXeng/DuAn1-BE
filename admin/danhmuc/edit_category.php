<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID không hợp lệ");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];

        $stmt = $conn->prepare("UPDATE danh_muc SET name=? WHERE id=?");
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            header("Location: listdm.php");
            exit(); 
        } else {
            echo "Lỗi: " . $stmt->error;
        }
    } else {
        echo "Tên danh mục không được để trống!";
    }
}

$sql = "SELECT * FROM danh_muc WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục</title>
</head>
<body>
    <h1>Sửa danh mục</h1>
    <form method="POST">
        <label for="name">Tên danh mục:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br><br>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
