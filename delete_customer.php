<?php
    include "connect.php";
    
    if(isset($_GET['this_id'])){
        $this_id= $_GET['this_id'];
        
        
        
        //sql get orther
        $sql_order = "SELECT makhachhang FROM donhang WHERE makhachhang='$this_id'";
        $result_order = mysqli_query($conn,$sql_order);
        $row_num_order = mysqli_num_rows($result_order);
        if(!empty($row_num_order))  {
            header("Location: index.php?page=customer&erro=Khách hàng đang có đơn hàng");
        }

        else{
            //sql delete
            $sql_delete = "DELETE FROM khachhang WHERE makhachhang='$this_id'";
            $result_delete = mysqli_query($conn,$sql_delete);
            header("Location:customer.php");
        }
        
    
    }
   
?>