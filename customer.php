<?php
include "connect.php";

$sql = "SELECT * FROM khachhang";
$result = mysqli_query($conn, $sql);
?>
<div class="main-table">
    
    <div class="header-table">
        <div class=title_customer>Thông Tin Khách Hàng</div>
        <form class="search-form" method="post" action="customer.php">
            <input type="text" name="search" class="search-text" placeholder="Nhập vào tên hoặc email...">
            <input class="search-btn" type="submit" value="Tìm">
        </form>
    </div>
    
    <table class="table">
        <thead>
            <th scope="col">Mã Khách Hàng</th>
            <th scope="col">Tên Khách Hàng</th>
            <th scope="col">Địa Chỉ</th>
            <th scope="col">Email</th>
            <th scope="col">Số Điện Thoại</th>
            <th scope="col">Chức Năng</th>
        </thead>

        <?php require("search_customer.php"); ?>       

        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $row['makhachhang'] ?></th>
                    <td><?php echo $row['tenkhachhang'] ?></td>
                    <td><?php echo $row['diachi'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['sodienthoai'] ?></td>
                    <td>
                        <span><a class="btn btn-dark" href="edit_customer.php?this_id=<?php echo $row['makhachhang'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></span>
                        <span><a class="btn btn-dark" href="delete_customer.php?erro=Khách hàng đang có đơn không thể xoá&this_id=<?php echo $row['makhachhang'] ?>"> <i class="fa-solid fa-trash-can"></i> </a></span>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <div class="information-erro">
        <span><?php if(isset($_GET['erro'])) {echo $_GET['erro']; } ?></span>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    function showPopup(message) {
        var confirmed = confirm(message);
        if (confirmed) {
            // Thực hiện hành động sau khi người dùng bấm "OK" ở đây
            // Ví dụ: chuyển hướng đến một trang khác
            window.location.href = 'http://localhost/DA1/index.php?page=customer';
        }
    }

    // Gọi hàm showPopup khi trang được tải hoàn thành
    window.onload = function() {
        var errorMessage = "<?php if(isset($_GET['erro'])) {echo $_GET['erro']; } ?>";
        if (errorMessage !== '') {
            showPopup(errorMessage);
        }
    };
</script>
<style>
    .thongtin {
        padding: 10px;
    }

    .address {
        padding: 10px;
    }

    #close-popup {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: black;
        cursor: pointer;
    }

    .thongtin-address {
        display: flex;
    }

    .button {
        margin: 10px auto;
        display: flex;
        justify-content: center;
    }

    .header-table {
        font-weight: bold;
        background-color: black;
        color: white;
        margin: 0 auto;
        width: 100%;
        border: 1px black solid;
        display: flex;
        justify-content: space-between;
    }

    .button {
        margin: 10px auto;
        display: flex;
        justify-content: center;
    }
    .main_table{
        flex: 12;
    }
    .table {
        text-align: center;
        margin: 0 auto;
        border: 1px solid black;
    }

    .table td {
        margin: 0 auto;
    }
    .search-btn{
        background-color: white;
        height: 25px;

    }
    .title_customer{
        font-size: 30px;
    }
</style>