<?php
include("connection.php");

if (isset($_POST['delete_creation'])) {
    // Fetch the latest slot creation entry to determine the date range
    $creation_query = "SELECT start_date, end_date FROM SLOT_CREATION ORDER BY id DESC LIMIT 1";
    $creation_result = mysqli_query($conn, $creation_query);

    if ($creation_result && $creation_row = mysqli_fetch_assoc($creation_result)) {
        $start_date = $creation_row['start_date'];
        $end_date = $creation_row['end_date'];

        // Step 1: Delete allocations linked to the slots in the date range
        $delete_allocations_query = "
            DELETE sa 
            FROM slot_allocations sa
            INNER JOIN slots s ON sa.slot_date = s.date
            WHERE s.date BETWEEN '$start_date' AND '$end_date'";
        mysqli_query($conn, $delete_allocations_query);

        // Step 2: Delete the slots
        $delete_slots_query = "DELETE FROM slots WHERE date BETWEEN '$start_date' AND '$end_date'";
        mysqli_query($conn, $delete_slots_query);

        // Step 3: Delete the slot creation 
        $delete_creation_query = "DELETE FROM SLOT_CREATION WHERE start_date = '$start_date' AND end_date = '$end_date'";
        mysqli_query($conn, $delete_creation_query);
    }

    // Redirect to the creation.php
    header("Location: creation.php");
    exit();
} else {
    // Redirect to creation.php
    header("Location: creation.php");
    exit();
}
?>
