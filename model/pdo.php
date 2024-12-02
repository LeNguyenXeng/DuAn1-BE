<?php
function pdo_get_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=duan1", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
function pdo_execute($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
       
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

function pdo_execute1($sql)
{
    // Lấy tất cả tham số sau tham số đầu tiên
    $sql_args = array_slice(func_get_args(), 1);

    try {
        // Kiểm tra xem tham số có phải là mảng không
        if (count($sql_args) > 0 && is_array($sql_args[0])) {
            $sql_args = $sql_args[0];  // Đảm bảo chỉ dùng mảng tham số
        }

        // Kết nối cơ sở dữ liệu
        $conn = pdo_get_connection();

        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);

        // Thực thi câu lệnh với mảng tham số
        $stmt->execute($sql_args); // Thực thi câu lệnh SQL với mảng tham số
    } catch (PDOException $e) {
        echo "Lỗi SQL: " . $e->getMessage(); // In lỗi SQL ra màn hình
        die(); // Dừng chương trình khi có lỗi
    } finally {
        unset($conn);
    }
}


// truy vấn nhiều dữ liệu
function pdo_query($sql)
{
    $sql_args = array_slice(func_get_args(), 1);

    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows = $stmt->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
// truy vấn  1 dữ liệu
function pdo_query_one($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // đọc và hiển thị giá trị trong danh sách trả về
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
pdo_get_connection();