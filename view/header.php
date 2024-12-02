<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="./resources\assets\img\icons\favicon.png" />
<link rel="stylesheet" href="./resources/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./resources/assets/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./resources/assets/fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\fonts\linearicons-v1.0.0\icon-font.min.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\animate\animate.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\css-hamburgers\hamburgers.css">
<link rel="tylesheet" type="text/css" href="./resources\assets\vendor\animsition\css\animsition.min.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\select2\select2.min.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\daterangepicker\daterangepicker.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\slick\slick.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\MagnificPopup\magnific-popup.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\vendor\perfect-scrollbar\perfect-scrollbar.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\css\util.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\css\main.css">
<link rel="stylesheet" type="text/css" href="./resources\assets\css\product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Miễn phí vận chuyển với đơn hàng trên 500K. Hàng pre-order còn được giảm thêm 5%.
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="index.php?act=home" class="logo">
                        <img src="./resources/assets/img/icons/logo-01.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="index.php">Home</a>
                            </li>

                            <li class="label1" data-label1="hot">
                                <a href="index.php?act=shop">Shop</a>
                            </li>

                            <li>
                                <a href="index.php?act=shoppingcart">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="index.php?act=about">About</a>
                            </li>

                            <li>
                                <a href="index.php?act=contact">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" data-notify="2">
                            <a style="color: #333" href="index.php?act=shoppingcart">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </a>

                        </div>

                        <div class="icon-user">
                            <a href="index.php?act=login"
                                class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                                <i class="zmdi zmdi-account-o"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="home.html"><img src="./resources/assets/img/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <div class="icon-user">
                    <a href="/login.html"
                        class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti">
                        <i class="zmdi zmdi-account-o"></i>
                    </a>
                </div>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li>
                    <a href="home.html">Home</a>
                </li>

                <li>
                    <a href="product.html" class="label1 rs1" data-label1="hot">Shop</a>
                </li>

                <li>
                    <a href="shoping-cart.html">Shopping Cart</a>
                </li>

                <li>
                    <a href="about.html">About</a>
                </li>

                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="./resources/assets/img/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder=" Tìm kiếm...">
                </form>
            </div>
        </div>
    </header>