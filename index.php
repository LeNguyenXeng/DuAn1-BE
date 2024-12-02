<?php
 session_start();
 if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
 if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = (int)$_SESSION['user']; // Lấy ID người dùng từ session
} else {
    // Nếu không có ID người dùng trong session, gán $user = 0
    $user = 0;
}
    include "model/taikhoan.php";
    include "model/sanpham.php";
    include "model/donhang.php";
    include "model/pdo.php";
    include "global.php";
//   include "view/donhang.php";

$spnew = loadall_sanpham_home();

if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'product':
            if(isset($_GET['idsp'])&&($_GET['idsp'])>0){
                $id = $_GET['idsp'];
                $onesp = loadone_sanpham($id);
                include "view/product-detail.php";
            }
            else{
                include "view/home.php";   
            }

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
                    if (isset($_GET['i']) && is_numeric($_GET['i'])) {
                        $i = intval($_GET['i']); // Đảm bảo chỉ số là số nguyên
                        if (isset($_SESSION['giohang'][$i])) {
                            // Chỉ xóa sản phẩm tại vị trí $i
                            array_splice($_SESSION['giohang'], $i, 1);
                        }
                    } else {
                        // Nếu không truyền chỉ số, xóa toàn bộ giỏ hàng
                        if (isset($_SESSION['giohang'])) {
                            unset($_SESSION['giohang']);
                        }
                    }
                
                    // Điều hướng về trang giỏ hàng
                    if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                        header('location: index.php?act=shoppingcart');
                    } else {
                        header('location: index.php');
                    }
                    break;
                case 'xoagiohang':
                   
                    header('location: index.php?act=home');
                    break;
                case 'thanhtoan':
                        if (isset($_POST['thanhtoan']) && $_POST['thanhtoan']) {
                            // Lấy dữ liệu từ form
                            $tongdonhang = $_POST['tongdonhang'];
                            $name = $_POST['name'];
                            $diachi = $_POST['diachi'];
                            $email = $_POST['email'];
                            $dienthoai = $_POST['dienthoai'];
                            $ptthanhtoan = $_POST['ptthanhtoan'];
                            
                            // Kiểm tra nếu biến $_POST['user'] có tồn tại và có giá trị hợp lệ
                            $user = isset($_POST['user']) && !empty($_POST['user']) ? (int)$_POST['user'] : 0;// Gán giá trị mặc định là 0 nếu trống
                        
                            // Chuyển $tongdonhang thành số thực (float)
                            $tongdonhang = (float)$tongdonhang;
                        
                            // Tạo mã đơn hàng
                            $madonhang = "SWE" . rand(0, 999999);
                        
                            // Tạo đơn hàng và lấy ID đơn hàng
                            $iddonhang = taodonhang($madonhang, $tongdonhang, $user, $ptthanhtoan, $name, $diachi, $email, $dienthoai);
                           
                    }
                        
                        include "view/donhang.php";
                        break;
            case 'thanhtoandonhang':
                include "view/thanhtoan.php";
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