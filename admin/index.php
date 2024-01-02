<?php
// Kết nối đến cơ sở dữ liệu
include "../connect.php";

?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $hello = $_SESSION['user'];
?>

    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css">



    <div class="main">
        <div class="container">
            <div class="top-menu">
                <img src="../img/logo.png">
            </div>
            <div class="hello"><?php echo "Xin chào ". $hello ?></div>
            
            <ul class="vertical-menu">
                <a href="index.php?page=product">
                    <li>Món</li>
                </a>
                <a href="index.php?page=customer">
                    <li>Khách Hàng</li>
                </a>
                <a href="index.php?page=order">
                    <li>Đơn Hàng</li>
                </a>
                <a href="index.php?page=order_details">
                    <li>Chi Tiết Đơn</li>
                </a>
                <a href="index.php?page=dstaikhoan">
                    <li>Tài Khoản</li>
                </a>
                <a href="index.php?page=account"></a>
            </ul>

            <a href="../logout.php" class="text-logout"><div >Đăng Xuất</div></a>
        </div>
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $page = $page . ".php";
            require($page);
        }
        ?>
    </div>
<?php
} else {
    header('location: ../login.php');
}
?>

<!-- lưu lại trang đang active(đổi màu nó) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các button có class 'btn-page'
    var buttons = document.querySelectorAll('.btn-page');

    // Khôi phục trạng thái active từ sessionStorage 
    var activeButtonIndex = sessionStorage.getItem('activeButtonIndex');
    if (activeButtonIndex !== null) {
        buttons[activeButtonIndex].classList.add('btn-page-active');
    } else {
        // Nếu không có trạng thái active nào được lưu, áp dụng trạng thái active cho button đầu tiên
        buttons[0].classList.add('btn-page-active');
    }

    // Lặp qua từng button và thêm sự kiện click
    buttons.forEach(function (button, index) {
        button.addEventListener('click', function () {
            // xóa class 'btn-page-active' từ tất cả các nút
            buttons.forEach(function (btn) {
                btn.classList.remove('btn-page-active');
            });

            // Thêm lớp btn-page-active cho button được bấm
            this.classList.add('btn-page-active');

            // Lưu active vào sessionStorage
            sessionStorage.setItem('activeButtonIndex', index);

            // Lấy href 
            var href = this.querySelector('a').getAttribute('href');
            window.location.href = href;
        });
    });
});
</script>