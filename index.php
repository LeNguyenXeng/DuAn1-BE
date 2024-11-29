<?php
    session_start();
    if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
    include "model/taikhoan.php";
    include "model/sanpham.php";
    include "model/pdo.php";
    include "global.php";
    // include "view/shopp";

$spnew = loadall_sanpham_home();

if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'product':
            if (isset($_GET['id'])&&($_GET['id']>0)){
                $id = $_GET['id'];
               $kq = loadone_sanpham($id);
            }
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
            case 'addcart':
                if(isset($_POST['addtocart']) && $_POST['addtocart']) {
                    $id = $_POST['id'];  // Cần lấy ID sản phẩm từ form, thay vì dùng $id không xác định
                    $tensp = $_POST['tensp'];
                    $hinh = $_POST['hinh'];
                    $price = $_POST['price'];
                    if(isset($_POST['sl'])&&($_POST['sl'] >0)){ 
                        $sl = $_POST['sl'];
                    }else{
                        $sl = 1;
                    }
                    
                    $fg = 0;
                    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
                    $i=0;
                   foreach ($_SESSION['giohang'] as $item) {
                        if ($item[1] === $tensp) {
                            $slnew = $sl + $item[4];
                            $_SESSION['giohang'][$i][4] = $slnew; // Vấn đề: sai chỉ mục (4 không đúng)
                            $fg = 1;
                            break;
                        }
                        $i++;
                    }

           
                    // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ
                     if ($fg == 0) {
                        $item = array($id, $tensp, $hinh, $price, $sl);
                        $_SESSION['giohang'][] = $item;  // Thêm sản phẩm mới vào giỏ
                     }
           
                    header('location: index.php?act=shoppingcart');
                }
                include "view/shoppingcart.php";
                break;
           
        case 'delcart':
            if(isset($_SESSION['giohang']))unset($_SESSION['giohang']);
            header('location: index.php?act=shoppingcart');
            break;
        case 'xoagiohang':
           
            header('location: index.php?act=home');
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