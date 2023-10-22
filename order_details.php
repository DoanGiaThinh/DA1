<?php
include "connect.php";

// Lấy dữ liệu từ bảng MON
$select_mon_query = "SELECT mamon, soluong FROM MON";
$result_mon = $conn->query($select_mon_query);

// Lấy dữ liệu từ bảng DONHANG
$select_donhang_query = "SELECT madonhang FROM DONHANG";
$result_donhang = $conn->query($select_donhang_query);

if ($result_mon->num_rows > 0 && $result_donhang->num_rows > 0) {
    // Lặp qua từng dòng dữ liệu trong bảng MON
    while ($row_mon = $result_mon->fetch_assoc()) {
        $mamon = $row_mon['mamon'];
        $soluong = $row_mon['soluong'];

        // Lặp qua từng dòng dữ liệu trong bảng DONHANG
        while ($row_donhang = $result_donhang->fetch_assoc()) {
            $madonhang = $row_donhang['madonhang'];

            // Thực hiện INSERT vào bảng CHITIETDONHANG
            $insert_query = "INSERT INTO CHITIETDONHANG (madonhang, mamon, soluong) VALUES ('$madonhang', '$mamon', $soluong)";
            if ($conn->query($insert_query) === TRUE) {
                echo "Thêm dữ liệu vào bảng CHITIETDONHANG thành công!";
            } else {
                echo "Lỗi khi thêm dữ liệu vào bảng CHITIETDONHANG: " . $conn->error;
            }
        }

        // Đặt con trỏ về đầu kết quả của bảng DONHANG
        $result_donhang->data_seek(0);
    }
} else {
    echo "Không có dữ liệu trong bảng MON hoặc DONHANG";
}

// Đóng kết nối
$conn->close();
?>