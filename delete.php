<?php
include("connection.php");
$id = $_GET['ration_no'];
$query="DELETE FROM form where ration_no='$id'";
$data= mysqli_query($conn,$query);
if($data)
{
    echo "<script>alert('Record Deleted')</script>";

    ?>
        <meta http-equiv = "refresh" content = "0; url = http://localhost:8080/php_project/viewslot.php" />

    <?php

}
else
{
    echo "<script>alert('Failed to Delete)</script>";

}
?>