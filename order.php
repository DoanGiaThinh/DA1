<?php
    include("connect.php");
?>

<?php
    // Câu truy vấn SQL
    $sql = "SELECT * FROM donhang";
    $result = $conn->query($sql);

    echo "<table class='my-table'>";
    echo "<tr> 
            <th class='my-header'>Mã Đơn Hàng</th>
            <th class='my-header'>Mã Khách Hàng</th>
            <th class='my-header'>Ngày Đặt Hàng</th>
            <th class='my-header'>Tổng Giá</th>
            <th class='my-header'>Phương Thức Thanh Toán</th>
            <th class='my-header'>Trạng Thái</th>
        </tr>";

    if ($result->num_rows > 0) {
        // Duyệt qua từng hàng kết quả
        while ($row = $result->fetch_assoc()) {
            $madonhang = $row['madonhang'];
            $makhachhang = $row['makhachhang'];
            $ngaydathang = $row['ngaydathang'];
            $tonggia = $row['tonggia'];
            $pttt = $row['phuongthucthanhtoan'];
            $trangthai = $row['trangthai'];

            // Xử lý dữ liệu ở đây
            echo "<tr>";
                echo "<td>$madonhang</td>";
                echo "<td>$makhachhang</td>";
                echo "<td>$ngaydathang</td>";
                echo "<td>".number_format($tonggia)."</td>";
                echo "<td>$pttt</td>";
                echo "<td>$trangthai</td>";
            echo "</tr>";
        }
    } else {
        echo "Không có kết quả.";
    }
    echo "</table>";

    $conn->close();
?>

<style>
    table.my-table {
        flex: 12;
        border-collapse: collapse;
    }

    th.my-header {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
        background-color: #f2f2f2;
    }

    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>