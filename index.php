<?php
    session_start();
    include "model/taikhoan.php";
    include "model/pdo.php";

if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'product':
            include "view/product-detail.php";
            break;
        case 'shoppingcart':
            include "view/shoppingcart.php";
            break;
        case 'about':
            include "view/about.php";
            break;
        case 'contact':
            include "view/contact.php";
            break;
        case 'login':
            if(isset($_POST['dangnhap'])&&($_POST['dangnhap'])){
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $checkuser = checkuser($email,$pass);
                if(is_array($checkuser)){
                    $_SESSION['user'] = $checkuser;
                    $_SESSION['role'] = $checkuser['role'];
                    header('location: index.php');  
                }
                else{
                    $thongbao = "Tài khoản không tồn tại";  
                    
                }
            }

            include "view/login.php";
            break;
        case 'register':
            if(isset($_POST['dangky'])&&($_POST['dangky'])){
                $email = $_POST['email'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $tel = $_POST['tel'];
                insert_taikhoan($user,$tel,$email,$pass);
                $thongbao = "Đã Đăng Ký Thành Công. Vui Lòng Đăng Nhập";
                header("location: index.php?act=login");
            }
            include "view/register.php";
            break;
        case 'edit_taikhoan':
            if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                $user = $_POST['user'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $tel = $_POST['tel'];
                $address = $_POST['address'];
                $id = $_POST['id'];
                update_taikhoan($id,$user,$pass,$email,$address,$tel);
                $_SESSION['user'] = checkuser($email,$pass);
                header('location: index.php?act=login');  
                }
                include "view/taikhoan/edit_taikhoan.php";
                break;

        case 'quenmk':
            if(isset($_POST['quenmk'])&&($_POST['quenmk'])){
                $email = $_POST['email'];
                $checkemail = checkemail($email);
                if(is_array($checkemail)){
                    $thongbao = "Mật khẩu của bạn là: ".$checkemail['pass'];
                }
                else{
                    $thongbao = "Email này không tồn tại";
                }
                }
            include "view/taikhoan/quenmk.php";
            break;
        case 'shop':
            include "view/shop.php";
            break;
        case 'logout':
            session_unset();
            header('location: index.php');
            break;
        default:
            include "view/home.php";
            break;
    }
}
else{
    include "view/home.php";
}


?>