<?php
include "../connect.php";
session_start();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $_SESSION['search'] = $search; // Lưu giá trị tìm kiếm vào biến session
} elseif (isset($_SESSION['search'])) {
    $search = $_SESSION['search']; // Lấy giá trị tìm kiếm từ biến session
} else {
    $search = ""; // Nếu không có giá trị tìm kiếm thì mặc định là rỗng
}

if (!empty($search)) {
    $sql = "SELECT * FROM mon WHERE tenmon LIKE '%$search%'";
    $result = $conn->query($sql);

    $searchResults = '';

    if ($result->num_rows > 0) {
        $searchResults .= '<ul class="product-row1">';

        while ($row = mysqli_fetch_assoc($result)) {
            $tenmon = $row["tenmon"];
            $gia = $row["gia"];

            $searchResults .= '<li class="product content2-product">';
            $searchResults .= '<img width="185" height="185" src="../img/SanPham/' . $row['anh'] . '">';
            $searchResults .= '<p class="product_name">' . $tenmon . '</p>';
            $searchResults .= '<span class="content2-cost__title product_price">' . number_format($gia) . ' <sub> đ </sub>' . '</span>';
            $searchResults .= '</li>';
        }

        $searchResults .= '</ul>';
    } else {
        $searchResults = "Không tìm thấy sản phẩm nào.";
    }

    // Lưu kết quả tìm kiếm vào biến session
    $_SESSION['searchResults'] = $searchResults;

    // Hiển thị kết quả tìm kiếm
    echo '<div class="search-results">' . $searchResults . '</div>';
}
?>

<script>
    // Sử dụng JavaScript để thay thế sản phẩm hiện có bằng kết quả tìm kiếm
    window.onload = function() {
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_RELOAD) {
            var searchResults = "<?php echo $_SESSION['searchResults']; ?>";
            if (searchResults !== "") {
                var productList = document.querySelector('.product-list');
                productList.innerHTML = searchResults;
            }
        }
    }
</script>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .product {
        height: 290px;
        max-width: 185px;
    }

    .product_name {
        font-size: 14px;
        line-height: 20px;
        font: message-box;
        min-height: 60px;
    }

    .product_price {
        color: red;
        font-weight: bold;
        font-size: 20px;
    }
</style>