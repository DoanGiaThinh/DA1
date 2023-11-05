
<?php

if (isset($_POST['search'])) {
    $search = $_POST['search'];


} elseif (isset($_SESSION['search'])) {
    $search = $_SESSION['search']; // Lấy giá trị tìm kiếm từ biến session
} else {
    $search = ""; // Nếu không có giá trị tìm kiếm thì mặc định là rỗng
}

if (isset($search)) {
    $sql = "SELECT * FROM donhang WHERE madonhang LIKE '%$search%' OR ngaydathang LIKE '%$search%' OR trangthai LIKE '%$search%'";
    $result = $conn->query($sql);

    $searchResults = '';

    if ($result->num_rows > 0) {
        $i=1;
        while ($row = mysqli_fetch_assoc($result)) {
            
            $orderId = $row["madonhang"];
            $customerId = $row["makhachhang"];
            $ngaydathang = $row["ngaydathang"];
            $totalPrice = $row["tonggia"];
            $pttt = $row["phuongthucthanhtoan"];
            $trangthai = $row["trangthai"];
            
        
            $searchResults .= '<tr>';
            $searchResults .= '<td>'. $i .'</td>';
            $searchResults .= '<td>' . $orderId . '</td>';
            $searchResults .= '<td>' . $customerId . '</td>';
            $searchResults .= '<td>' . $ngaydathang . '</td>';
            $searchResults .= '<td>' . $totalPrice . '</td>';
            $searchResults .= '<td>' . $pttt . '</td>';
            $searchResults .= '<td>' . $trangthai. '</td>';
            $searchResults .= '</tr>';
        $i++;
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<style>
    .search-text{
        width: 400px;
    }
    .search-form{
        margin: auto;
    }
    .search-btn{
        margin-left: -38px;
    }
</style>