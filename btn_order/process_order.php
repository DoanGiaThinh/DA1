<title>Xác nhận đơn hàng</title>
<link rel="stylesheet" href="../fontawesome/fontawesome6.4.2/css/all.css">
<link rel="stylesheet" href="process_order.css">
<a id="tieptucmuasam" href="../customer/index_user.php">Tiếp tục mua</a>
<?php
session_start();
include("../connect.php");

if (isset($_POST['btn_checkout'])) {
  // Lấy thông tin khách hàng từ form
  $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
  $email = $_POST['Email'];
  $diachi = $_POST['address'] . ', ' . $_POST['ward'] . ', ' . $_POST['district'] . ', ' . $_POST['city'];
  $sodienthoai = $_POST['sodienthoai'];

  // Thêm thông tin khách hàng vào bảng khachhang
  $sql_insert_customer = "INSERT INTO khachhang (tenkhachhang, diachi, sodienthoai, email)
                          VALUES ('$name', '$diachi', '$sodienthoai', '$email')";
  mysqli_query($conn, $sql_insert_customer);

  // Lấy thông tin đơn hàng 
  $totalPayment = $_SESSION["totalPayment"]+25000;
  $payment = $_POST['payment'];
  // Thêm thông tin đơn hàng vào bảng donhang
  $sql_insert_order = "INSERT INTO donhang (makhachhang, ngaydathang, tonggia, phuongthucthanhtoan)
                          VALUES ((SELECT makhachhang FROM khachhang ORDER BY makhachhang DESC LIMIT 1), CURDATE(), '$totalPayment', '$payment')";
  mysqli_query($conn, $sql_insert_order);
  // Chi tiết đơn
  if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $tenmon_array = []; 
    // Mảng để lưu trữ các tên món
  
    foreach ($cart as $productId => $quantity) {
      // Thực hiện truy vấn INSERT cho từng món hàng
      $sql_insert_detail = "INSERT INTO chitietdonhang (madonhang, mamon, soluong)
                            VALUES ((SELECT madonhang FROM donhang ORDER BY madonhang DESC LIMIT 1), (SELECT mamon FROM mon WHERE tenmon = '$productId'), '$quantity')";
      mysqli_query($conn, $sql_insert_detail);
  
      // Lấy tên món từ cơ sở dữ liệu
      $sql_get_product_name = "SELECT tenmon FROM mon WHERE tenmon = '$productId'";
      $result = mysqli_query($conn, $sql_get_product_name);
      $row = mysqli_fetch_assoc($result);
      $tenmon = $row['tenmon'];
  
      // Thêm tên món vào mảng
      $tenmon_array[] = $tenmon;
    }
  
    // Chuyển mảng thành một chuỗi
    $tenmon_inline = implode(', ', $tenmon_array);
  
    session_unset();
    session_destroy();
  }
// Lấy mã đơn hàng vừa tạo
$result = mysqli_query($conn, "SELECT madonhang FROM donhang ORDER BY madonhang DESC LIMIT 1");
$row = mysqli_fetch_assoc($result);
$orderId = $row['madonhang'];

// Hiển thị thông tin đơn hàng
echo '<h1 class="success-message">Đặt hàng thành công!</h1>';
echo '
  <div class="container">
    <div class="order-info">
      <p><b>Mã đơn hàng: </b>' . $orderId . '</p>
      <p><b>Tên khách hàng: </b>' . $name . '</p>
      <p><b>Email: </b>' . $email . '</p>
      <p><b>Địa chỉ: </b>' . $diachi . '</p>
      <p><b>Số điện thoại: </b>' . $sodienthoai . '</p>
      <p><b>Tên Món: </b>' . $tenmon_inline . '</p>
      <p id="tongGia"><b>Tổng giá: </b>' . number_format($totalPayment) .' VNĐ'. '</p>
      <p><b>Phương thức thanh toán: </b> ' . $payment . '</p>
    </div>
  </div>';
echo '<div class="edit-link">
      <a class="edit_info" href="edit_order.php?id=' . $orderId . '">Thay đổi thông tin cá nhân</a>
      </div>';
}
?>

