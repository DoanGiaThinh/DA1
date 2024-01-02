<title>Trang Shipper</title>
<?php
include("../connect.php");

// Truy vấn cơ sở dữ liệu
$sql = "SELECT dh.madonhang, kh.tenkhachhang, kh.sodienthoai, kh.diachi, dh.tonggia, dh.phuongthucthanhtoan, dh.trangthai 
        FROM donhang dh, khachhang kh 
        WHERE dh.makhachhang = kh.makhachhang";
$result = $conn->query($sql);

// Xử lý yêu cầu cập nhật trạng thái đơn hàng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $madonhang = $_POST["madonhang"];
    $trangthai = $_POST["trangthai"];

    // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
    $updateSql = "UPDATE donhang SET trangthai = '$trangthai' WHERE madonhang = '$madonhang'";
    if ($conn->query($updateSql) === true) {
        echo "Cập nhật trạng thái đơn hàng thành công.";
        header("Refresh:0");
    } else {
        echo "Cập nhật trạng thái đơn hàng thất bại: " . $conn->error;
    }
}
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $hello = $_SESSION['user'];
?>

<link rel="stylesheet" href="shipper.css">
<div class="logout_sp">
    <i><div class="hello"><?php echo "Xin chào ". $hello ."!"?></div></i>
    <a  class="text-logout" href="../logout.php"><div>Đăng Xuất</div></a>
</div>
<h1>Quản lý đơn hàng</h1>
<table>
    <tr>
        <th style="width: 52px;">Mã ĐH</th>
        <th>Tên KH</th>
        <th>SĐT</th>
        <th>Địa chỉ</th>
        <th>Tổng giá</th>
        <th style="width: 84px;">Thanh Toán</th>
        <th style="width: 74px;">Trạng thái</th>
        <th style="width: 152px;"></th>
    </tr>
    <?php
    $num = mysqli_num_rows($result);
    $numPages = 6;
    $totalPage = ceil($num/$numPages);
    echo '<div class="my_page">';
    for($btn = 1; $btn <= $totalPage; $btn++){
        echo '<a href="?page=shipper&npage='.$btn.'"><button class="my_button">'.$btn.'</button></a>';
    }
    echo '</div>';
    if(isset($_GET['npage'])){
        $npage = $_GET['npage'];
    }
    else{
        $npage = 1;
    }
    $startinglimit= ($npage - 1)*$numPages;
    $sql = "SELECT dh.madonhang, kh.tenkhachhang, kh.sodienthoai, kh.diachi, dh.tonggia, dh.phuongthucthanhtoan, dh.trangthai 
            FROM donhang dh, khachhang kh 
            WHERE dh.makhachhang = kh.makhachhang limit ".$startinglimit.','.$numPages;
    $result = mysqli_query($conn, $sql);
    // Hiển thị kếtquả truy vấn
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["madonhang"] . "</td>";
            echo "<td>" . $row["tenkhachhang"] . "</td>";
            echo "<td>" . $row["sodienthoai"] . "</td>";
            echo "<td>" . $row["diachi"] . "</td>";
            echo "<td class='table_price'>" . number_format($row["tonggia"]) ." đ". "</td>";
            echo "<td>" . $row["phuongthucthanhtoan"] . "</td>";
            echo "<td>" . $row["trangthai"] . "</td>";
            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='madonhang' value='" . $row["madonhang"] . "'>
                        <select name='trangthai'>
                            <option value='Đang xử lý'>Đang xử lý</option>
                            <option value='Đang giao'>Đang giao</option>
                            <option value='Đã giao'>Đã giao</option>
                            <option value='Đã hủy'>Đã hủy</option>
                        </select>
                        <button type='submit'>Lưu</button>
                    </form>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Không có dữ liệu đơn hàng</td></tr>";
    }
    ?>
</table>
<?php
} else {
    header('location: login.php');
}
?>