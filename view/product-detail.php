<!DOCTYPE html>
<style>
    /* CSS cho popup lỗi */
.showErrorPopup {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f8d7da; /* Màu nền đỏ nhạt */
    color: #721c24;           /* Màu chữ đỏ đậm */
    padding: 15px 20px;
    border: 1px solid #f5c6cb; /* Viền đỏ nhạt */
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
}

/* Hiệu ứng đóng popup */
.showErrorPopup.hidden {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* Hiệu ứng hiển thị */
.showErrorPopup.show {
    display: block;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.popup-success {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #28a745;
    color: white;
    border-radius: 10px;
    padding: 20px 40px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    display: none;
    /* Ẩn mặc định */
    z-index: 9999;
}

.popup-success i {
    font-size: 50px;
    margin-bottom: 10px;
}

.popup-success.show {
    display: block;
    /* Hiển thị khi có class 'show' */
}
</style>
<html lang="en">

<head>
    <title>Product Detail</title>
    <?php
include "view/header.php";

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan1";

// Kiểm tra nếu session đã được khởi tạo và có thông tin người dùng
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    // Lấy thông tin người dùng từ session
    $user_name = $_SESSION['user']['user']; // Thay 'username' bằng thông tin người dùng bạn cần
    $user = intval($_SESSION['user']['id']); // ID user
} else {
    $user_name = ""; // Nếu không có người dùng đăng nhập, gán biến user_name là rỗng
    $user = 0; // ID user không hợp lệ
}

// Khởi tạo kết nối PDO
try {
    // Kết nối cơ sở dữ liệu bằng PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy id sản phẩm
    $idpro = isset($_GET['idsp']) ? intval($_GET['idsp']) : 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if ($user === 0) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showErrorPopup('Bạn cần đăng nhập để bình luận!');
                setTimeout(function() {
                    window.location.href = 'index.php?act=login';
                }, 2000); // Chờ 2 giây trước khi chuyển hướng
            });
        </script>";
        } else {
            $ten = isset($_POST['name']) ? trim($_POST['name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $noidung = isset($_POST['review']) ? trim($_POST['review']) : '';
            $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 5;
            $ngaybl = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

            // Kiểm tra nếu user đã bình luận sản phẩm này
            $checkQuery = "SELECT COUNT(*) FROM binhluan WHERE idpro = :idpro AND user = :user";
            $stmt = $pdo->prepare($checkQuery);
            $stmt->bindParam(':idpro', $idpro, PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, PDO::PARAM_INT);
            $stmt->execute();

            $hasCommented = $stmt->fetchColumn() > 0;

            if ($hasCommented) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showErrorPopup('Bạn đã bình luận cho sản phẩm này rồi!');
                    });
                </script>";
            } else {
                if (!empty($ten) && !empty($noidung) && $rating >= 1 && $rating <= 5) {
                    $insertQuery = "INSERT INTO binhluan (idpro, user, ten, email, noidung, rating, ngaybl) 
                                    VALUES (:idpro, :user, :ten, :email, :noidung, :rating, :ngaybl)";
                    $stmt = $pdo->prepare($insertQuery);
                    $stmt->bindParam(':idpro', $idpro, PDO::PARAM_INT);
                    $stmt->bindParam(':user', $user, PDO::PARAM_INT);
                    $stmt->bindParam(':ten', $ten, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);
                    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
                    $stmt->bindParam(':ngaybl', $ngaybl, PDO::PARAM_STR);
                    $stmt->execute();

                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showSuccessPopup('Bình luận của bạn đã được thêm thành công!');
                        });
                    </script>";
                } else {
                    echo "<p class='text-danger'>Vui lòng nhập đầy đủ thông tin và chọn đánh giá hợp lệ!</p>";
                }
            }
        }
    }

    // Truy vấn danh sách bình luận theo idpro
    $query = "SELECT ten, ngaybl, noidung, rating FROM binhluan WHERE idpro = :idpro ORDER BY ngaybl DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idpro', $idpro, PDO::PARAM_INT);
    $stmt->execute();

    $binhluan = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả dữ liệu bình luận
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    $binhluan = []; // Nếu lỗi, đặt mảng bình luận trống
}
?>

  
 <?php
                extract($onesp);
            ?>
    <div class="container" style="margin-top: 60px;">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php?act=home" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="index.php?act=shop" class="stext-109 cl8 hov-cl1 trans-04">
                Shop
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
            <?php echo $tensp ?>
            </span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
           
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <?php
                                    $img = $img_path.$img;
                                ?>
                                <div class="item-slick3">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="<?php echo $img ?>" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="<?php echo $img ?>">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            <?php echo $tensp ?>
                        </h4>

                        <span class="mtext-106 cl2">
                            <?php echo number_format($price, 0, '', ',') . '₫'; ?>
                        </span>

                        <p style="font-family: Poppins, sans-serif; font-size: 14px; line-height: 1.7;"
                            class=" cl3 p-t-23">
                            <?php echo $mota ?>
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Chọn Size</option>
                                            <option>Size S</option>
                                            <option>Size M</option>
                                            <option>Size L</option>
                                            <option>Size XL</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Chọn Màu</option>
                                            <option>Đỏ</option>
                                            <option>Xanh</option>
                                            <option>Trắng</option>
                                            <option>Xám</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="num-product" value="1" min="1" max="50" name="sl">


                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>


                                    </div>
                                    <br>
                                    <form method="post" action="index.php?act=addcart">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <input type="hidden" name="tensp" value="<?php echo $tensp ?>">
                                        <input type="hidden" name="hinh" value="<?php echo $img ?>">
                                        <input type="hidden" name="price" value="<?php echo $price ?>">
                                        <input
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                            type="submit" name="addtocart" value="Thêm vào giỏ hàng">
                                    </form>

                                    <!-- <input value="Teem vao gio hang" a href="index.php?act=addcart.php"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" name="addtocart"> -->
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                onclick="window.open('https://www.facebook.com/streetweareazy')"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                onclick="window.open('https://www.instagram.com/swe.vn?fbclid=IwZXh0bgNhZW0CMTAAAR2eVGEt-mSt9nCtCppMc2zQ8ZbeJ8wahw8I2NEeQKGtOoWw5Fv3cL4uADU_aem_C9l3HfbUojAv2xgfsw2asw')"
                                data-tooltip="Instagram">
                                <i class="fa fa-instagram"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                onclick="window.open('https://www.behance.net/lenguyenxeng')" data-tooltip="Behance">
                                <i class="fa fa-behance"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô Tả</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông Tin Sản Phẩm</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh Giá</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    <?php
                                        echo $mota
                                    ?>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Màu
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                Đỏ
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Chất liệu
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                POLYESTER 100%
                                            </span>
                                        </li>
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Size
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                X, M, L, XL
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        <div class="card">
                                            <div class="card-header">Danh sách bình luận</div>
                                            <div class="card-body">
                                                <?php if (!empty($binhluan)): ?>
                                                <?php foreach ($binhluan as $comment): ?>
                                                <div class="comment-item border-top py-3">
                                                    <div
                                                        class="top-comment-item d-flex align-items-center justify-content-between">
                                                        <div class="user-name">
                                                            <strong><?php echo htmlspecialchars($comment['ten']); ?></strong>
                                                        </div>
                                                        <div class="date-comment">
                                                            <span><?php echo htmlspecialchars($comment['ngaybl']); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-comment mt-2">
                                                        <?php 
                                                        $rating = intval($comment['rating']); // Đảm bảo rating là số nguyên
                                                        echo str_repeat('<i class="zmdi zmdi-star text-warning"></i>', $rating); 
                                                        echo str_repeat('<i class="zmdi zmdi-star-outline text-muted"></i>', 5 - $rating);
                                                    ?>
                                                    </div>
                                                    <div class="bottom-comment-item mt-2">
                                                        <?php echo nl2br(htmlspecialchars($comment['noidung'])); ?>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <p>Không có bình luận nào.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <br>

                                        <!-- Add review -->
                                        <form class="w-full" method="POST" action="" enctype="multipart/form-data">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Thêm đánh giá của bạn
                                            </h5>

                                            <p class="stext-102 cl6">
                                                Your email address will not be published. Required fields are marked *
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">Đánh giá</span>

                                                <!-- Đánh giá sao -->
                                                <div class="wrap-rating fs-18 cl11 pointer"
                                                    style="display: flex; gap: 5px;">
                                                    <input class="dis-none" type="radio" name="rating" value="1"
                                                        id="star1">
                                                    <label for="star1"
                                                        class="item-rating zmdi zmdi-star-outline"></label>

                                                    <input class="dis-none" type="radio" name="rating" value="2"
                                                        id="star2">
                                                    <label for="star2"
                                                        class="item-rating zmdi zmdi-star-outline"></label>

                                                    <input class="dis-none" type="radio" name="rating" value="3"
                                                        id="star3">
                                                    <label for="star3"
                                                        class="item-rating zmdi zmdi-star-outline"></label>

                                                    <input class="dis-none" type="radio" name="rating" value="4"
                                                        id="star4">
                                                    <label for="star4"
                                                        class="item-rating zmdi zmdi-star-outline"></label>

                                                    <input class="dis-none" type="radio" name="rating" value="5"
                                                        id="star5">
                                                    <label for="star5"
                                                        class="item-rating zmdi zmdi-star-outline"></label>
                                                </div>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Bình luận</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                        id="review" name="review" required></textarea>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label class="stext-102 cl3" for="name" style="margin-top: 10px;">Họ
                                                        Tên</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                        type="text" name="name" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label class="stext-102 cl3" for="email"
                                                        style="margin-top: 10px;">Email</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                        type="email" name="email" required>
                                                </div>
                                            </div>
                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Bình luận
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-01.jpg" alt="IMG-PRODUCT">

                                <a href="index.php?act=product"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        CREW LS JERSEY - RED
                                    </a>

                                    <span class="stext-105 cl3">
                                        450,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-02.jpg" alt="IMG-PRODUCT">

                                <a href="index.php?act=product"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        CREW LS JERSEY - BLACK
                                    </a>

                                    <span class="stext-105 cl3">
                                        450,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-03.jpg" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        EDGE WASHED JEANS - BLUE
                                    </a>

                                    <span class="stext-105 cl3">
                                        650,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-04.jpg" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        EDGE WASHED JEANS - LIGHT BLUE
                                    </a>

                                    <span class="stext-105 cl3">
                                        650,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-05.jpg" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        NIGHTSTAR BACKPACK
                                    </a>

                                    <span class="stext-105 cl3">
                                        420,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-06.jpg" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        S LETTER CAP - BLUE
                                    </a>

                                    <span class="stext-105 cl3">
                                        250,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-07.jpg" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        E LETTER CAP - BEIGE
                                    </a>

                                    <span class="stext-105 cl3">
                                        250,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="./resources/assets/img/product-08.jpg" alt="IMG-PRODUCT">

                                <a href="#"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Xem Chi Tiết
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="index.php?act=product"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        KA STRIPED TOTE - PINK
                                    </a>

                                    <span class="stext-105 cl3">
                                        320,000₫
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04"
                                            src="./resources/assets/img/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="./resources/assets/img/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include "view/footer.php";
?>
    <script>
    function showSuccessPopup(message) {
        const popup = document.createElement('div');
        popup.className = 'popup-success';

        popup.innerHTML = `
          <i class="fa fa-check-circle"></i>
          <p>${message}</p>
      `;

        document.body.appendChild(popup);
        popup.classList.add('show');

        // Ẩn popup sau 3 giây
        setTimeout(() => {
            popup.classList.remove('show');
            document.body.removeChild(popup);
        }, 3000);
    };
    function showErrorPopup(message) {
    // Tạo popup
    const popup = document.createElement('div');
    popup.className = 'showErrorPopup';
    popup.textContent = message;

    // Thêm vào body
    document.body.appendChild(popup);

    // Tự động ẩn popup sau 3 giây
    setTimeout(() => {
        popup.classList.add('hidden');
        setTimeout(() => popup.remove(), 300); // Gỡ bỏ popup sau khi hiệu ứng kết thúc
    }, 3000);
}

    </script>