<div class="contain details_css">
    <?php
    $sql = "SELECT * FROM chitietdonhang";


    // Thực hiện truy vấn SQL
    $result = $conn->query($sql);

    echo "<table class='my-table'>";
    echo "<tr> 
                <th class='my-header stt'>STT</th>
                <th class='my-header'>Mã Đơn Hàng</th>
                <th class='my-header'>Mã Món</th>
                <th class='my-header'>Số Lượng</th>
            </tr>";

    if ($result->num_rows > 0) {
        // Duyệt qua từng hàng kết quả
        $num = mysqli_num_rows($result);
        $numPages = 10;
        $totalPage = ceil($num / $numPages);
        echo '<div class="my_page">';
        for ($btn = 1; $btn <= $totalPage; $btn++) {
            echo '<button class="my_button"><a href="?page=order_details&npage=' . $btn . '">' . $btn . '</a></button>';
        }
        echo '</div>';
        if (isset($_GET['npage'])) {
            $npage = $_GET['npage'];
        } else {
            $npage = 1;
        }
        $startinglimit = ($npage - 1) * $numPages;
        // $sql = "select * from chitietdonhang limit " . $startinglimit . ',' . $numPages;
        if (isset($_GET['madonhang'])) {
            $selectedMadon = $_GET['madonhang'];
            $sql = "SELECT * FROM chitietdonhang WHERE madonhang = '$selectedMadon' limit " . $startinglimit . ',' . $numPages;
        } else {
            $sql = "SELECT * FROM chitietdonhang";
        }
        $result = mysqli_query($conn, $sql);
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $madonhang = $row['madonhang'];
            $mamon = $row['mamon'];
            $soluong = $row['soluong'];

            // Xử lý dữ liệu ở đây
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$madonhang</td>";
            echo "<td>$mamon</td>";
            echo "<td>$soluong</td>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='4'>Không có kết quả.</td></tr>";
    }
    echo "</table>";

    $conn->close();
    ?>
</div>