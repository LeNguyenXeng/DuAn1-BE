<?php
// Kết nối database
$conn = new mysqli('localhost', 'root', '', 'duan1');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Lấy dữ liệu từ Fetch API
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$email = $data['email'];
$review = $data['review'];

// Kiểm tra dữ liệu
if (!empty($name) && !empty($email) && !empty($review)) {
    // Thêm bình luận vào database
    $stmt = $conn->prepare('INSERT INTO binh_luan (ten, email, noidung) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $name, $email, $review);

    if ($stmt->execute()) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }

    $stmt->close();
} else {
    http_response_code(400); // Lỗi dữ liệu
}

$conn->close();
?>
