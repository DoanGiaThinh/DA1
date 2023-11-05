
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

<h1>Quản lý đơn hàng</h1>
<table>
    <tr>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Tổng giá</th>
        <th>Phương thức thanh toán</th>
        <th>Trạng thái</th>
        <th></th>
    </tr>
    <?php
    // Hiển thị kết quả truy vấn
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


<style>
    table {
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .empty-row {
        text-align: center;
        font-style: italic;
        color: gray;
    }

    form {
        display: inline-block;
        margin-right: 5px;
    }

    select {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    button {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
    .table_price{
        width: 150px;
    }
</style>