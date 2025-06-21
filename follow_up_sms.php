<?php
require_once 'vendor/autoload.php'; // Twilio SDK

use Twilio\Rest\Client;

// Twilio credentials
    $sid = "your twilio sid";
    $token = 'your twilio token';
    $from =' twilio number ';
    
$client = new Client($sid, $token);

// Function to send follow-up SMS
function sendFollowUpSMS($phone, $name, $old_slot_date, $old_start_time, $old_end_time, $new_slot_date, $new_start_time, $new_end_time) {
    global $client, $from;

    // Compose the message with the new reallocated slot details
    $message = $client->messages->create(
        $phone, 
        [
            'from' => $from,
            'body' => "Dear {$name}, you missed your slot on {$old_slot_date} from {$old_start_time} to {$old_end_time}. Your new reallocated slot is on {$new_slot_date} from {$new_start_time} to {$new_end_time}. Please collect your ration on time."
        ]
    );

  
    if ($message->sid) {
        echo "<div class='alert-message'>Follow-up SMS sent successfully to $phone</div>";
    } else {
        echo "<div class='alert-message'>Failed to send follow-up SMS to $phone</div>";
    }
}

function checkAndReallocate($conn) {
    // Get the current date
    $current_date = date('Y-m-d');

    $query = "
        SELECT s.id, s.ration_no, s.slot_date, s.start_time, s.end_time, f.phone, f.fname, f.lname
        FROM slot_allocations s
        JOIN FORM f ON s.ration_no = f.ration_no
        WHERE s.slot_date < '$current_date' 
        AND s.is_collected = 0
        AND s.follow_up_sent = 0"; 

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $allocation_id = $row['id'];
            $phone = $row['phone'];
            $name = $row['fname'] . " " . $row['lname'];
            $old_slot_date = $row['slot_date'];
            $old_start_time = date('h:i A', strtotime($row['start_time']));
            $old_end_time = date('h:i A', strtotime($row['end_time']));

            // Find a new available slot
            $available_slot_query = "
                SELECT s.id, s.date, s.start_time, s.end_time
                FROM slots s
                LEFT JOIN slot_allocations sa ON s.id = sa.id
                WHERE sa.id IS NULL AND s.date > '$current_date' 
                ORDER BY s.date, s.start_time
                LIMIT 1"; //  next available slot

            $available_slot_result = mysqli_query($conn, $available_slot_query);

            if (mysqli_num_rows($available_slot_result) > 0) {
                $available_slot = mysqli_fetch_assoc($available_slot_result);
                $new_slot_id = $available_slot['id'];
                $new_slot_date = $available_slot['date'];
                $new_start_time = date('h:i A', strtotime($available_slot['start_time']));
                $new_end_time = date('h:i A', strtotime($available_slot['end_time']));

                // Reallocate the slot 
                $update_query = "UPDATE slot_allocations SET id = $new_slot_id WHERE id = $allocation_id";
                mysqli_query($conn, $update_query);

                // Send the follow-up SMS with the new allocated slot details
                sendFollowUpSMS($phone, $name, $old_slot_date, $old_start_time, $old_end_time, $new_slot_date, $new_start_time, $new_end_time);

                // Update follow_up_sent to 1 
                $update_follow_up_query = "UPDATE slot_allocations SET follow_up_sent = 1 WHERE id = $allocation_id";
                mysqli_query($conn, $update_follow_up_query);

                //echo "Slot successfully reallocated to $name and follow-up SMS sent.<br>";
            } else {
                echo "No available slot for reallocation.<br>";
            }
        }
    }
}


checkAndReallocate($conn);
?>
