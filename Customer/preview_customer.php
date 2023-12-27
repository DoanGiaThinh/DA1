<link rel="stylesheet" href="preview_customer.css">
<a id="tieptucmuasam" href="../customer/index_user.php"><i class="fa-solid fa-left-long"></i>Tiếp tục mua</a>
<?php

include("../connect.php");

$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
} elseif (isset($_SESSION['search'])) {
    $search = $_SESSION['search']; // Lấy giá trị tìm kiếm từ biến session
}

if (!empty($search)) {
    $sql = "SELECT dh.madonhang, kh.tenkhachhang, kh.diachi, kh.sodienthoai, GROUP_CONCAT(m.tenmon SEPARATOR ', ') AS tenmon, ctd.soluong, dh.tonggia, dh.phuongthucthanhtoan, dh.ngaydathang, dh.trangthai
            FROM chitietdonhang ctd, donhang dh, mon m, khachhang kh 
            WHERE ctd.madonhang = dh.madonhang 
            AND ctd.mamon = m.mamon 
            AND dh.makhachhang = kh.makhachhang 
            AND (dh.madonhang LIKE '%$search%' OR kh.sodienthoai LIKE '%$search%')
            GROUP BY dh.madonhang";
    $result = mysqli_query($conn, $sql);

    $searchResults = '';

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $madonhang = $row["madonhang"];
            $tenkhachhang = $row["tenkhachhang"];
            $diachi = $row["diachi"];
            $sodienthoai = $row["sodienthoai"];
            $tenmon = $row["tenmon"];
            $tonggia = $row["tonggia"];
            $pttt = $row["phuongthucthanhtoan"];
            $ngaydathang = $row["ngaydathang"];
            $trangthai = $row["trangthai"];

            $searchResults .= '<h1 class="success-message">Đơn Hàng Của ' . $tenkhachhang . '</h1>';
            $searchResults .= '<div class="container">';
            $searchResults .= '<div class="preview_info">';
            $searchResults .= '<p><b>Mã Đơn Hàng:</b> ' . $madonhang . '</p>';
            $searchResults .= '<p><b>Tên Khách Hàng:</b> ' . $tenkhachhang . '</p>';
            $searchResults .= '<p><b>Địa Chỉ:</b> ' . $diachi . '</p>';
            $searchResults .= '<p><b>Số Điện Thoại:</b> ' . $sodienthoai . '</p>';
            $searchResults .= '<p><b>Tên Món:</b> ' . $tenmon . '</p>';
            $searchResults .= '<p class="total-price"><b>Tổng Giá:</b> ' . number_format($tonggia) . ' VNĐ</p>';
            $searchResults .= '<p><b>Phương Thức Thanh Toán:</b> ' . $pttt . '</p>';
            $searchResults .= '<p><b>Ngày Đặt Hàng:</b> ' . $ngaydathang . '</p>';
            $searchResults .= '<p><b>Trạng Thái Đơn:</b> ' . $trangthai . '</p>';
            $searchResults .= '</div>';
            $searchResults .= '</div>';
        }

    } else {
        $searchResults = "Không tìm thấy";
    }

    // Lưu kết quả tìm kiếm vào biến session
    $_SESSION['searchResults'] = $searchResults;

    // Hiển thị kết quả tìm kiếm
    echo '<div class="search-results">' . $searchResults . '</div>';
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCD+0kP