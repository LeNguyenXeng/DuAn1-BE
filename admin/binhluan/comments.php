<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ bảng `binh_luan`
$sql = "SELECT 
            binh_luan.id_bl, 
            binh_luan.noidung, 
            binh_luan.ten AS ten_khachhang, 
            binh_luan.email, 
            san_pham.ten_sp 
        FROM binh_luan 
        JOIN san_pham ON binh_luan.id_sp = san_pham.id_sp
        ORDER BY binh_luan.id_bl DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bình luận</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Quản lý bình luận</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Sản phẩm</th>
            <th>Nội dung</th>
            <th>Hành động</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_bl'] ?></td>
                    <td><?= $row['ten_khachhang'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['ten_sp'] ?></td>
                    <td><?= $row['noidung'] ?></td>
                    <td>
                        <a href="delete_comment.php?id=<?= $row['id_bl'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Không có bình luận nào.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
