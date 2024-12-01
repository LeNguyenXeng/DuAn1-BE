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
                Shoping Cart
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <?php
                            // echo var_dump($_SESSION['giohang'][0]);
                            if ((isset($_SESSION['giohang'])) && (count($_SESSION['giohang']) > 0)) {

                                echo '<table class="table-shopping-cart ">
                                            <tr class="table_head">
                                                <th class="column-1" >STT</th>
                                                <th class="column-2">Tên sản phẩm</th>
                                                <th class="column-3">Hình ảnh</th>
                                                <th class="column-4">Số lượng</th>
                                                <th class="column-5">Đơn giá</th>
                                                <th class="column-6">Thành tiền</th>
                                                <th class="column-7">Thao tác</th>
                                            </tr>';
                                $i = 0;
                                $tongtien = 0;
                                foreach ($_SESSION['giohang'] as  $item) {
                                    $quantity = (int)$item[3];  // Số lượng (ep kiểu thành int)
                                    $price = (float)$item[4];

                                    $ttien = $quantity * $price;
                                    $id = $item[0];
                                    $tongtien += $ttien;
                                    echo '<tr class="table_row">
                                                    <td class="column-1">' . ($i + 1) . '</td>
                                                    <td class="column-2">' . $item[1] . '</td>
                                                    <td class="column-3"><img src="' . $item[2] . '" width=" 70px"></td>
                                                    <td class="column-4">' . $item[4] . '</td>
                                                    <td class="column-5">' . $item[3] . '</td>
                                                    <td class="column-6">' . $ttien . '</td>
                                                   <td class="column-7">
            <a href="index.php?act=delcart&i=' . $i . '">
                <input type="button" class="btn btn-outline-danger" value="Xóa">
            </a>
        </td>
                                                </tr>';
                                    $i++;
                                }

                                echo '</table>';
                            }
                            ?>
                            <br>
                            <a href="#">Thanh Toán</a> | <a href="index.php?act=home">Tiếp tục mua hàng</a> | <a href="index.php?act=delcart">Xóa giỏ hàng</a>
                            <!-- <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Sản Phẩm</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Giá</th>
                                    <th class="column-4">Số lượng</th>
                                    <th class="column-5">Tổng tiền</th>
                                </tr>

                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="./resources/assets/img/item-cart-04.jpg" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">COLLAR SHIRT - WHITE
                                    </td>
                                    <td class="column-3">380,000₫</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product1" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">380,000₫</td>
                                </tr>

                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="./resources/assets/img/item-cart-05.jpg" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">YOUTH LS TEE - CREAM</td>
                                    <td class="column-3">480,000₫</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product2" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">480,000₫</td>
                                </tr>
                            </table> -->
                        </div>

                        <div class="button-update flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

                            <div style="font-family: Poppins, sans-serif; text-transform: capitalize;"
                                class="flex-c-m cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Cập nhật
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Tổng giỏ hàng
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Tổng số tiền:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                <?=  number_format($tongtien, 0, ",", ".")  ?>
                                </span>
                            </div>
                        </div>

                        <div class="bor12 p-t-15 p-b-30">
                            <div class="w-full-ssm">
                                <span class="stext-110 cl2">
                                    Thông tin nhận hàng:
                                </span>
                            </div>

                            
                            <form action="index.php?act=thanhtoan" method="POST">
                                <table class="table-shopping-cart">
                                <input type="hidden" value="<?php echo $tongdonhang; ?>" name="tongdonhang">
                                <input type="hidden" value="" name="dienthoai">
                                <input type="hidden" value="" name="name">
                                <input type="hidden" value="<?php echo $user; ?>" name="user">

                                
                                                <tr>
                                                    <td><input type="text" name="hoten" placeholder="Nhập họ tên" required></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="diachi" placeholder="Nhập địa chỉ nhà" required></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="email" placeholder="Nhập email" required></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="sdt" placeholder="Nhập số điện thoại" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Phương thức thanh toán <br>
                                                    <input type="radio" name="ptthanhtoan" value="1">Thanh toán khi nhận hàng <br>
                                                    <input type="radio" name="ptthanhtoan" value="2">Thanh toán Ví Pay<br>
                                                    <input type="radio" name="ptthanhtoan" value="3">Thanh toán Ví MoMo<br>
                                                    <input type="radio" name="ptthanhtoan" value="4">Thanh toán Online<br>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    <input class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04" type="submit" name="thanhtoan" value="Đặt hàng">

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