<!DOCTYPE html>
<html>
<head>
  <title>Chi tiết sản phẩm</title>
</head>
<body>
  <?php
  include "../connect.php";

  if (isset($_GET['id'])) {
      $selectedProductId = $_GET['id'];

      // Lấy thông tin sản phẩm được chọn từ CSDL
      $sql = "SELECT anh, tenmon, gia, soluong FROM mon WHERE tenmon = '$selectedProductId'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $anh = $row["anh"];
          $tenmon = $row["tenmon"];
          $gia = $row["gia"];
          $soluong = $row["soluong"];

          // Xác định trạng thái hàng
          if ($soluong >= 1) {
              $trangthai = "còn";
          } else {
              $trangthai = "hết";
          }

          // Hiển thị chi tiết sản phẩm
          echo '<h1>Chi tiết sản phẩm</h1>';
          echo '<div class="product_detail">';
          echo '<div class="product_image"><img src="../img/SanPham/' . $anh . '"></div>';
          echo '<div class="name_price">
                <div class="product_name"><p>' . $tenmon . '</p> </div>
                <div class="product_price"><span>' . $gia .' đ</span></div>;
                </div>';
          

          // Kiểm tra trạng thái hàng
          if ($trangthai == 'còn') {
              echo '<div class="titon">
                    <div class="quantity">';
              echo '<label for="quantity">Số lượng:</label>';
              echo '<button id="decrement">-</button>';
              echo '<input type="number" id="quantity" name="quantity" value="1" min="1">';
              echo '<button id="increment">+</button>';
              echo '</div>'.'<button id="addToCart">Thêm vào giỏ hàng</button>'
                    .'</div>';
          } else {
              echo '<div class="out-of-stock">Hết hàng</div>';
          }

          echo '</div>';
      } else {
          echo 'Không tìm thấy sản phẩm.';
      }
  } else {
      echo 'Không có sản phẩm được chọn.';
  }
  ?>

  <script>
    const quantityInput = document.getElementById("quantity");
    const decrementButton = document.getElementById("decrement");
    const incrementButton = document.getElementById("increment");
    const addToCartButton = document.getElementById("addToCart");

    let quantity = parseInt(quantityInput.value);

    decrementButton.addEventListener("click", function () {
      if (quantity > 1) {
        quantity--;
        quantityInput.value = quantity;
      }
    });

    incrementButton.addEventListener("click", function () {
      quantity++;
      quantityInput.value = quantity;
    });

    quantityInput.addEventListener("change", function () {
      quantity = parseInt(quantityInput.value);
    });

    addToCartButton.addEventListener("click", function () {
      if (quantity >= 1) {
        alert("Sản phẩm đã được thêm vào giỏ hàng.");
      } else {
        alert("Số lượng không hợp lệ.");
      }
    });
  </script>
</body>
</html>

<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f1f1f1;
}

h1 {
  text-align: center;
  margin-top: 20px;
}

.product_detail {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  text-align: center;
  background-color: #ffffff;
  padding: 20px;
}

.product_detail .product_image img {
  width: 300px;
  height: 300px;
  object-fit: cover;
  border-radius: 5px;
  margin-bottom: 10px;
}

.product_detail .product_name {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 5px;
}

.product_detail .product_price {
  font-size: 18px;
  color: red;
}

.quantity {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.quantity input {
  width: 50px;
  text-align: center;
  padding: 5px;
  font-size: 16px;
}



.quantity button:hover {
  background-color: #45a049;
}

.out-of-stock {
  font-size: 18px;
  color: red;
  margin-top: 10px;
}

#addToCart {
  background-color: #2196f3;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 18px;
  cursor: pointer;
  margin-top: 10px;
}

#addToCart:hover {
  background-color: #0b7dda;
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f1f1f1;
}

h1 {
  text-align: center;
  margin-top: 20px;
}

.product_detail {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  text-align: center;
  background-color: #ffffff;
  padding: 20px;
}

.product_detail .product_image img {
  width: 300px;
  height: 300px;
  object-fit: cover;
  border-radius: 5px;
  margin-bottom: 10px;
}

.product_detail .product_name {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 5px;
}

.product_detail .product_price {
  font-size: 18px;
  color: red;
}

.quantity {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.quantity input {
  width: 50px;
  text-align: center;
  padding: 5px;
  font-size: 16px;
}

.quantity button {
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  font-size: 16px;
  cursor: pointer;
  margin: 0 5px;
}

.quantity button:hover {
  background-color: #45a049;
}

.out-of-stock {
  font-size: 18px;
  color: red;
  margin-top: 10px;
}

#addToCart {
  background-color: #2196f3;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 18px;
  cursor: pointer;
  margin-top: 10px;
}

#addToCart:hover {
  background-color: #0b7dda;
}
</style>