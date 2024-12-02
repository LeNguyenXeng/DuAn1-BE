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
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="./resources/assets/img/avatar.png" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 style="font-weight: bold;" class="my-3"><?php echo $user ?></h5>
                            <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 10px;">
                                <button type="button"
                                    style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
                                    <a href="index.php?act=quenmk" style="color: white; text-decoration: none;">Quên mật
                                        khẩu</a>

                                </button>
                                <button type="button"
                                    style="padding: 10px; background-color: transparent; border: 1px solid #6c757d; border-radius: 5px;">
                                    <a href="index.php?act=edit_taikhoan"
                                        style="color: #6c757d; text-decoration: none;">Cập nhật tài khoản</a>
                                </button>
                            </div>

                            <?php if ($role == 1) { ?>
                            <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 10px;">
                                <button type="button"
                                    style="padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; width: 283px;">
                                    <a href="admin/index.php" style="color: white; text-decoration: none;">Đăng nhập vào
                                        Admin</a>
                                </button>
                            </div>
                            <?php } ?>
                            <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 10px; ">
                                <button type="button"
                                    style="padding: 10px; background-color: transparent; border: 1px solid #dc3545; border-radius: 5px; width: 283px;">
                                    <a href="index.php?act=logout" style="color: #dc3545; text-decoration: none;">Đăng
                                        Xuất</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div style="display: flex; margin-bottom: 10px;">
                                <div style="width: 30%; font-weight: bold;">Họ tên</div>
                                <div style="width: 70%;"><?php echo $user ?></div>
                            </div>
                            <hr>
                            <div style="display: flex; margin-bottom: 10px;">
                                <div style="width: 30%; font-weight: bold;">Email</div>
                                <div style="width: 70%;"><?php echo $email ?></div>
                            </div>
                            <hr>
                            <div style="display: flex; margin-bottom: 10px;">
                                <div style="width: 30%; font-weight: bold;">Số điện thoại</div>
                                <div style="width: 70%;"><?php echo $tel ?></div>
                            </div>
                            <hr>
                            <div style="display: flex; margin-bottom: 10px;">
                                <div style="width: 30%; font-weight: bold;">Mật khẩu</div>
                                <div style="width: 70%;"><?php echo $pass ?></div>
                            </div>
                            <hr>
                            <div style="display: flex; margin-bottom: 10px;">
                                <div style="width: 30%; font-weight: bold;">Địa Chỉ</div>
                                <div style="width: 70%;"><?php echo $address ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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