<?php
// Kết nối đến cơ sở dữ liệu
include "../connect.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="main">
        <div class="container">

            <div class="top-menu">
                <img src="../img/logo.png">

            </div>
            <ul class="vertical-menu">
                <a href="menu_admin.php"><li>Về Trang Chủ</li></a>
                <a href="index.php?page=product"><li>Món</li></a>
                <a href="index.php?page=customer"><li>Khách Hàng</li></a>
                <a href="index.php?page=order"><li>Đơn Hàng</li></a>
                <a href="index.php?page=order_details"><li>Chi Tiết Đơn</li></a>
            </ul>
        </div>
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $page = $page . ".php";
            require($page);
        }
        ?>
    </div>

</body>

</html>