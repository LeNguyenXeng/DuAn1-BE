<?php
// pdo.php


function taodonhang($madonhang, $tongdonhang, $user, $ptthanhtoan, $name, $diachi, $email, $dienthoai) {
    global $pdo;
    $sql = "INSERT INTO donhang (madonhang, tongdonhang, user, ptthanhtoan, name, diachi, email, dienthoai)
            VALUES (:madonhang, :tongdonhang, :user, :ptthanhtoan, :name, :diachi, :email, :dienthoai)";
    pdo_execute1($sql, [
        ':madonhang' => $madonhang,
        ':tongdonhang' => $tongdonhang,
        ':user' => $user,
        ':ptthanhtoan' => $ptthanhtoan,
        ':name' => $name,
        ':diachi' => $diachi,
        ':email' => $email,
        ':dienthoai' => $dienthoai
    ]);

    // Lấy ID đơn hàng vừa tạo
    // $iddonhang = $pdo->lastInsertId();
    // return $iddonhang;
}





?>