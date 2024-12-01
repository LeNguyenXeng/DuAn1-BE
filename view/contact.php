<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>
    <?php
 include "view/header.php";
?>
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url('./resources/assets/img/bg-02.jpg'); margin-top: 80px;">
        <h2 class="ltext-105 cl0 txt-center">
            Contact
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form>
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Liên hệ với chúng tôi
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email"
                                placeholder="Địa chỉ Email">
                            <img class="how-pos4 pointer-none" src="./resources/assets/img/icons/icon-email.png"
                                alt="ICON">
                        </div>

                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg"
                                placeholder="Chúng tôi có thể hỗ trợ gì cho bạn?"></textarea>
                        </div>

                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Gửi
                        </button>
                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span style="color: rgb(255, 66, 66);
							font-family: Popspismedium, sans-serif;
							font-size: 16px;
						" class="cl2">
                                Địa Chỉ
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                Store 1: 44A Trần Quang Diệu, Quận 3
                                Store 2: TNP Lý Tự Trọng, Quận 1
                                Store 3: TNP Lê Lai, Quận 1
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span style="color: rgb(255, 66, 66);
							font-family: Popspismedium, sans-serif;
							font-size: 16px;
						" class="cl2">
                                Số điện thoại
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                0396180619
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span style="color: rgb(255, 66, 66);
							font-family: Popspismedium, sans-serif;
							font-size: 16px;
						" class=" cl2">
                                Email hỗ trợ
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                sweofficial@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
 include "view/footer.php";
?>