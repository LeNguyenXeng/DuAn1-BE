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
        <div class="row" style="margin-top: 20px;">
            <div style="width: 100%; margin-bottom: 50px;">
                <div class="m-l-25 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <?php
                                $tongtien = 0;
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
                                                   <td class="column-5">' . number_format($item[3], 0, ',', '.') . '₫</td>
                                                    <td class="column-6">' . number_format($ttien, 0, ',', '.') . '₫</td>

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
                        <div style="display: flex; margin: 15px 46px 35px; font-size: 17px;">
                            <p>
                                Tổng Tiền:
                            </p>
                            <span
                                style="color: red; margin-left: 10px;"><?= number_format($tongtien, 0, ",", ".") . '₫'; ?></span>
                        </div>
                        <hr>

                        <div class="div" style="display: flex; justify-content: center; padding-top: 18px; gap: 20px;">
                            <a style="height: 41px; font-family: Poppins, sans-serif; text-transform: capitalize; width: 155px; text-align: center;"
                                class="flex-c-m cl2 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                                href="index.php?act=thanhtoandonhang">Thanh
                                Toán</a>
                            <a style="height: 41px; font-family: Poppins, sans-serif; text-transform: capitalize; width: 200px; text-align: center;"
                                class="flex-c-m cl2 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                                href="index.php?act=home">Tiếp tục mua hàng</a>
                            <a style="height: 41px; font-family: Poppins, sans-serif; text-transform: capitalize; width: 155px; text-align: center;"
                                class="flex-c-m cl2 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                                href="index.php?act=delcart">Xóa giỏ hàng</a>

                        </div>

                    </div>

                    <div class="button-update flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php
    require "view/footer.php";
    ?>