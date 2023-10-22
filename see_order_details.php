<?php
include "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <?php
    // Lấy dữ liệu từ bảng CHITIETDONHANG
    $select_chitiet_query = "SELECT * FROM CHITIETDONHANG";
    $result_chitiet = $conn->query($select_chitiet_query);

    if ($result_chitiet->num_rows > 0) {
        echo '<table class="table table-warning">';
        echo "<tr><th>Mã đơn hàng</th><th>Mã món</th><th>Số lượng</th></tr>";

        // Lặp qua từng dòng dữ liệu
        while ($row_chitiet = $result_chitiet->fetch_assoc()) {
            $madonhang = $row_chitiet['madonhang'];
            $mamon = $row_chitiet['mamon'];
            $soluong = $row_chitiet['soluong'];

            // Hiển thị dữ liệu trong từng ô của bảng
            echo "<tr>";
            echo "<td>$madonhang</td>";
            echo "<td>$mamon</td>";
            echo "<td>$soluong</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Không có dữ liệu trong bảng CHITIETDONHANG";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>
<style>
    td, tr, table, th {
        text-align: center;
        border: 1px black solid;
        border-collapse: collapse;
        width: 800px;
        margin: 100px auto;
    }
</style>