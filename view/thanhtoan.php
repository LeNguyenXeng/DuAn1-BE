<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping Cart</title>
    <?php
    require "view/header.php";
    ?>
    <div class="container" style="margin-top: 60px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php?act=home" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Thanh Toán
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->

    <div class="container">
        <?php
                            $tongtien = 0;
                            if ((isset($_SESSION['giohang'])) && (count($_SESSION['giohang']) > 0)) {

                                $i = 0;
                                foreach ($_SESSION['giohang'] as  $item) {
                                    $quantity = (int)$item[3];  // Số lượng (ep kiểu thành int)
                                    $price = (float)$item[4];

                                    $ttien = $quantity * $price;
                                    $id = $item[0];
                                    $tongtien += $ttien;
                            }
                        }
                            ?>
        <div>
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-lr-0-xl p-lr-15-sm" style="margin-top: 20px; margin-bottom:50px">
                <h4 class="mtext-109 cl2 p-b-30" style="font-weight: 600; font-size: 22px">
                    Tổng giỏ hàng
                </h4>

                <div class="flex-w flex-t bor12 p-b-13">
                    <div>
                        <span class="stext-110 cl2">
                            Tổng số tiền:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?= number_format($tongtien, 0, ",", ".") . ' ₫'; ?>
                        </span>
                    </div>
                </div>

                <div class="bor12 p-t-15 p-b-30">
                    <div class="w-full-ssm">
                        <span class="stext-110 cl2">
                            Thông tin nhận hàng:
                        </span>
                    </div>


                    <form action="index.php?act=thanhtoan" method="POST" style="margin-top:20px">
                        <table class="table-shopping-cart">
                            <input type="hidden" value="<?php echo $tongdonhang; ?>" name="tongdonhang">
                            <input type="hidden" value="" name="dienthoai">
                            <input type="hidden" value="" name="name">
                            <input type="hidden" value="<?php echo $user; ?>" name="user">


                            <div class="bor8 bg0 m-b-12">
                                <input style="height: 50px;" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                    name="hoten" placeholder="Nhập họ tên" required>
                            </div>
                            <div class=" bor8 bg0 m-b-12">
                                <input style="height: 50px;" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                    name="diachi" placeholder="Nhập địa chỉ nhà" required>
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input style="height: 50px;" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                    name="email" placeholder="Nhập email" required>
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input style="height: 50px;" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                    name="sdt" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div style="margin-left: 2px;">
                                <div style="margin-top: 10px;">
                                    <p style="margin-bottom: 7px; margin-top: 16px; font-size: 17px; ">Phương thức thanh
                                        toán:
                                </div>
                                <div style="display: flex; margin-bottom: 10px; font-size: 14px;">
                                    <input type="radio" name="ptthanhtoan" value="1"><span
                                        style="margin-left: 8px;">Thanh toán khi nhận
                                        hàng</span>
                                </div>
                                <div style="display: flex; margin-bottom: 10px; font-size: 14px;">
                                    <input type="radio" name="ptthanhtoan" value="2"><span
                                        style="margin-left: 8px;">Thanh toán Ví Pay</span>
                                </div>

                                <div style=" display: flex; margin-bottom: 10px; font-size: 14px;">
                                    <input type="radio" name="ptthanhtoan" value="3"><span
                                        style="margin-left: 8px;">Thanh toán Ví
                                        MoMo</span>
                                </div>

                                <div style=" display: flex; margin-bottom: 10px; font-size: 14px;">
                                    <input type="radio" name="ptthanhtoan" value="4"><span
                                        style="margin-left: 8px;">Thanh toán
                                        Online</span>
                                </div>
                                </td>
                            </div>
                            <tr>
                                <td>
                                    <input class=" flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04"
                                        type="submit" name="thanhtoan" value="Đặt hàng">

                                </td>
                            </tr>

                        </table>

                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>





    <?php
    require "view/footer.php";
    ?>