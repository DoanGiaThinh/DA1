<div class="main-table">
    <div class="header-table">
        <div class="bayby-header-table">
            Thông tin Sản Phẩm
        </div>
        <div class="btn-add-product">
            <button id="open-form" class="btn btn-warning">Tạo sản phẩm mới</button>
            <div id="popup-form" class="popup">
                <div class="popup-content">
                    <span class="close">&times;</span>
                    <form action="product.php" method="post" enctype="multipart/form-data">
                        <div class="product">
                            <div class="title">
                                <h4>Tạo sản phẩm mới</h4>
                            </div>
                            <div class="form-group">
                                <img class="avatar" id="image" width="100" height="100">
                                <input type="file" class="form-control-file" name="anh" id="imageFile" onchange="chooseFile(event)" accept="image/*"><br>
                            </div>
                            <div class="form-group">
                                <label for="product-name">Tên món</label><br>
                                <input type="text" class="form-control" name="product-name" id="product-name" required><br>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label><br>
                                <input type="text" class="form-control" name="price" id="price" values="" required><br>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng</label><br>
                                <input type="number" class="form-control" name="quantity" placeholder="Số lượng" pattern="[0-9]+" required min="1" value="0"><br>
                            </div>
                        </div>
                        <input class="add-product btn btn-warning" type="submit" name = "btn" value="Thêm Sản Phẩm Mới">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Mã món</th>
                <th scope="col">Tên món</th>
                <th scope="col">Giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Số Lượng</th>
                <th scope="col">Chức Năng</th>
            </tr>
        </thead>

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
            header("Location: product.php");
            // Chuyển hướng để tránh việc lặp lại dữ liệu khi làm mới trang
            exit();
        }
        
        $sql = "select * from mon";
        $result=mysqLi_query($conn,$sql);
        
        while($row = mysqli_fetch_array($result)){      
    ?>  

        <tbody>
            <tr>
                <th scope ="row"><?php echo $row ['mamon']?></th>
                <td><?php echo $row ['tenmon']?></td>
                <td><?php echo $row ['gia']?></td>
                <td style="text-align: center">
                    <img width="100" height="100" src="img/SanPham/<?php echo $row['anh']?>">
                </td>
                <td><?php echo $row ['soluong']?></td>
                <td>
                    <span><a class="btn btn-dark" href="edit_product.php?this_id=<?php echo $row ['mamon']?>"><i class="fa-solid fa-pen-to-square"></i></a></span>

                    <span><a class="btn btn-dark" href="delete_product.php?this_id=<?php echo $row ['mamon']?>"><i class="fa-solid fa-trash-can"></i> </a></span>                   
                </td>
            </tr>  
        </tbody>  
    <?php }
    $conn->close();
    ?>
    </table>
    
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="header-table">
    <div class="button">
        <a class="btn btn-warning" href="javascript:history.back()">Quay lại</a>
        
    </div>
    <div class="button">
        <a class="btn btn-warning" href="http://127.0.0.1:5502/menu.html">Quay về Trang Chủ</a>
    </div>
</div>
<script>
        // Open the popup form
        document.getElementById("open-form").addEventListener("click", function() {
            document.getElementById("popup-form").style.display = "block";
        });

        // Close the popup form
        document.getElementsByClassName("close")[0].addEventListener("click", function() {
            document.getElementById("popup-form").style.display = "none";
        });

        function chooseFile(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("image");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        
    </script>
<style>
body{
    position: relative;
}
.popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
/**? */    

.button{
    margin:10px auto;
    display:flex;
    justify-content: center;
}
.table{
    width: 100%;
    text-align: center;
    margin: 0 auto;
    border:1px solid black;
}
.table td{
    margin: 0 auto;
}
.header-table{
    font-weight: bold;
    background-color:black;
    color:white;
    margin: 0 auto;
    width: 100%;
    border: 1px black solid;
    display: flex;
    justify-content: space-between;
}
.main-table{
    margin: 0 auto;
}
.btn-add-product{
    padding: 10px;
}
.bayby-header-table{
    padding: 16px;
}
</style>



