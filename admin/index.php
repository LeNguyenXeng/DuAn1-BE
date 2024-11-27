<?php
include "header.php";
include "../model/taikhoan.php";
include "../model/sanpham.php";
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
        case 'xoadm':
            include "danhmuc/delete_category.php";
            break;
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



            case 'addsp':
                //kiểm tra xen người dùng có click vào nút add hay không?
                if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $iddm = isset($_POST['iddm']) && $_POST['iddm'] > 0 ? intval($_POST['iddm']) :null;
                    $tensp = $_POST['tensp'] ?? '';
                    $giasp = is_numeric($_POST['giasp']) ? $_POST['giasp'] : 0;
                    $mota = $_POST['mota'] ?? '';
                    $hinh = !empty($_FILES['hinh']['name']) ? $_FILES['hinh']['name'] : null;
                
                    if ($iddm === null) {
                        echo "Vui lòng chọn danh mục hợp lệ.";
                        exit;
                    }
                
                    if (empty($tensp)) {
                        echo "Vui lòng nhập tên sản phẩm.";
                        exit;
                    }
                
                    if ($giasp <= 0) {
                        echo "Giá sản phẩm phải lớn hợp lệ.";
                        exit;
                    }
                
                    if ($hinh) {
                        $target_dir = "../upload/";
                        $target_file = $target_dir . basename($hinh);
                
                        if (!move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                            echo "Lỗi khi upload file.";
                        }
                    }
                   
                    insert_sanpham($tensp, $giasp, $hinh, $mota, $iddm);
                    $thongbao = "Thêm thành công";
                }
                $listsanpham = loadall_sanpham();
                $listdanhmuc = loadall_danhmuc();
                include "sanpham/addsp.php";
            case 'listsp':
                if (isset($_POST['listok']) && ($_POST['listok'])) {
                    $kyw = $_POST['kyw'];
                    $iddm = $_POST['iddm'];
                } else {
                    $kyw = "";
                    $iddm = 0;
    
                }
                $sql = "SELECT * from sanpham order by id desc";
                $listdanhmuc = loadall_danhmuc();
                $listsanpham = loadall_sanpham($kyw, $iddm);
                include "sanpham/list.php";
                break;
            case 'xoasp':
                try {
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        $id = $_GET['id'];
                        delete_sanpham($id);
                        $thongbao = "Xóa thành công";
                    }
                    // sau khi xóa thì hiện thị lại danh sách sản phẩm
                } catch (Exception $e) {
                    echo "Không thể xóa sản phẩm này";
                }
                $listsanpham = loadall_sanpham();
                include "sanpham/list.php";
                break;
            case 'suasp':
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $sp = loadone_sanpham($_GET['id']);
                }
                $listdanhmuc = loadall_danhmuc();
                include "sanpham/update.php";
                break;
            case 'updatesp':
               
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    
                   
                    $id=(int) $_POST['id'];
                    $iddm=(int) $_POST['iddm'];
                    $tensp= $_POST['tensp'];
                    $giasp=(float) $_POST['giasp'];
                    $mota= $_POST['mota'];
                    $hinhsp=$_FILES['hinh']['name'];
                    $target_dir = "../views/images/";
                    $target_file = $target_dir . basename($_FILES['hinh']['name']);
                    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
    
                    update_sanpham($id,$tensp,$giasp,$hinh,$mota,$iddm);
                    $thongbao= "Cập nhật thành công";
                  
                }
                $listdanhmuc =loadall_danhmuc();
                $listsanpham =loadall_sanpham("",0);
                include "sanpham/list.php";
                break;
                case 'adddm':
                    //kiểm tra xen người dùng có click vào nút add hay không?
                    if (isset($_POST['submit']) && ($_POST['submit'])) {
                        $tenloai = $_POST['tenloai'];
                        insert_danhmuc($tenloai);
                        $thongbao = "Thêm thành công";
                    }
                    include "danhmuc/adddm.php";
                    break;
                case 'listdm':
        
                    $sql = "SELECT * from danhmuc order by id desc";
                    $listdanhmuc = loadall_danhmuc();
                    include "danhmuc/listdm.php";
                    break;
                case 'xoadm':
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        delete_danhmuc($id);
                    }
                    $listdanhmuc = loadall_danhmuc();
                    include "danhmuc/lisdm.php";
                    break;
                case 'suadm':
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        $dm = loadone_danhmuc($_GET['id']);
                    }
        
                    include "danhmuc/update.php";
                    break;
                case 'updatedm':
                    if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                        $id = $_POST['id'];
                        $tenloai = $_POST['tenloai'];
                        update_danhmuc($id, $tenloai);
                        $thongbao = "Cập nhật thành công";
        
                    }
                    $listdanhmuc = loadall_danhmuc();
                    include "danhmuc/list.php";
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