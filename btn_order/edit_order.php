<link rel="stylesheet" href="edit_order.css">
<link rel="stylesheet" href="../fontawesome/fontawesome6.4.2/css/all.css">
<a id="tieptucmuasam" href="../customer/index_user.php"><i class="fa-solid fa-left-long"></i>Tiếp tục mua</a>
<?php
session_start();
include("../connect.php");

if (isset($_GET['id'])) {
  $orderId = $_GET['id'];

  // Kiểm tra xem đơn hàng tồn tại trong cơ sở dữ liệu hay không
  $sql_check_order = "SELECT * FROM khachhang kh, donhang dh WHERE kh.makhachhang = dh.makhachhang and dh.madonhang ='$orderId'";
  $result = mysqli_query($conn, $sql_check_order);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['tenkhachhang'];
    $email = $row['email'];
    $diachi = $row['diachi'];
    $sodienthoai = $row['sodienthoai'];
    $totalPayment = $row['tonggia'];
    $payment = $row['phuongthucthanhtoan'];
  } else {
    echo "Đơn hàng không tồn tại.";
    exit;
  }
} else {
  echo "Mã đơn hàng không được cung cấp.";
  exit;
}
$sql = "SELECT makhachhang FROM donhang WHERE madonhang ='$orderId'";
$result = mysqli_query($conn, $sql);
if (isset($_POST['btn_update'])) {
  
  $this_id = $row['makhachhang'];
  $tenkhachhang = $_POST['tenkhachhang'];
  $diachi = $_POST['diachi'];
  $email = $_POST['email'];
  $sodienthoai = $_POST['sodienthoai'];

  $sql = "UPDATE khachhang SET tenkhachhang='$tenkhachhang', diachi='$diachi', email='$email', sodienthoai='$sodienthoai' WHERE makhachhang = '".$this_id."'";
  mysqli_query($conn, $sql);

  echo '<h1 class="success-message">Cập nhật thông tin thành công!</h1>';
  echo '
  <div class="container">
    <div class="order-info">
      <p><b>Mã đơn hàng: </b>' . $orderId . '</p>
      <p><b>Tên khách hàng: </b>' . $tenkhachhang . '</p>
      <p><b>Email: </b>' . $email . '</p>
      <p><b>Địa chỉ: </b>' . $diachi . '</p>
      <p><b>Số điện thoại: </b>' . $sodienthoai . '</p>
      <p class="total-price"><b>Tổng Thanh Toán: </b>' . number_format($totalPayment) .' VNĐ'. '</p>
      <p><b>Phương thức thanh toán: </b> ' . $payment . '</p>
    </div>
  </div>';
  exit();
}
?>

<h1>Sửa thông tin khách hàng: <?php echo $row['tenkhachhang']; ?></h1>

<form method="post" enctype="multipart/form-data">
    <p>Tên khách hàng</p>
    <input type="text" name="tenkhachhang" id="customer-name" required value="<?php echo $row['tenkhachhang']; ?>"><br>

    <p>Địa chỉ</p>
    <input type="text" name="diachi" id="address" required value="<?php echo $row['diachi']; ?>"><br>

    <p>Email</p>
    <input type="text" name="email" value="<?php echo $row['email']; ?>">

    <p>Số điện thoại</p>
    <input type="text" name="sodienthoai" value="<?php echo $row['sodienthoai']; ?>">
    <br><br>
    <button type="submit" name="btn_update">Sửa</button>
</form>
