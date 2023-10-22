
<?php
include "connect.php";


if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $_SESSION['search'] = $search; // Lưu giá trị tìm kiếm vào biến session
    // header("Location: customer.php"); // Chuyển hướng trang sau khi nhấn nút tìm kiếm
    // exit(); // Dừng thực thi mã sau khi chuyển hướng
} elseif (isset($_SESSION['search'])) {
    $search = $_SESSION['search']; // Lấy giá trị tìm kiếm từ biến session
} else {
    $search = ""; // Nếu không có giá trị tìm kiếm thì mặc định là rỗng
}

if (!empty($search)) {
    $sql = "SELECT * FROM khachhang WHERE tenkhachhang LIKE '%$search%' OR email LIKE '%$search%'";
    $result = $conn->query($sql);

    $searchResults = '';

    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $customerId = $row["makhachhang"];
            $name = $row["tenkhachhang"];
            $email = $row["email"];
            $address = $row["diachi"];
            $phone = $row["sodienthoai"];
            
        
            $searchResults .= '<tr scope="row">';
            $searchResults .= '<th>' . $customerId . '</th>';
            $searchResults .= '<td>' . $name . '</td>';
            $searchResults .= '<td>' . $address . '</td>';
            $searchResults .= '<td>' . $email . '</td>';
            $searchResults .= '<td>' . $phone . '</td>';
            $searchResults .= '<td>
                                    <span><a class="btn btn-dark" href="edit_customer.php?this_id=' . $customerId . '"><i class="fa-solid fa-pen-to-square"></i></a></span>
                                    <span><a class="btn btn-dark" href="delete_customer.php?this_id=' . $customerId . '"><i class="fa-solid fa-trash-can"></i></a></span>
                              </td>';
            $searchResults .= '</tr>';
        }
        
    } else {
        $searchResults = "Không tìm thấy";
    }

    // Lưu kết quả tìm kiếm vào biến session
    $_SESSION['searchResults'] = $searchResults;

    // Hiển thị kết quả tìm kiếm
    echo '<div class="search-results">' . $searchResults . '</div>';
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Form tìm kiếm khách hàng -->


<style>
    .search-text{
        width: 400px;
    }
    .search-form{
        margin: auto;
    }
    .search-btn{
        margin-left: -38px;
        border: none;
    }
</style>