<?php
include "../connect.php";
?>
<title>Document</title>
<link rel="stylesheet" href="../libary/fontawesome-free-6.4.2-web (1)/fontawesome-free-6.4.2-web/css/all.min.css">
<link rel="stylesheet" href="base.css">
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="index_user.css">
<link rel="stylesheet" href="user_product.css">

<div class="main">
    <!-- header -->

    <head class="header">
        <div class="header-modify">
            <img id="header-logo" src="../img/logo.png" alt="">
            <ul class="header-modify__text">
                <li class="header-text__title">
                    Đồ ăn
                </li>
                <li class="header-text__title1">
                    <i class="fa-solid fa-arrow-right"></i>
                </li>
                <li class="header-text__title2">
                    Chọn Món Tại đây
                </li>
            </ul>
        </div>
    </head>
    <!-- end header -->
    <!-- content -->
    <div class="container">
        <div class="content1">
            <div class="input-content1">
                <form class="form-search" method="post" action="index_user.php">
                    <div class="search">
                        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                    </div>
                    <div class="btn-search">
                        <button class="button" type="submit">
                            <i class="icon-search fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="suggest">
                <ul class="suggest-list">
                    <li class="suggest-list__modify1">
                        <a href="">ALL</a>
                    </li>
                    <li class="suggest-list__modify1">
                        <a href="">Hủ tiếu</a>
                    </li>
                    <li class="suggest-list__modify1">
                        <a href="">Đồ uống</a>
                    </li>
                    <br>
                    <li class="suggest-list__modify2">
                        <a href="">Đồ chay</a>
                    </li>
                    <li class="suggest-list__modify2">
                        <a href="">Tráng miệng</a>
                    </li>
                    <li class="suggest-list__modify3">
                        <a href=""> Chiên xào</a>
                    </li>
                    <li class="suggest-list__modify3">
                        <a href="">Món ngon nè</a>
                    </li>
                    <li class="suggest-list__modify3">
                        <a href="">Món này cũng ngon</a>
                    </li>
                </ul>
                <p id="suggest-list__title">
                    Order C bảo đảm thực phẩm ngon nhất tươi nhất

                </p>
                <div class="button-back">

                   <a href="index_user.php"> <button class="btn bottom-btn"> Về Trang Chủ
                    </button></a>
                </div>
            </div>

        </div>
        <div class="content2">
            <?php require("../timkiem/search_product_user.php"); ?>
            <?php require("user_product.php"); ?>

        </div>


    </div>


</div>