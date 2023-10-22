<?php
include "connect.php";

// Kiểm tra kết nối cơ sở dữ liệu
if ($conn) {
    // Tạo câu truy vấn để tìm mã đơn hàng mới
    $query = "SELECT IFNULL(MAX(CAST(SUBSTRING(madonhang, 3) AS SIGNED)), 0) + 1 AS next_id FROM DONHANG";

    // Thực hiện câu truy vấn
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $next_id = $row['next_id'];

        // Chèn thông tin đơn hàng mới vào bảng DONHANG
        $ngaydathang = date("Y-m-d"); // Lấy ngày hiện tại
        $tonggia = 0.0; // Thay thế bằng tổng giá đơn hàng thực tế

        $new_madonhang = "DH" . str_pad($next_id, 4, "0", STR_PAD_LEFT); // Tạo mã đơn hàng mới

        // Lấy thông tin makhachhang từ bảng khachhang
        $select_makhachhang_query = "SELECT makhachhang FROM khachhang";
        $result_makhachhang = $conn->query($select_makhachhang_query);
        if ($result_makhachhang->num_rows > 0) {
            $row_makhachhang = $result_makhachhang->fetch_assoc();
            $makhachhang = $row_makhachhang['makhachhang'];

            $insert_query = "INSERT INTO DONHANG (madonhang, makhachhang, ngaydathang, tonggia) VALUES ('$new_madonhang', '$makhachhang', '$ngaydathang', $tonggia)";

            if ($conn->query($insert_query) === TRUE) {
                echo "Đã thêm đơn hàng mới thành công. Mã đơn hàng mới là: $new_madonhang";
            } else {
                echo "Lỗi khi thêm đơn hàng mới: " . $conn->error;
            }
        } else {
            echo "Không có dữ liệu khách hàng.";
        }

        // Giải phóng bộ nhớ sau khi sử dụng kết quả truy vấn
        $result_makhachhang->free();
    } else {
        echo "Lỗi khi tìm mã đơn hàng mới: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Lỗi kết nối cơ sở dữ liệu.";
}
?>
