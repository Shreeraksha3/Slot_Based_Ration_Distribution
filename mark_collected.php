<?php

include('connection.php');  

if (isset($_POST['mark_collected'])) {

    $allocation_id = $_POST['allocation_id'];

    if (is_numeric($allocation_id)) {
  
        $query = "UPDATE slot_allocations SET is_collected = 1 WHERE id = ?";
        
       
        if ($stmt = mysqli_prepare($conn, $query)) {
            
            mysqli_stmt_bind_param($stmt, 'i', $allocation_id);
            
          
            if (mysqli_stmt_execute($stmt)) {
                header("Location: allocation.php?status=success");
                exit();
            } else {
               
                header("Location: allocation.php?status=error");
                exit();
            }
        } else {
           
            header("Location: allocation.php?status=error");
            exit();
        }
    } else {
       
        header("Location: allocation.php?status=error");
        exit();
    }
} else {
   
    header("Location: allocation.php?status=error");
    exit();
}
?>
