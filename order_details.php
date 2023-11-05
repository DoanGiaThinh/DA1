<?php
    include("connect.php");
?>
<?php
    include("connect.php");
?>
<div class="contain details_css">
    <?php
        // Câu truy vấn SQL
        $sql = "SELECT * FROM chitietdonhang";
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
            $i =1;
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
            echo "Không có kết quả.";
        }
        echo "</table>";

        $conn->close();
    ?>
</div>