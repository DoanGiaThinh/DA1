<?php
include "connect.php";

$this_id = $_GET['this_id'];

$sql = "SELECT * FROM khachhang WHERE makhachhang = '".$this_id."'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

if (isset($_POST['btn'])) {
    $tenkhachhang = $_POST['tenkhachhang'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $sdt = $_POST['sodienthoai'];

    $sql = "UPDATE khachhang SET tenkhachhang='$tenkhachhang', diachi='$diachi', email='$email', sodienthoai='$sdt' WHERE makhachhang = '".$this_id."'";
    mysqli_query($conn, $sql);

    header('location: customer.php');
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
    <button type="submit" name="btn">Sửa</button>
</form>