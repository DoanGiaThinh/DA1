<?php
include "connect.php";

$this_id = $_GET['this_id'];

$sql = "SELECT * FROM mon WHERE mamon = '".$this_id."'";

$query = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($query);

if(isset($_POST['btn']) ){
    $tenmon = $_POST['tenmon'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];

    // Lưu trữ tên tệp ảnh hiện tại
    $img = $row['anh'];

    if(isset($_FILES['anh']) && $_FILES['anh']['error'] === 0) {
        $img_tmp_name = $_FILES['anh']['tmp_name'];
        $img_name = $_FILES['anh']['name'];
        $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $img = uniqid().'.'.$img_extension;
        move_uploaded_file($img_tmp_name, 'img/SanPham/'.$img);
    }

    $sql = "UPDATE mon SET tenmon='$tenmon', gia='$gia', anh='$img', soluong='$soluong' WHERE mamon='".$this_id."'";

    mysqli_query($conn, $sql);

    header('location: http://localhost/DA1/index.php?page=product');
}
?>
<link rel="stylesheet" href="edit_product.css">
<h1>Sửa Sản Phẩm: <?php echo $row['tenmon']; ?></h1>

<form method="post" enctype="multipart/form-data">
    <span><img src="img/SanPham/<?php echo $row['anh'] ?>" class="avatar"  id="image" width="100" height="100"></span>
    <input type="file" name="anh" id="imageFile" onchange="chooseFile(event)" accept="image/*"><br>

    <p>Tên món</p>
    <input type="text" name="tenmon" id="product-name" required value="<?php echo $row['tenmon']; ?>"><br>

    <p>Giá</p>
    <input type="text" name="gia" id="price" required value="<?php echo $row['gia']; ?>"><br>

    <p>Số Lượng</p>
    <input type="text" name='soluong' value="<?php echo $row['soluong']; ?>">
    <br><br>
    <button name="btn">Sửa</button> 
</form>

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