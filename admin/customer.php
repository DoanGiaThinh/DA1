<?php


$sql = "SELECT * FROM khachhang";
$result = mysqli_query($conn, $sql);
?>
<div class="contain">
    <div class="header-table">
        <form class="search-form" method="post" action="index.php?page=customer">
            <input type="text" name="search" class="search-text" placeholder="Nhập vào tên hoặc email...">
            <input class="search-btn" type="submit" value="Tìm Khách Hàng">
        </form>
    </div>
    <div class="main-table">
        
        <table class='my-table'>
            <thead>
                <th class='my-table stt'>STT</th>
                <th class='my-table'>Mã Khách Hàng</th>
                <th class='my-table'>Tên Khách Hàng</th>
                <th class='my-table'>Địa Chỉ</th>
                <th class='my-table'>Email</th>
                <th class='my-table'>Số Điện Thoại</th>
                <th class='my-table'>Chức Năng</th>
            </thead>

            <?php require("../timkiem/search_customer.php"); ?>       

            <?php
            $num = mysqli_num_rows($result);
            $numPages = 10;
            $totalPage = ceil($num/$numPages);
            echo '<div class="my_page">';
            for($btn =1 ; $btn<=$totalPage; $btn++){
                echo '<button class="my_button"><a href="?page=customer&npage='.$btn.'">'.$btn.'</a></button>';
            }
            echo '</div>';
            if(isset($_GET['npage'])){
                $npage = $_GET['npage'];
            }
            else{
                $npage = 1;
            }
            $startinglimit= ($npage - 1)*$numPages;
            $sql = "select * from khachhang limit ".$startinglimit.','.$numPages;
            $result = mysqli_query($conn, $sql); 
            $i =1;
            while ($row = mysqli_fetch_array($result)) { ?>
                <tbody>
                    <tr>
                    <td><?php echo $i?></td>
                        <td><?php echo $row['makhachhang'] ?></td>
                        <td><?php echo $row['tenkhachhang'] ?></td>
                        <td><?php echo $row['diachi'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['sodienthoai'] ?></td>
                        <td>
                            <span><a href="delete_customer.php?erro=Khách hàng đang có đơn không thể xoá&this_id=<?php echo $row['makhachhang'] ?>"> <i class="fa-solid fa-trash-can table_icon"></i> </a></span>
                        </td>
                    </tr>
                </tbody>
            <?php $i++; } ?>
        </table>
        <div class="information-erro">
            <span><?php if(isset($_GET['erro'])) {echo $_GET['erro']; } ?></span>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    function showPopup(message) {
        var confirmed = confirm(message);
        if (confirmed) {
            window.location.href = 'http://localhost/DA1/index.php?page=customer';
        }
    }

    window.onload = function() {
        var errorMessage = "<?php if(isset($_GET['erro'])) {echo $_GET['erro']; } ?>";
        if (errorMessage !== '') {
            showPopup(errorMessage);
        }
    };
</script>
