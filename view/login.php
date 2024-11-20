<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php
    include "view/header.php";
?>
    <hr style="margin-top: 84px;">
    <div class="container" style="margin-top: -15px;">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php?act=home" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Login
            </span>
        </div>
    </div>

    <div class="login-page">
        <h2 class="textdangnhap text-center text-uppercase">Đăng nhập tài khoản</h2>
        <div class="chuacotk d-flex justify-content-center">
            <h6 class="text-center">Bạn chưa có tài khoản ?</h6>
            <a href="index.php?act=register">
                <h6 class="texta text-center">Đăng ký tại đây</h6>
            </a>
        </div>
        <form>
            <div class="mb-3" style="margin-top: 20px;">
                <label for="exampleInputEmail1" class="tkmk form-label">Email</label>
                <input type="email" class="inputform form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder=" Email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="tkmk form-label">Mật khẩu</label>
                <input type="password" class="inputform form-control" id="exampleInputPassword1"
                    placeholder=" Mật khẩu">
            </div>
            <div class="mb-3">
                <a class="quenmk" href="#">Quên mật khẩu</a>
            </div>
            <div class="button">
                <button type="button" class="btn btn-dark">Đăng Nhập</button>
            </div>
        </form>
    </div>

    <?php
    include "view/footer.php";
?>