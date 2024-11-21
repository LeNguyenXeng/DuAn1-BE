<?php

if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'product':
            include "view/product-detail.php";
            break;
        case 'shoppingcart':
            include "view/shoppingcart.php";
            break;
        case 'about':
            include "view/about.php";
            break;
        case 'contact':
            include "view/contact.php";
            break;
        case 'login':
            include "view/login.php";
            break;
        case 'register':
            include "view/register.php";
            break;
        case 'shop':
            include "view/shop.php";
            break;
        default:
            include "view/home.php";
            break;
    }
}
else{
    include "view/home.php";
}


?>