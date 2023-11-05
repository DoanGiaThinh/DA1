<link rel="stylesheet" href="../fontawesome/fontawesome6.4.2/css/all.css">
<?php
include "../connect.php";

session_start(); // Khởi động phiên làm việc để sử dụng session

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
        $trangthai = ($soluong >= 1) ? "còn" : "hết";

        // Hiển thị chi tiết sản phẩm
        
        echo '<div class="title_product_detail">
        <div><a id="tieptucmua" href="../customer/index_user.php"><i class="fa-solid fa-left-long"></i>Tiếp Tục Mua</a></div>
        <span class="mid_title">Chi tiết sản phẩm</span>';
        echo '<a href="cart.php" class="see_cart"><i class="fa-solid fa-cart-shopping"></i></a>';
        echo '</div>';
        echo '<div class="product_detail">';
        echo '<div class="product_image"><img src="../img/SanPham/' . $anh . '"></div>';
        echo '<div class="name_price">
              <div class="product_name"><p>' . $tenmon . '</p> </div>
              <div class="product_price"><span>' . number_format($gia) .' đ</span></div>';

        // Kiểm tra trạng thái hàng
        if ($trangthai == 'còn') {
          echo '<div class="titon">';
          echo '<div class="quantity">';
          echo '<label for="quantity">Số lượng:</label>';
          echo '<button id="decrement">-</button>';
          echo '<input type="number" id="quantity" name="quantity" value="1" min="1">';
          echo '<button id="increment">+</button>';
          echo '</div>';
          echo '<div class="btn_gr">';
          echo '<button id="addToCart">Thêm vào giỏ hàng</button>';
          echo '</div>';
          echo '</div>';
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

<link rel="stylesheet" href="product_detail.css">
<script>
  const quantityInput = document.getElementById("quantity");
  const decrementButton = document.getElementById("decrement");
  const incrementButton = document.getElementById("increment");
  const addToCartButton = document.getElementById("addToCart");

  decrementButton.addEventListener("click", function () {
    let quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
      quantity--;
      quantityInput.value = quantity;
    }
  });

  incrementButton.addEventListener("click", function () {
    let quantity = parseInt(quantityInput.value);
    quantity++;
    quantityInput.value = quantity;
  });

  // Kiểm tra xem giỏ hàng đã có sản phẩm hay chưa
function checkCart(productId) {
  if (localStorage.getItem("cart")) {
    let cart = JSON.parse(localStorage.getItem("cart"));

    if (cart.hasOwnProperty(productId)) {
      return cart[productId];
    }
  }

  return 0;
}
// Cập nhật số lượng sản phẩm trong giỏ hàng
function updateCart(productId, quantity) {
  let cart = {};

  if (localStorage.getItem("cart")) {
    cart = JSON.parse(localStorage.getItem("cart"));
  }

  cart[productId] = quantity;
  localStorage.setItem("cart", JSON.stringify(cart));
}

// Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng khi nhấn nút "Thêm vào giỏ hàng"
addToCartButton.addEventListener("click", function () {
  let quantity = parseInt(quantityInput.value);
  if (quantity >= 1) {
    let productId = '<?php echo $selectedProductId; ?>';

  // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
  let existingQuantity = checkCart(productId);

  // Cộng số lượng mới với số lượng hiện có trong giỏ hàng
  let updatedQuantity = existingQuantity + quantity;

  // Cập nhật số lượng sản phẩm trong giỏ hàng
  updateCart(productId, updatedQuantity);

    // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_cart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Xử lý phản hồi từ server (nếu cần)
        alert(xhr.responseText);
      }
    };
    xhr.send("productId=" + productId + "&quantity=" + quantity);
  } else {
    // Hiển thị thông báo không hợp lệ nếu số lượng sản phẩm không hợp lệ
    alert("Số lượng sản phẩm không hợp lệ.");
  }
});
  
</script>