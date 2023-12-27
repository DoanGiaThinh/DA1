<link rel="stylesheet" href="dstaikhoan.css">

<div class="contain">
<div class="filterRole-container">
    <div>
        <a id="captk" href="../register.php">Cấp Tài Khoản</a>
    </div>
    <div>
        <div id='left-fl'>
            <label for="ngaytao">Ngày tạo:</label>
            <input type="date" id="ngaytao" name="ngaytao"> <br>
            <label for="quyen">Quyền:</label>
            <select id="quyen" name="quyen">
                <option value="">Tất cả</option>
                <option value="1">Admin</option>
                <option value="0">Nhân Viên</option>
                <option value="2">Shipper</option>
            </select>
            <button onclick="filterAccounts()">Lọc</button>
        </div>
    </div>
</div>

<table class="main-table">
    <thead>
        <td>STT</td>
        <td class="matk">Mã TK</td>
        <td class="tendangnhap">Tài Khoản</td>
        <td class="hoten">Họ Tên</td>
        <td class="diachi">Địa Chỉ</td>
        <td class="sdt">SĐT</td>
        <td class="email">Email</td>
        <td class="quyen">Quyền</td>
        <td class="ngaytao">Ngày Tạo</td>
    </thead>
    <?php
    function layTK($conn)
    {
        $sql = "select * from taikhoan";
        return mysqli_query($conn, $sql);
    }
    
    $result = layTK($conn);

    $num = mysqli_num_rows($result);
    // số lượng sản phẩm 1 trang
    $numberPages = 9;

    $totalPages = ceil($num / $numberPages);
    echo '<div class="btn-pagination">';
    echo '<span>Trang: </span>';
    for ($btn = 1; $btn <= $totalPages; $btn++) {
        echo '<button class="btn-page"><a href="index.php?page=dstaikhoan&npage=' . $btn . '">' . $btn . '</a></button>';
    }
    echo '</div>';
    if (isset($_GET['npage'])) {
        $npage = $_GET['npage'];
    } else {
        $npage = 1;
    }

    $startinglimit = ($npage - 1) * $numberPages;
    if (isset($_GET['ngaytao']) && !empty($_GET['ngaytao'])) {
        $selectedDate = $_GET['ngaytao'];
        $sql = "SELECT * FROM taikhoan WHERE DATE(ngaytao) = '$selectedDate'";
    } else {
        $sql = "SELECT * FROM taikhoan";
    }

    if (isset($_GET['quyen']) && !empty($_GET['quyen'])) {
        $selectedRole = $_GET['quyen'];
        if (strpos($sql, 'WHERE') !== false) {
            $sql .= " AND quyen = '$selectedRole'";
        } else {
            $sql .= " WHERE quyen = '$selectedRole'";
        }
    } elseif (isset($_GET['quyen']) && $_GET['quyen'] === '0') {
        if (strpos($sql, 'WHERE') !== false) {
            $sql .= " AND quyen = '0'";
        } else {
            $sql .= " WHERE quyen = '0'";
        }
    }


    $sql .= " LIMIT " . $startinglimit . ',' . $numberPages;

    $result = mysqli_query($conn, $sql);

    $i = $startinglimit + 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
            <td class="matk"><?php echo $row['mataikhoan'] ?></td>
            <td class="tendangnhap"><?php echo $row['tendangnhap'] ?></td>
            <td class="hoten"><?php echo $row['hoten'] ?></td>
            <td class="diachi"><?php echo $row['diachi'] ?></td>
            <td class="sdt"><?php echo $row['sodienthoai'] ?></td>
            <td class="email"><?php echo $row['email'] ?></td>
            <td class="quyen"><?php echo $row['quyen'] ?></td>
            <td class="ngaytao"><?php echo date('d/m/Y', strtotime($row['ngaytao'])) ?></td>
        </tbody>
    <?php $i++;
    }
    ?>
</table>
</div>
<script>
    function filterAccounts() {
        var selectedDate = document.getElementById("ngaytao").value;
        var selectedRole = document.getElementById("quyen").value;

        // Chuyển hướng đến trang với tham số ngaytao và quyen được chọn
        var url = 'index.php?page=dstaikhoan';
        if (selectedDate) {
            url += '&ngaytao=' + selectedDate;
        }
        if (selectedRole) {
            url += '&quyen=' + selectedRole;
        }
        window.location.href = url;
    }
</script>