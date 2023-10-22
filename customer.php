<?php
include "connect.php";

if (isset($_POST['btn'])) {
    $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
    $email = $_POST['email'];
    $ngaysinh = $_POST['birthdate'];
    $diachi = $_POST['address'] . ', ' . $_POST['ward'] . ', ' . $_POST['district'] . ', ' . $_POST['city'];
    $sodienthoai = $_POST['phone'];
    $city = $_POST['city'];
    $sql = "INSERT INTO khachhang (tenkhachhang, diachi, sodienthoai, email, ngaysinh)
        VALUES ('$name', '$diachi', '$sodienthoai', '$email', '$ngaysinh') ";

    mysqli_query($conn, $sql);
    // Chuyển hướng để tránh việc lặp lại dữ liệu khi làm mới trang
    header("Location: customer.php");
    exit();
}


$sql = "SELECT * FROM khachhang";
$result = mysqli_query($conn, $sql);
?>
<div class="main-table">
    
    <div class="header-table">
        <div>Thông Tin Khách Hàng</div>
        <form class="search-form" method="post" action="customer.php">
            <input type="text" name="search" class="search-text" placeholder="Nhập vào tên hoặc email...">
            <input class="search-btn" type="submit" value="Tìm">
        </form>
        <div>
            <button id="open-popup" class="btn btn-warning">Thêm Khách Hàng</button>

            <div id="popup-form">
                <span id="close-popup">X</span>
                <form action="customer.php" method="post">
                    <div class="thongtin-address">
                        <!-- Mã HTML của form khách hàng đã cung cấp -->
                        <div class="thongtin">
                            <div class="form-group">
                                <label for="firstname">Họ đệm</label><br>
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Nhập họ đệm" required>
                            </div>

                            <div class="form-group">
                                <label for="lastname">Tên</label><br>
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Nhập tên" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Số điện thoại:</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="birthdate" class="form-label">Ngày sinh:</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Giới tính:</label>
                                <div class="form-check">
                                    <input type="radio" id="male" name="gender" value="Nam" class="form-check-input" required>
                                    <label for="male" class="form-check-label">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="female" name="gender" value="Nữ" class="form-check-input" required>
                                    <label for="female" class="form-check-label">Nữ</label>
                                </div>
                            </div>
                        </div>
                        <div class="address">
                            <div class="form-group">
                                <label for="address" class="form-label">Địa chỉ</label><br>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Số nhà, tên đường,..."><br>
                            </div>

                            <div class="form-group">
                                <label for="city" class="form-label">Tỉnh/Thành Phố </label><br>
                                <select id="city" class="form-control" name="city">
                                    <option value="" selected></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district" class="form-label">Chọn Quận/Huyện</label><br>
                                <select id="district" class="form-control" name="district">
                                    <option value="" selected>Chọn Quận/Huyện</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward" class="form-label">Chọn Phường/Xã</label><br>
                                <select id="ward" class="form-control" name="ward">
                                    <option value="" selected>Chọn Phường/Xã</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input class="create-order form-submit btn btn-warning" name="btn" type="submit" value="Tạo Khách Hàng">
                </form>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
            <script>
                const host = "https://provinces.open-api.vn/api/";
                var callAPI = (api) => {
                    return axios.get(api)
                        .then((response) => {
                            renderData(response.data, "city");
                        });
                }
                callAPI('https://provinces.open-api.vn/api/?depth=1');
                var callApiDistrict = (api) => {
                    return axios.get(api)
                        .then((response) => {
                            renderData(response.data.districts, "district");
                        });
                }
                var callApiWard = (api) => {
                    return axios.get(api)
                        .then((response) => {
                            renderData(response.data.wards, "ward");
                        });
                }

                var renderData = (array, select) => {
                    let row = ' <option disable value="">Chọn</option>';
                    array.forEach(element => {
                        row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
                    });
                    document.querySelector("#" + select).innerHTML = row
                }

                $("#city").change(() => {
                    callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
                    printResult();
                });
                $("#district").change(() => {
                    callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
                    printResult();
                });
                $("#ward").change(() => {
                    printResult();
                })
            </script>
        </div>
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
        <!-- Phần HTML -->
        <!-- ... -->
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
                        <span><a class="btn btn-dark" href="delete_customer.php?this_id=<?php echo $row['makhachhang'] ?>"> <i class="fa-solid fa-trash-can"></i> </a></span>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="header-table">
    <div class="button">
        <a class="btn btn-warning" href="javascript:history.back()">Quay lại</a><br>
    </div>
    <div class="button">
        <a class="btn btn-warning" href="http://127.0.0.1:5500/menu.html">Quay về Trang Chủ</a>
    </div>
</div>
<script>
    document.getElementById("open-popup").addEventListener("click", function() {
        document.getElementById("popup-form").style.display = "block";
    });

    document.getElementById("close-popup").addEventListener("click", function() {
        document.getElementById("popup-form").style.display = "none";
    });
</script>
<style>
    #popup-form {
        display: none;
        position: fixed;
        top: 10%;
        left: 30%;
        color: black;
        background-color: white;
        padding: 20px;
        z-index: 1;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

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

    .table {
        width: 100%;
        text-align: center;
        margin: 0 auto;
        border: 1px solid black;
    }

    .table td {
        margin: 0 auto;
    }
</style>