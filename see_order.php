<?php
include "connect.php";
?>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php
// Kiểm tra kết nối cơ sở dữ liệu
if ($conn) {
    // Tạo câu truy vấn SELECT để lấy dữ liệu từ bảng DONHANG
    $select_query = "SELECT * FROM DONHANG";

    // Thực hiện câu truy vấn
    $result = $conn->query($select_query);

    if ($result) {
        // Kiểm tra số dòng dữ liệu trả về
        if ($result->num_rows > 0) {
            echo '<table class="table table-info">';
            echo "<tr><th>Mã đơn hàng</th><th>Mã khách hàng</th><th>Ngày đặt hàng</th><th>Tổng giá</th></tr>";

            // Lặp qua từng dòng dữ liệu
            while ($row = $result->fetch_assoc()) {
                $madonhang = $row['madonhang'];
                $makhachhang = $row['makhachhang'];
                $ngaydathang = $row['ngaydathang'];
                $tonggia = $row['tonggia'];

                // Hiển thị dữ liệu trong từng ô của bảng
                echo "<tr>";
                echo "<td>$madonhang</td>";
                echo "<td>$makhachhang</td>";
                echo "<td>$ngaydathang</td>";
                echo "<td>$tonggia</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Không có dữ liệu đơn hàng.";
        }

        // Giải phóng bộ nhớ sau khi sử dụng kết quả truy vấn
        $result->free();
    } else {
        echo "Lỗi khi truy vấn dữ liệu: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Lỗi kết nối cơ sở dữ liệu.";
}
?>
<style>
    td, tr, table, th {
        text-align: center;
        border: 1px black solid;
        border-collapse: collapse;
        width: 800px;
        margin: 100px auto;
    }
</style>