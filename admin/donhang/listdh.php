<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT donhang1.id_dh, khachhang.hoten AS customer_name, donhang1.ngaydat, donhang1.tongtien, donhang1.trangthai 
        FROM donhang1
        JOIN khachhang ON donhang1.id_khachhang = khachhang.id_khachhang
        ORDER BY donhang1.id_dh DESC";
$result = $conn->query($sql);

if (isset($_GET['huydh_id'])) {
    $huydh_id = intval($_GET['huydh_id']);
    $update_sql = "UPDATE donhang1 SET trangthai = 4 WHERE id_dh = $huydh_id";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: listdh.php");
        exit;
    } else {
        echo "<script>alert('Có lỗi xảy ra khi hủy đơn hàng.');</script>";
    }
}

if (isset($_GET['duyetdh_id'])) {
    $duyetdh_id = intval($_GET['duyetdh_id']);

    $get_trangthai_sql = "SELECT trangthai FROM donhang1 WHERE id_dh = $duyetdh_id";
    $result_trangthai = $conn->query($get_trangthai_sql);

    if ($result_trangthai->num_rows > 0) {
        $row = $result_trangthai->fetch_assoc();
        $current_trangthai = $row['trangthai'];

        if ($current_trangthai == 0) {
            $update_sql = "UPDATE donhang1 SET trangthai = 1 WHERE id_dh = $duyetdh_id";
        } elseif ($current_trangthai == 1) {
            $update_sql = "UPDATE donhang1 SET trangthai = 2 WHERE id_dh = $duyetdh_id";
        } else {
            echo "<script>alert('Không thể duyệt đơn hàng vì trạng thái không hợp lệ.');</script>";
            header("Location: listdh.php");
            exit;
        }

        if ($conn->query($update_sql) === TRUE) {
            header("Location: listdh.php");
            exit; 
        } else {
            echo "<script>alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.');</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy đơn hàng.');</script>";
    }
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin-top: 60px;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 0 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        table-layout: fixed;
        margin: 40px auto;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }

    td a {
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
    }

    td a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quản lý đơn hàng</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_dh'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['ngaydat'] ?></td>
                        <td><?= number_format($row['tongtien'], 2) ?> VND</td>
                        <td>
                            <?php 
                            switch ($row['trangthai']) {
                                case '0': echo "Đơn hàng mới"; break;
                                case '1': echo "Đang xử lý"; break;
                                case '2': echo "Đang vận chuyển"; break;
                                case '3': echo "Đã giao"; break;
                                case '4': echo "Đã hủy"; break;
                                default: echo "Không xác định"; break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($row['trangthai'] == '0'): ?> 
                                <a href="?duyetdh_id=<?= $row['id_dh'] ?>">Duyệt đơn</a> | 
                            <?php elseif ($row['trangthai'] == '1'): ?>
                                <a href="?duyetdh_id=<?= $row['id_dh'] ?>">Vận chuyển</a> | 
                            <?php endif; ?>
                            <?php if ($row['trangthai'] != '4'): ?>
                                <a href="?huydh_id=<?= $row['id_dh'] ?>">Hủy đơn</a>
                            <?php else: ?>
                                Đã hủy
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Không có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
