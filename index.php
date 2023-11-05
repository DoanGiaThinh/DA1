<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="header">
        <p>Trang Quản Trị</p>
    </div>
    <div class="main">
        <div class="container">
            <ul class="vertical-menu">
                <li><a href="main/index.php">Về Trang Chủ</a></li>
                <li><a href="index.php?page=product">Món</a></li>
                <li><a href="index.php?page=customer">Khách Hàng</a></li>
                <li><a href="index.php?page=order">Đơn Hàng</a></li>
                <li><a href="index.php?page=order_details">Chi Tiết Đơn</a></li>
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