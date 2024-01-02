<div class="contain details_css">
    <?php
    $sql = "SELECT * FROM chitietdonhang";


    // Thực hiện truy vấn SQL
    $result = $conn->query($sql);

    echo "<table class='my-table'>";
    echo "<tr> 
                <th class='my-header stt'>STT</th>
                <th class='my-header'>Mã ĐH</th>
                <th class='my-header'>Mã KH</th>
                <th class='my-header'>Địa Chỉ</th>
                <th class='my-header'>SĐT</th>
                <th class='my-header'>Tên Món</th>
                <th class='my-header' style='width: 80px;'>Số Lượng</th>
                <th class='my-header'>Tổng Giá</th>
                <th class='my-header' style='width: 96px;'>Thanh Toán</th>
                <th class='my-header' style='width: 120px;'>Ngày Đặt Hàng</th>
            </tr>";

    if ($result->num_rows > 0) {
        // Duyệt qua từng hàng kết quả
        $num = mysqli_num_rows($result);
        $numPages = 10;
        $totalPage = ceil($num / $numPages);
        echo '<div class="my_page">';
        for ($btn = 1; $btn <= $totalPage; $btn++) {
            echo '<button class="btn-page"><a href="?page=order_details&npage=' . $btn . '">' . $btn . '</a></button>';
        }
        echo '</div>';
        if (isset($_GET['npage'])) {
            $npage = $_GET['npage'];
        } else {
            $npage = 1;
        }
        $startinglimit = ($npage - 1) * $numPages;
        $sql = "select * from chitietdonhang limit " . $startinglimit . ',' . $numPages;
        if (isset($_GET['madonhang'])) {
            $selectedMadon = $_GET['madonhang'];
            $sql = "SELECT dh.madonhang, kh.tenkhachhang, kh.diachi, kh.sodienthoai, m.tenmon , ctd.soluong, dh.tonggia, dh.phuongthucthanhtoan, dh.ngaydathang 
            FROM chitietdonhang ctd, donhang dh, mon m, khachhang kh 
            WHERE ctd.madonhang = dh.madonhang 
            AND ctd.mamon = m.mamon 
            AND dh.makhachhang = kh.makhachhang 
            AND ctd.madonhang = '$selectedMadon' limit " . $startinglimit . ',' . $numPages;
        } else {
            $sql = "SELECT dh.madonhang, kh.tenkhachhang, kh.diachi, kh.sodienthoai, m.tenmon , ctd.soluong, dh.tonggia, dh.phuongthucthanhtoan, dh.ngaydathang 
            FROM chitietdonhang ctd, donhang dh, mon m, khachhang kh 
            WHERE ctd.madonhang = dh.madonhang 
            AND ctd.mamon = m.mamon 
            AND dh.makhachhang = kh.makhachhang";
        }
        $result = mysqli_query($conn, $sql);
        $i =$startinglimit +1;
        while ($row = $result->fetch_assoc()) {
            if ($i > $startinglimit && $i <= ($startinglimit + $numPages)) {
            $madonhang = $row['madonhang'];
            $tenkhachhang = $row['tenkhachhang'];
            $diachi = $row['diachi'];
            $sodienthoai = $row['sodienthoai'];
            $tenmon = $row['tenmon'];
            $soluong = $row['soluong'];
            $tonggia = $row['tonggia'];
            $phuongthucthanhtoan = $row['phuongthucthanhtoan'];
            $ngaydathang = $row['ngaydathang'];

            // Xử lý dữ liệu ở đây
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$madonhang</td>";
            echo "<td>$tenkhachhang</td>";
            echo "<td style='text-align: left;'>$diachi</td>";
            echo "<td>$sodienthoai</td>";
            echo "<td>$tenmon</td>";
            echo "<td>$soluong</td>";
            echo "<td>$tonggia</td>";
            echo "<td>$phuongthucthanhtoan</td>";
            echo "<td>$ngaydathang</td>";
            echo "</tr>";
            }
            $i++;
        }
    } else {
        echo "<tr><td colspan='4'>Không có kết quả.</td></tr>";
    }
    echo "</table>";

    $conn->close();
    ?>
</div>