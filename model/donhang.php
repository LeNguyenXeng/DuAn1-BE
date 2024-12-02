<?php
function taodonhang($madonhang, $tongdonhang, $user, $ptthanhtoan, $name, $diachi, $email, $dienthoai) {
    // Câu SQL
    $sql = "INSERT INTO donhang (madonhang, tongdonhang, user, ptthanhtoan, name, diachi, email, dienthoai)
            VALUES (:madonhang, :tongdonhang, :user, :ptthanhtoan, :name, :diachi, :email, :dienthoai)";

    // Mảng tham số với các khóa đúng tên tham số trong câu SQL
    $params = [
        ':madonhang' => $madonhang,
        ':tongdonhang' => $tongdonhang,
        ':user' => $user,
        ':ptthanhtoan' => $ptthanhtoan,
        ':name' => $name,
        ':diachi' => $diachi,
        ':email' => $email,
        ':dienthoai' => $dienthoai
    ];

    // Truyền câu SQL và mảng tham số vào hàm pdo_execute1
    pdo_execute1($sql, $params);
}
function addtocart($iddonhang, $id, $tensp, $img, $dongia, $sl){
    $conn = connectdb();
    $sql = "INSERT INTO gio_hang (iddonhang, idpro, tensp, img, dongia, soluong)
            VALUES ('".$iddonhang."','".$id."','".$tensp."','".$img."','".$dongia."','".$sl."')";
    $conn->exec($sql);
}
function getshowcart($iddonhang) {
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM gio_hang WHERE iddonhang=".$iddonhang);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}


function getinfo($iddonhang) {
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM donhang WHERE iddonhang=".$iddonhang);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}



?>