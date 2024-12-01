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
        <?php
            if(isset($_SESSION['user'])){
                extract($_SESSION['user']);
                
        ?>
        <div class="mb-3" style="margin-top: 20px;">
            <label style="font-size: 15px" for="exampleInputEmail1" class="tkmk form-label">Xin chào
                <?php echo $user ?></label>
        </div>
        <div class="mb-3" style="font-family: Popspismedium, sans-serif;">
            <a href="index.php?act=quenmk">Quên mật khẩu</a>
        </div>
        <div class="mb-3" style="font-family: Popspismedium, sans-serif;">
            <a href="index.php?act=edit_taikhoan">Cập nhật tài khoản</a>
        </div>
        <?php
            if ($role == 1) {
        ?>
        <div class="mb-3" style="font-family: Popspismedium, sans-serif;">
            <a href="admin/index.php">Đăng nhập vào admin</a>
        </div>
        <?php
        }
        ?>
        <div class="mb-3" style="font-family: Popspismedium, sans-serif;">
            <a href="index.php?act=logout">Đăng Xuất</a>
        </div>

        <?php
        }else{

        ?>
        <h2 class="textdangnhap text-center text-uppercase">Đăng nhập tài khoản</h2>
        <div class="chuacotk d-flex justify-content-center">
            <h6 class="text-center">Bạn chưa có tài khoản ?</h6>
            <a href="index.php?act=register">
                <h6 class="texta text-center">Đăng ký tại đây</h6>
            </a>
        </div>
        <form action="index.php?act=login" method="POST">
            <div class="mb-3" style="margin-top: 20px;">
                <label for="exampleInputEmail1" class="tkmk form-label">Email</label>
                <input name="email" type="email" class="inputform form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder=" Email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="tkmk form-label">Mật khẩu</label>
                <input name="pass" type="password" class="inputform form-control" id="exampleInputPassword1"
                    placeholder=" Mật khẩu">
            </div>
            <div class="mb-3">
                <a class="quenmk" href="index.php?act=quenmk">Quên mật khẩu</a>
            </div>
            <div class="button">
                <input type="submit" class="btn btn-dark" name="dangnhap" value="Đăng Nhập"></input>
            </div>
        </form>
        <?php }?>
    </div>

    <?php
    include "view/footer.php";
?>