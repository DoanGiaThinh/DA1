
<?php
session_start();
include("../connect.php");

// Kiểm tra có thông tin đơn hàng trong session hay không
if (!isset($_SESSION['order_id'])) {
    // Nếu không có thông tin đơn hàng, chuyển hướng người dùng về trang chủ hoặc một trang thông báo lỗi
    header("Location: index.php");
    exit();
}

// Lấy mã đơn hàng từ session
$orderID = $_SESSION['order_id'];

// Truy vấn thông tin đơn hàng từ cơ sở dữ liệu
$sql_order = "SELECT * FROM donhang WHERE madonhang = '$orderID'";
$result_order = mysqli_query($conn, $sql_order);
$order = mysqli_fetch_assoc($result_order);

// Truy vấn thông tin khách hàng từ cơ sở dữ liệu
$sql_customer = "SELECT * FROM khachhang WHERE makhachhang = '{$order['makhachhang']}'";
$result_customer = mysqli_query($conn, $sql_customer);
$customer = mysqli_fetch_assoc($result_customer);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Xác nhận đơn hàng</title>
</head>

<body>
    <h1>Xác nhận đơn hàng thành công</h1>

    <h2>Thông tin đơn hàng</h2>
    <p>Mã đơn hàng: <?php echo $order['madonhang']; ?></p>
    <p>Ngày đặt hàng: <?php echo $order['ngaydathang']; ?></p>
    <p>Tổng giá trị: <?php echo $order['tonggia']; ?></p>

    <h2>Thông tin khách hàng</h2>
    <p>Tên khách hàng: <?php echo $customer['tenkhachhang']; ?></p>
    <p>Địa chỉ: <?php echo $customer['diachi']; ?></p>
    <p>Số điện thoại: <?php echo $customer['sodienthoai']; ?></p>
    <p>Email: <?php echo $customer['email']; ?></p>

    <!-- Hiển thị thông tin đơn hàng chi tiết nếu cần -->

</body>

</html>
