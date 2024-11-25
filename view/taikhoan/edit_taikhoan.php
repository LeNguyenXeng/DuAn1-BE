<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cập Nhật Tài Khoản</title>
    <?php
    include "view/header.php";
?>
    <!-- breadcrumb -->
    <hr style="margin-top: 84px;">

    <div class="container" style="margin-top: -15px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php?act=home" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Cập Nhật Tài Khoản
            </span>
        </div>
    </div>


    <div class="login-page">
        <h2 class="textdangnhap text-center text-uppercase">Cập Nhật Tài Khoản</h2>

        <?php
            if(isset($_SESSION['user'])&&(is_array($_SESSION['user']))){
                extract($_SESSION['user']);
                
            };
        ?>

        <form method="POST" action="index.php?act=edit_taikhoan">
            <div class="mb-3">
                <label style="margin-top: 15px" for="exampleInputEmail1" class="tkmk form-label">Họ tên<nav></nav>
                </label>
                <input name="user" type="text" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Họ tên" required value="<?php echo $user ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="tkmk form-label">Số điện thoại</label>
                <input name="tel" type="number" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Số điện thoại" required value="<?php echo $tel ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="tkmk form-label">Địa Chỉ</label>
                <input name="address" type="text" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Địa Chỉ" required value="<?php echo $address ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="tkmk form-label">Email</label>
                <input name="email" type="email" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Email" required value="<?php echo $email ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="tkmk form-label">Mật khẩu</label>
                <input name="pass" type="password" class="inputform form-control" id="myInput" placeholder=" Mật khẩu"
                    value="<?php echo $pass ?>">
                <div class="form-check mt-3"
                    style=" margin-left: 20px; font-family: Popspismedium, sans-serif; font-size: 13px; color: black">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                        onclick="myFunction()">
                    <label class="" for="flexCheckChecked">
                        Hiển thị mật khẩu
                    </label>
                </div>
            </div>
            <div class="button">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input name="capnhat" type="submit" value="Cập Nhật" class="btn btn-dark"></input>
            </div>
        </form>
    </div>
    <?php
    include "view/footer.php";
?>
    <script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>