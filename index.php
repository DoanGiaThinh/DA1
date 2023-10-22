<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

// Kiểm tra kết nối
if (mysqli_connect_errno()) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

// Xử lý tìm kiếm
if (isset($_GET['search_term'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search_term']);
    $searchPattern = "%$searchTerm%";

    // Truy vấn cơ sở dữ liệu sử dụng Prepared Statements
    $query = "SELECT * FROM mon WHERE tenmon LIKE ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $searchPattern);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) > 0) {
        // Hiển thị kết quả
        while ($row = mysqli_fetch_assoc($result)) {
            // Xử lý dữ liệu
            $resultData = $row['mamon'] . $row['tenmon'];
            // Hiển thị thông tin tìm kiếm
            echo "<p>" . htmlspecialchars($resultData) . "</p>";
        }
    } else {
        echo "Không tìm thấy kết quả.";
    }

    // Giải phóng bộ nhớ sau khi sử dụng kết quả truy vấn
    mysqli_stmt_close($stmt);
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="header">
        <a href="#">Về Trang Chủ</a>
        <h2>Quản Lý Đơn Hàng</h2>
    </div>
    <div class="container">


       

        <select id="selectOption">
            <option value="khachhang">Khách hàng</option>
            <option value="sanpham">Sản phẩm</option>
        </select>
        



    </div>
</body>

</html>