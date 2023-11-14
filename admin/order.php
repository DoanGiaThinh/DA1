 
<div class="contain">
    <div class="header-table">
        <form class="search-form" method="post" action="index.php?page=order">
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
                <th class='my-header'>STT</th>
                <th class='my-header'>Mã Đơn Hàng</th>
                <th class='my-header'>Mã Khách Hàng</th>
                <th class='my-header'>Ngày Đặt Hàng</th>
                <th class='my-header'>Tổng Giá</th>
                <th class='my-header'>Phương Thức Thanh Toán</th>
                <th class='my-header'>Trạng Thái</th>
                <th class='my-header'>Xem Chi Tiết</th>
            </tr>";
        
        if ($result->num_rows > 0) {
            // Duyệt qua từng hàng kết quả
            $num = mysqli_num_rows($result);
            $numPages = 10;
            $totalPage = ceil($num/$numPages);
            echo '<div class="my_page">';
            for($btn =1 ; $btn<=$totalPage; $btn++){
                echo '<button class="my_button"><a href="?page=order&npage='.$btn.'">'.$btn.'</a></button>';
            }
            echo '</div>';
            if(isset($_GET['npage'])){
                $npage = $_GET['npage'];
            }
            else{
                $npage = 1;
            }
            $startinglimit= ($npage - 1)*$numPages;
            $sql = "select * from donhang limit ".$startinglimit.','.$numPages;
            $result = mysqli_query($conn, $sql);
            $i = 1;
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
                echo "<td><a class='fa-regular fa-file-lines' href='?page=order_details&madonhang="."$madonhang"."'></a></td>";
                echo "</tr>";
                $i++; 
            }
        } else {
            echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
        }
        echo "</table>";

        $conn->close();
    ?>
</div>

