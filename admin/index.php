<?php
include "header.php";
include "../model/taikhoan.php";
include "../model/pdo.php";

if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'home':
            include "home.php";
        break;
        case 'listdm':
            include "danhmuc/listdm.php";
        break;
        case 'add_category':
            include "danhmuc/add_category.php";
        break;
        case 'listtaikhoan':
            $listtaikhoan = loadall_taikhoan();
            include "taikhoan/list.php";
            break;
        case 'xoatk':
            if(isset($_GET['id'])&&($_GET['id']>0)){
                delete_taikhoan($_GET['id']);
            }
        $listtaikhoan = loadall_taikhoan();
        include "taikhoan/list.php";
        break;
        
        case 'suatk':
            if(isset($_GET['id'])&&($_GET['id']>0)){
                $sql = "select * from taikhoan where id=".$_GET['id'];
                $tk = pdo_query_one($sql);
            }
        include "taikhoan/update.php";
        break;

        case 'updatetk':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_GET['id'];
                $user = $_POST['user'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $role = $_POST['role'];
                $sql = "UPDATE taikhoan SET user='$user' WHERE id=" . $id;
                pdo_execute($sql);
                $thongbao = "Cập nhật thành công";
            }
        
            $sql = "SELECT * FROM taikhoan WHERE id=" . $_GET['id'];
            $tk = pdo_query_one($sql);
            include "taikhoan/list.php";
            break;
        
        default:
            include "home.php";
            break;
    }
}
else{
    include "home.php";
}

?>