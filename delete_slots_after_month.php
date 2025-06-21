<?php
include("connection.php");

// Fetch the latest end date and end time from the SLOT_CREATION table
$query = "SELECT MAX(CONCAT(end_date, ' ', end_time)) AS latest_end_datetime FROM SLOT_CREATION";
$result = mysqli_query($conn, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $latest_end_datetime = $row['latest_end_datetime'];
    $current_datetime = date('Y-m-d H:i:s');  // Get the current date and time

    
    // Check if the current datetime is past the latest end datetime
    if ($current_datetime > $latest_end_datetime) {
       
        $delete_query = "DELETE FROM slots";
        
        
        if (mysqli_query($conn, $delete_query)) {
            
            // echo "All slots deleted successfully.";
        } else {
          
            // echo "Error deleting slots: " . mysqli_error($conn);
        }
    } else {
        
        // echo "Slots are still active. Current date and time is not past the end date and time.<br>";
    }
} else {

    // echo "Error fetching the latest end date: " . mysqli_error($conn);
}
?>
