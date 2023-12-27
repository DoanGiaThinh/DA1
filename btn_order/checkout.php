<link rel="stylesheet" href="checkout.css">

<?php
session_start();
?>

<a id="quaylaigiohang" href="cart.php">Quay lại giỏ hàng</a>
<form action="process_order.php"  method = "post">
    <div class="main">
        <div class="customer">
            <?php
            require("../admin/add_customer.php");
            ?>
        </div>

        <div class="transport">
            <p>Phí vận chuyển thông thường: 25.000₫</p>

            <h2>Chọn phương thức thanh toán</h2>
            <input type="radio" name="payment" value="chuyenkhoan" id="chuyenkhoan" required>
            <label for="chuyenkhoan">Chuyển khoản qua ngân hàng</label><br>
            <input type="radio" name="payment" value="cod" id="cod" required>
            <label for="cod">Thanh toán khi giao hàng (COD)</label><br>
        </div>


        <div class="order">
            <?php


            // Kiểm tra xem có giỏ hàng trong session không
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];

                $totalPayment = 0; // Khởi tạo biến tổng thanh toán

                // Kết nối CSDL
                include "../connect.php";

                // Hiển thị thông tin sản phẩm trong giỏ hàng
                echo "<table>";
                echo "<tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                      </tr>";

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
                        echo "<td>$quantity</td>";
                        echo "<td>" . number_format($tongtien) . " đ</td>";
                        echo "</tr>";

                        $totalPayment += $tongtien+25000; // Cộng vào tổng thanh toán                        
                    }
                }
                
                echo "</table>";
                echo "<p>Tổng thanh toán: " . number_format($totalPayment) . " đ</p>";
                // Đóng kết nối CSDL
                $conn->close();
            } else {
                echo "Không có sản phẩm trong giỏ hàng";
            }
            ?>
        </div>
    </div>
    <input class="btn_checkout" name = "btn_checkout" type="submit" value="Đặt Hàng">
</form>