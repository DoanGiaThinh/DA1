<?php
    include "connect.php";
    if(isset($_POST['btn'])){
        $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
        $email = $_POST['Email'];
        $ngaysinh = $_POST['Bitrhday'];
        $diachi = $_POST['address'].', '.$_POST['ward'].', ' . $_POST['district'].', '.$_POST['city'];
        $sodienthoai = $_POST['sodienthoai'];
        $city = $_POST['city'];
        $sql = "INSERT INTO khachhang (tenkhachhang, diachi, sodienthoai, email)
        Values('$name', '$diachi', '$sodienthoai', '$email') ";

        mysqLi_query($conn, $sql);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Khách Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()">Quay lại</a><br>
        <a href="http://127.0.0.1:5500/menu.html">Quay về Trang Chủ</a>
        <div class="title">
            <H3>Thông Tin Khách Hàng</H3>
            <p>VUI LÒNG CUNG CẤP CÁC THÔNG TIN VỀ KHÁCH HÀNG SẼ TẠO</p>
        </div>
        <form action="add_customer.php" method="post" enctype = "multipart/form-data">
            <div class="information">
                <h4>Thông tin chung</h4>
                <div class="name">
                    <div class="form-group">
                        <label for="firstname">Họ đệm</label><br>
                        <input type="text" id="firstname" name="firstname" placeholder="Nhập họ đệm">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Tên</label><br>
                        <input type="text" id="lastname" name="lastname" placeholder="Nhập tên">
                    </div>
                </div>
                <div class="emailphone">
                    <div class="form-group">
                        <label for="Email">Nhập Email</label><br>
                        <input type="email" id="Email" name="Email" placeholder="Nhập email">
                    </div>

                    <div class="form-group">
                        <label for="Nhập số điện thoại">Số điện thoại</label><br>
                        <input type="" id="số điện thoại" name="sodienthoai" placeholder="Nhập số điện thoại">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Bitrhday">Chọn ngày sinh</label><br>
                    <input type="date" name="Bitrhday" id="Bitrhday">
                </div>
                <div class="form-group">
                    <label>Giới Tính</label><br>

                    <input type="radio" values="Nữ" name="gioitinh">
                    <label>Nữ</label><br>
                    <input type="radio" values="Nam" name="gioitinh">
                    <label>Nam</label>
                </div>
            </div>
            <div class="Address">
                <h4>Địa Chỉ</h4>
                <div class="addressphone">
                    <div class="form-group">
                        <label for="address">Địa chỉ</label><br>
                        <input type="text" name="address" id="address" placeholder="Số nhà, tên đường,..."><br>
                    </div>
                </div>
                
                <div class="Nation">
                    <div class="form-group">
                        <label for="city">Tỉnh/Thành Phố </label><br>
                        <select id="city" name="city">
                        <option value="" selected></option>           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district">Chọn Quận/Huyện</label><br>              
                        <select id="district" name="district">
                        <option value="" selected>Chọn Quận/Huyện</option>
                        </select>
                    </div>
                    <div class="form-group"> 
                        <label for="ward">Chọn Phường/Xã</label><br>
                        <select id="ward" name="ward">
                        <option value="" selected>Chọn Phường/Xã</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <input class="create-order" name = "btn" type="submit" value="Tạo Khách Hàng" class="form-submit">
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
</body>
</html>


<style>
    *{
    padding:0;
    margin:0;
    box-sizing: border-box;
    
}
.information ,.Address{
    border: 1px solid rgb(0, 0, 0);
    max-width: 400px;
    margin: 10px auto;

}
.name{
    display: flex;
}
.form-group{
    padding:15px 15px;
}
.emailphone{
    display: flex;
}

.addressphone{
    display: flex;
}
.addressphone .form-group{
    flex: 1;
}
.Nation{
    display: grid;
    grid-template-columns: 1fr 1fr;
}
h4{
    font-size: 20px;
    border-bottom: 2px rgba(0, 0, 0, 0.225) solid;
    width: 380px;
    margin: 10px auto;
}
.create-order{
    display: block;
    margin: 0 auto;
    padding: 10px;
    background-color: lightpink;
    border: none;
    border-radius: 2px;
    transition: 0.5s;
}
.create-order:hover{
    background-color: lightblue;
}

.Nation .form-group select{
    width:165px ;
    padding-left: 10px;
}
input{
    max-width:165px ;
    padding-left: 10px;
}
.title{
    text-align: center;
    margin: 20px 0 10px;
    justify-content: center;
    background-color: rgb(1, 1, 99);
    color: #fff;
} 
.title p{
    font-style: italic;
    text-transform: none;
}
body{
    background-color: #F5F5F5;
    font-family: sans-serif;
}
body .information{
    background-color:white;
}
body .container .Address{
    background-color: white;
}
label{
    color: rgb(1, 1, 99);
}
</style>