<?php
ob_start();
session_start();
include "header.php";
include "../model/taikhoan.php";
include "../model/sanpham.php";
include "../model/danhmuc.php";
include "../model/pdo.php";
if(!isset($_SESSION['user'])){
    header('location: login.php');
    exit();
}
$userRole = $_SESSION['role'];
if($userRole !== 1){
    header('location: login.php');
    exit();
}


if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'home':
            include "home.php";
        break;
        case 'logout':
            session_unset();
            header('location: ../index.php');
            break;
        case 'listdm':
            include "danhmuc/listdm.php";
        break;
        case 'xoadm':
            include "danhmuc/delete_category.php";
            break;
        case 'suadm':
            include "danhmuc/edit_category.php";
        break;
        case 'add_category':
            if(isset($_POST['themdm'])&&($_POST['themdm'])){
                $name = $_POST['name'];
                header('location:index.php?act=listdm');
            }
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
                $user = $_POST['user'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $role = $_POST['role'];
                $id = $_POST['id'];
                $sql = "UPDATE taikhoan set user='".$user."', email='".$email."', pass='".$pass."', address='".$address."', tel='".$tel."', role='".$role."' where id=".$id;
                pdo_execute($sql);
                $thongbao = "Cập nhật thành công";
            }
            $sql = "SELECT * FROM taikhoan order by id desc";
            $listtaikhoan = pdo_query($sql);
            include "taikhoan/list.php";
            break;
            
            case 'addsp':
                if(isset($_POST['themmoi'])&&($_POST['themmoi'])){
                    $iddm = $_POST['iddm'];
                    $tensp = $_POST['tensp'];
                    $giasp = $_POST['giasp'];
                    $mota = $_POST['mota'];
                    $hinh = $_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                        // echo "The file ". htmlspecialchars( basename( $_FILES["hinh"]["name"])). " has been uploaded.";
                      } else {
                        // echo "Sorry, there was an error uploading your file.";
                      }
                      insert_sanpham($tensp,$giasp,$hinh,$mota,$iddm);
                        header('location:index.php?act=listsp');
                }
                $listdanhmuc = loadall_danhmuc();
                include "sanpham/addsp.php";
                break;

            case 'listsp':
                if(isset($_POST['listok'])&&($_POST['listok'])){
                    $kyw = $_POST['kyw'];
                    $iddm = $_POST['iddm'];
                }
                else{
                    $kyw = '';
                    $iddm = 0;
                }
                $listdanhmuc = loadall_danhmuc();
                $listsanpham = loadall_sanpham($kyw, $iddm);
                include "sanpham/list.php";
                break;
            case 'xoasp':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    delete_sanpham($_GET['id']);
                }
                $listsanpham = loadall_sanpham("",0);
                include "sanpham/list.php";
                break;
                case 'suasp':
                    if(isset($_GET['id'])&&($_GET['id']>0)){
                        $sanpham =  loadone_sanpham($_GET['id']);
                    }
                    include "sanpham/update.php";
                    break;
                case 'updatesp':
                    if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                        $id = $_POST['id'];
                        $tensp = $_POST['tensp'];
                        $giasp = $_POST['giasp'];
                        $mota = $_POST['mota'];
                        $hinh = $_FILES['hinh']['name'];
                        $target_dir = "../upload/";
                        $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
                            // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been upload.";
                        } else {
                            // echo "Sorry, there was an error uploading ypur file.";
                        }
                        update_sanpham($id,$tensp,$giasp,$mota,$hinh);
                        header("location: index.php?act=listsp");
        
                        $thongbao = "Cập nhật thất bại!";
                    }
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
                    // case cmt
                    case 'binhluan':
                        // $listcmt = loadall_cmt();
                        include "binhluan/list.php";
                        break;
                    case 'xoabl':
                        include "binhluan/delete_comment.php";
                        break;
                        case 'listdh':
                            include "donhang/listdh.php";
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