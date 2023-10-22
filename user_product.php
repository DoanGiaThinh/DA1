<?php
include "../connect.php";
?>


<h1>Sản phẩm</h1>

<ul class="product-row1">
    <?php
    $sql = "SELECT anh, tenmon, gia FROM mon";
    $result = mysqli_query($conn, $sql);

    // In sản phẩm
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $anh = $row["anh"];
            $tenmon = $row["tenmon"];
            $gia = $row["gia"];

            echo '<a href="../btn_order/product_detail.php?id=' . $tenmon . '"><li class="product content2-product">';
            echo '<img width="185" height="185" src="../img/SanPham/' . $row['anh'] . '">';
            echo '<p class="product_name">' . $tenmon . '</p>';
            echo '<span class="content2-cost__title product_price">' . $gia .' <sub>đ</sub></span>';
            echo '</li></a>';
        }
    }
    ?>
</ul>