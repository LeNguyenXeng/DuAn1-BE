<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";
try {
    // Kết nối cơ sở dữ liệu bằng PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Lấy idsp từ URL, nếu không có thì đặt giá trị mặc định là 0
    $idpro = isset($_GET['idsp']) ? intval($_GET['idsp']) : 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ten = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $noidung = isset($_POST['review']) ? trim($_POST['review']) : '';
        $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 5;
        $ngaybl = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
        if (!empty($ten) && !empty($noidung) && $rating >= 1 && $rating <= 5) {
            $insertQuery = "INSERT INTO binhluan (idpro, ten, email, noidung, rating, ngaybl) 
                            VALUES (:idpro, :ten, :email, :noidung, :rating, :ngaybl)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->bindParam(':idpro', $idpro, PDO::PARAM_INT);
            $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
            $stmt->bindParam(':ngaybl', $ngaybl, PDO::PARAM_STR);
            $stmt->execute();

            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSuccessPopup('Bình luận của bạn đã được thêm thành công!');
                });
            </script>";
        } else {
            echo "<p class='text-danger'>Vui lòng nhập đầy đủ thông tin và chọn đánh giá hợp lệ!</p>";
        }
    }
    // Truy vấn danh sách bình luận theo idpro
    $query = "SELECT ten, ngaybl, noidung, rating FROM binhluan WHERE idpro = :idpro ORDER BY ngaybl DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idpro', $idpro, PDO::PARAM_INT);
    $stmt->execute();

    $binhluan = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả dữ liệu bình luận
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    $binhluan = []; // Nếu lỗi, đặt mảng bình luận trống
}

?>