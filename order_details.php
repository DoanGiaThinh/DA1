<?php
    include("connect.php");
?>
<?php
    include("connect.php");
?>
<div class="order_details">
    <div class="title_order_details">Thông Tin Chi Tiết Đơn Hàng</div>
    <?php
        // Câu truy vấn SQL
        $sql = "SELECT * FROM chitietdonhang";
        $result = $conn->query($sql);

        echo "<table class='my-table'>";
        echo "<tr> 
                <th class='my-header'>Mã Đơn Hàng</th>
                <th class='my-header'>Mã Món</th>
                <th class='my-header'>Số Lượng</th>
            </tr>";

        if ($result->num_rows > 0) {
            // Duyệt qua từng hàng kết quả
            while ($row = $result->fetch_assoc()) {
                $madonhang = $row['madonhang'];
                $mamon = $row['mamon'];
                $soluong = $row['soluong'];

                // Xử lý dữ liệu ở đây
                echo "<tr>";
                    echo "<td>$madonhang</td>";
                    echo "<td>$mamon</td>";
                    echo "<td>$soluong</td>";
                echo "</tr>";
            }
        } else {
            echo "Không có kết quả.";
        }
        echo "</table>";

        $conn->close();
    ?>
</div>
<style>
    .order_details{
        display: flex;
        flex-direction: column;
        flex: 12;
    }
    .title_order_details{
        height: 50px;
        font-size: 30px;
        color: white;
        background-color: black;
    }
    table.my-table {
        border-collapse: collapse;
    }

    th.my-header {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
        background-color: #f2f2f2;
    }

    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>