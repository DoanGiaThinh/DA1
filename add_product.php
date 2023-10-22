<script>
    function chooseFile(event) {
        if(event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("image");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>



<?php
    include "connect.php";
    if(isset($_POST['btn'])){
        $image = $_FILES['anh']['name'];
        
        $image_tmp_name = $_FILES['anh']['tmp_name'];

        $product_name = $_POST['product-name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $sql = "INSERT INTO mon (tenmon, gia, anh, soluong )
        Values('$product_name', '$price', '$image', '$quantity') ";

        mysqLi_query($conn, $sql);

        move_uploaded_file($image_tmp_name, 'img/SanPham/'.$image);
    }
?>


<form action="add_product.php" method="post" enctype = "multipart/form-data">
    <div class="product">
        <div class="title">
            <h4>Tạo sản phẩm mới</h4>
        </div>
        <div class="form-group image">
            <img class="avatar" id="image" width="100" height="100" >
            <input type="file" name="anh" id="imageFile" onchange="chooseFile(event)" accept="image/*" ><br>
        </div>
        <div class="form-group text">
            <label for="product-name">Tên món</label><br>
            <input type="text" name="product-name" id="product-name" required><br>
        </div>
        <div class="form-group text">
            <label for="price">Giá</label><br>
            <input type="text" name="price" id="price" values= "" required><br>
        </div>
        <div class="form-group text">
            <label for="">Số lượng</label><br>
            <input type="number" name="quantity" placeholder="Số lượng" pattern="[0-9]+" required min="1" value="0"><br>
        </div>
    </div>
    <input class="add-product" type="submit" name = "btn" value="Thêm Sản Phẩm Mới"><br>
</form>
<script>
    const priceInput = document.querySelector('#price');

    priceInput.onchange = function() {
    const price = this.value;
    const priceNumber = parseFloat(price);
    const formattedValue = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(priceNumber);
    this.value = formattedValue;
    };
    priceInput.oninput = function(event) {
    const inputValue = event.target.value;
    const numericValue = parseFloat(inputValue);

    };

    priceInput.maxLength = 10;
</script>