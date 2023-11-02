<?php
    include "connect.php";

    $this_id = $_GET['this_id'];
    
    // Delete related records in the chitietdonhang table
    $deleteRelatedQuery = "DELETE FROM chitietdonhang WHERE mamon='$this_id'";
    mysqli_query($conn, $deleteRelatedQuery);

    // Delete the row in the mon table
    $deleteQuery = "DELETE FROM mon WHERE mamon='$this_id'";
    mysqli_query($conn, $deleteQuery);

    header('location: index.php?page=product');
?>