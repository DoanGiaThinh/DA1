<?php

if (isset($_POST['btn'])) {
    $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
    $email = $_POST['Email'];
    $ngaysinh = $_POST['Bitrhday'];
    $diachi = $_POST['address'] . ', ' . $_POST['ward'] . ', ' . $_POST['district'] . ', ' . $_POST['city'];
    $sodienthoai = $_POST['sodienthoai'];
    $city = $_POST['city'];
    $sql = "INSERT INTO khachhang (tenkhachhang, diachi, sodienthoai, email)
        Values('$name', '$diachi', '$sodienthoai', '$email') ";

    mysqLi_query($conn, $sql);
}

?>
    <div class="container">
        <div class="information">
            <h3>Thông tin chung</h3>
            <div class="name">
                <div class="form-group">
                    
                    <input type="text" id="firstname" name="firstname" placeholder="Họ đệm" required>
                </div>

                <div class="form-group">
                    
                    <input type="text" id="lastname" name="lastname" placeholder="Tên">
                </div>
            </div>
            <div class="emailphone">
                <div class="form-group">
                    
                    <input type="email" id="Email" name="Email" placeholder="Email"><br>
                </div>

                <div class="form-group">
                    
                    <input type="phone" id="sodienthoai" name="sodienthoai" placeholder="Số điện thoại"> 
                </div>
            </div>
        </div>
        <div class="Address">
            <div class="addressphone">
                <div class="form-group">
                <label for="address" class="form-label">Địa chỉ</label><br>
                    <input type="text" name="address" id="address" placeholder="Số nhà, tên đường,..." required ><br>
                </div>
            </div>

            <div class="Nation">
                <div class="form-group">
                <label for="city" class="form-label">Tỉnh/Thành Phố </label><br>
                    <select id="city" name="city" required>
                        <option value="" selected></option>
                    </select>
                </div>
                <div class="form-group">
                <label for="district" class="form-label">Quận/Huyện</label><br>
                    <select id="district" name="district" required>
                        <option value="" selected>Chọn Quận/Huyện</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="ward" class="form-label">Phường/Xã</label><br>
                    <select id="ward" name="ward" required>
                        <option value="" selected>Chọn Phường/Xã</option>
                    </select>
                </div>
            </div>
        </div>
        <br>

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