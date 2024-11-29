<?php
    // include "header.php";

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

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Bình Luận<nav></nav>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Danh Sách Bình Luận</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bảng Danh Sách
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Trạng thái</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                           <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_bl'] ?></td>
                    <td><?= $row['ten_khachhang'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['ten_sp'] ?></td>
                    <td><?= $row['noidung'] ?></td>
                    <td>
                        <a href="binhluan/delete_comment.php?id=<?= $row['id_bl'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Không có bình luận nào.</td>
            </tr>
        <?php endif; ?>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
