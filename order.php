<?php
    include("connect.php");
?>
<div class="contain">
    <div class="header-table">
        <form class="search-form" method="post" action="http://localhost/DA1/index.php?page=order">
            <input type="text" name="search" class="search-text" placeholder="Nhập Mã Đơn, Ngày đặt, Trạng thái">
            <input class="search-btn" type="submit" value="Tìm Đơn">
        </form>
    </div>
    <?php
        // Câu truy vấn SQL
        $sql = "SELECT * FROM donhang";
        $result = $conn->query($sql);

        echo "<table class='my-table'>";
        echo "<tr> 
                <th class='my-header stt'>STT</th>
                <th class='my-header'>Mã Đơn Hàng</th>
                <th class='my-header'>Mã Khách Hàng</th>
                <th class='my-header'>Ngày Đặt Hàng</th>
                <th class='my-header'>Tổng Giá</th>
                <th class='my-header'>Phương Thức Thanh Toán</th>
                <th class='my-header'>Trạng Thái</th>
            </tr>";
        
        require("search_order.php");

        if ($result->num_rows > 0) {
            // Duyệt qua từng hàng kết quả
            $i =1;
            while ($row = $result->fetch_assoc()) {
                $madonhang = $row['madonhang'];
                $makhachhang = $row['makhachhang'];
                $ngaydathang = $row['ngaydathang'];
                $tonggia = $row['tonggia'];
                $pttt = $row['phuongthucthanhtoan'];
                $trangthai = $row['trangthai'];

                // Xử lý dữ liệu ở đây
                echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$madonhang</td>";
                    echo "<td>$makhachhang</td>";
                    echo "<td>$ngaydathang</td>";
                    echo "<td>".number_format($tonggia)."</td>";
                    echo "<td>$pttt</td>";
                    echo "<td>$trangthai</td>";
                echo "</tr>";
                $i++; 
            }
        }
        echo "</table>";

        $conn->close();
    ?>
</div>