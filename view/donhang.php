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
    <p style="color: green;
font-size: 65px; text-align: center;"><i class="zmdi zmdi-check-circle"></i></p>
    <h4 class="text-center">Bạn đã đặt hàng thành công</h4>
    <h6 class="text-center m-t-10"><a class="" href="index.php?act=home">Trở về trang chủ</a></h6>
    <form class="bg0 p-t-29 p-b-85">
        <?php
          if (isset($_SESSION['iddonhang']) && !empty($_SESSION['iddonhang'])) {
            $iddonhang = $_SESSION['iddonhang'];
            $getinfo = getinfo($_SESSION['iddonhang']);
            if(count($getinfo)>0){
                
        ?>
        <div class="container">
            <div>
                <div class=" m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart" style="border: 10px solid #f7f7f7;">
                            <table class="table table-hover">
                                <thead style=" font-family: bold2, sans-serif; font-size: 14px;">
                                    <tr>
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Trạng thái thanh toán</th>
                                        <th scope="col">Vận chuyển</th>
                                    </tr>
                                </thead>
                                <tbody style="font-family: Poppins-Regular, sans-serif; font-size: 14px;">
                                    <tr>
                                        <td><?php echo $getinfo[0]['madonhang'] ?></td>
                                        <td>01/12/2024</td>
                                        <td>455,000₫</td>
                                        <td>Đang chờ xử lý</td>
                                        <td>Chưa giao hàng</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        </div>
        <?php 
            }
    } ?>
    </form>


    <?php
    require "view/footer.php";
    ?>