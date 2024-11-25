<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
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
                Register
            </span>
        </div>
    </div>


    <div class="login-page">
        <h2 class="textdangnhap text-center text-uppercase">Đăng ký tài khoản</h2>
        <div class="chuacotk d-flex justify-content-center">
            <h6 class="text-center">Bạn đã có tài khoản ?</h6>
            <a href="index.php?act=login">
                <h6 class="texta text-center">Đăng nhập tại dây</h6>
            </a>
        </div>
        <form method="POST" action="">
            <div class="mb-3">
                <label style="margin-top: 15px" for="exampleInputEmail1" class="tkmk form-label">Họ tên<nav></nav>
                </label>
                <input name="user" type="text" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Họ tên" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="tkmk form-label">Số điện thoại</label>
                <input name="tel" type="number" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Số điện thoại" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="tkmk form-label">Email</label>
                <input name="email" type="email" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="tkmk form-label">Mật khẩu</label>
                <input name="pass" type="password" class="inputform form-control" id="exampleInputPassword1"
                    placeholder=" Mật khẩu">
            </div>
            <div class="button">
                <input name="dangky" type="submit" value="Đăng Ký" class="btn btn-dark"></input>
            </div>
        </form>
    </div>
    <?php
    include "view/footer.php";
?>
