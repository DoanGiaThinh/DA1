<div class="contain">
    <div class="header-table">
        <div class="btn-add-product">
            <button id="open-form">Tạo sản phẩm mới</button>
            <div id="popup-form" class="popup">
                <div class="popup-content">
                    <span class="close">&times;</span>
                    <div class="title">
                        <h3>Tạo sản phẩm mới</h3>
                    </div>
                    <form action=" index.php?page=product" method="post" enctype="multipart/form-data">
                        <div class="product">
                            
                            <div class="form-group">
                                <div class="center_box"><img class="avatar" id="image" width="100" height="100"></div>
                                <input type="file" class="form-control-file" name="anh" id="imageFile" onchange="chooseFile(event)" accept="image/*"><br>
                            </div>
                            <div class="form-group">
                                <label for="product-name">Tên món</label><br>
                                <input type="text" class="form-control" name="product-name" id="product-name" placeholder="Tên Món" required><br>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label><br>
                                <input type="text" class="form-control" name="price" id="price" values="" placeholder="Giá" required><br>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng</label><br>
                                <input type="number" class="form-control" name="quantity" placeholder="Số lượng" pattern="[0-9]+" required min="1" value="0"><br>
                            </div>
                        </div>
                        <input class="add-product" type="submit" name = "btn" value="Thêm Sản Phẩm Mới">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class='my-table'>
        <thead>
            <tr>
                <th class='my-table stt'>STT</th>
                <th class='my-table'>Mã món</th>
                <th class='my-table'>Tên món</th>
                <th class='my-table'>Giá</th>
                <th class='my-table'>Ảnh</th>
                <th class='my-table'>Số Lượng</th>
                <th class='my-table'>Chức Năng</th>
            </tr>
        </thead>

    <?php 

        if(isset($_POST['btn'])){
            $image = $_FILES['anh']['name'];
            
            $image_tmp_name = $_FILES['anh']['tmp_name'];
    
            $product_name = $_POST['product-name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
    
            $sql = "INSERT INTO mon (tenmon, gia, anh, soluong )
            Values('$product_name', '$price', '$image', '$quantity') ";
    
            mysqLi_query($conn, $sql);
    
            move_uploaded_file($image_tmp_name, '../img/SanPham/'.$image);
            header("Location: index.php?page=product");
            // Chuyển hướng để tránh việc lặp lại dữ liệu khi làm mới trang
            exit();
        }
        
        $sql = "select * from mon";
        $result = mysqLi_query($conn,$sql);
        $num = mysqli_num_rows($result);
        $numPages = 4;
        $totalPage = ceil($num/$numPages);
        echo '<div class="my_page">';
        for($btn =1 ; $btn<=$totalPage; $btn++){

            echo '<button class="btn-page"><a href="?page=product&npage='.$btn.'">'.$btn.'</a></button>';
        }
        echo '</div>';
        if(isset($_GET['npage'])){
            $npage = $_GET['npage'];
        }
        else{
            $npage = 1;
        }
        $startinglimit= ($npage - 1)*$numPages;
        $sql = "select * from mon limit ".$startinglimit.','.$numPages;
        $result = mysqli_query($conn, $sql);
        $i =1;
        while($row = mysqli_fetch_array($result)){      
             
    ?>  
       
        <tbody>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row ['mamon']?></td>
                <td><?php echo $row ['tenmon']?></td>
                <td><?php echo number_format($row['gia']) ." đ"?></td>
                <td class="table_img" style="text-align: center">
                    <img width="100" height="100" src="../img/SanPham/<?php echo $row['anh']?>">
                </td>
                <td><?php echo $row ['soluong']?></td>
                <td>
                    <span><a href="edit_product.php?this_id=<?php echo $row ['mamon']?>"><i class="fa-solid fa-pen-to-square table_icon"></i></a></span>
                    <span><a href="delete_product.php?this_id=<?php echo $row ['mamon']?>"><i class="fa-solid fa-trash-can table_icon"></i> </a></span>                   
                </td>
            </tr>  
        </tbody> 
       
        
    <?php 
    $i++; 
    }
    // $conn->close();
    
    ?>
    
    </table>
    
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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


