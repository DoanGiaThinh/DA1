<!DOCTYPE html>
<html>

<head>
    <title>Giỏ hàng</title>
</head>
<link rel="stylesheet" href="../fontawesome/fontawesome6.4.2/css/all.css">
<link rel="stylesheet" href="cart.css">

<body>
    <a id="tieptucmuasam" href="../customer/index_user.php"><i class="fa-solid fa-left-long"></i>Tiếp tục mua sắm</a>
    <div class="title">Giỏ hàng của bạn</div>

    <?php
    include "../connect.php";
    session_start();

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];

        if (empty($cart)) {
            echo "<p>Giỏ hàng của bạn đang trống.</p>";
        } else {
            echo "<form action='update_cart.php' method='post'>";
            echo "<table>";
            echo "<tr>
                  <th>Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                </tr>";

            $totalPayment = 0; // Khởi tạo biến tổng thanh toán

            foreach ($cart as $productId => $quantity) {
                $stmt = $conn->prepare("SELECT * FROM mon WHERE tenmon = ?");
                $stmt->bind_param("s", $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $anh = $row["anh"];
                    $tenmon = $row["tenmon"];
                    $gia = $row["gia"];
                    $tongtien = $gia * $quantity;


                    echo "<tr>";
                    echo "<td><img src='../img/SanPham/$anh' alt='Hình ảnh sản phẩm'></td>";
                    echo "<td>$tenmon</td>";
                    echo "<td>" . number_format($gia) . " đ</td>";
                    $_SESSION['quantity'] = $quantity;
                    echo "<td><input id='quantity' type='number' name='quantity[$productId]' value='$quantity' min='1' ></td>";
                    echo "<td>" . number_format($tongtien) . "đ</td>";
                    echo "<td><a href='remove_from_cart.php?product=$productId'><i class='fa-solid fa-trash-can'></i></a></td>"; // Thêm cột Xóa sản phẩm
                    echo "</tr>";

                    $totalPayment += $tongtien; // Cộng vào tổng thanh toán
                }
            }

            echo "</table>";
            $_SESSION['totalPayment'] = $totalPayment;
            echo "<p id='total_payment'>Tổng thanh toán: " . number_format($totalPayment) . " đ</p>";
            echo "<input id='update_cart' type='submit' value='Cập nhật giỏ hàng'>";
            echo "<input type='hidden' name='cart' value='" . htmlspecialchars(json_encode($cart)) . "'>";
            echo "</form>";
            echo '<a class="checkout_btn" href="checkout.php">Thanh Toán</a>';
        }
    } else {
        echo "<p>Giỏ hàng của bạn đang trống.</p>";
    }
    ?>
    
</body>

</html>