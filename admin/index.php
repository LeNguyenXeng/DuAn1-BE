<?php
include "header.php";

if(isset($_GET['act'])){
    $act = $_GET['act'];
    switch ($act) {
        case 'home':
            include "home.php";
            break;
        
        default:
            include "home.php";
            break;
    }
}
else{
    include "home.php";
}

?>