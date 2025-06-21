<?php
include("connection.php");
include('follow_up_sms.php');

require_once 'vendor/autoload.php'; // Twilio SDK

use Twilio\Rest\Client;
// Fetch the latest slot creation details
$date_query = "SELECT start_date, end_date, start_time, end_time, break_start_time, break_end_time, duration 
               FROM SLOT_CREATION ORDER BY id DESC LIMIT 1";
$date_result = mysqli_query($conn, $date_query);

if ($date_result && $date_row = mysqli_fetch_assoc($date_result)) {
    $start_date = $date_row['start_date'];
    $end_date = $date_row['end_date'];
    $start_time = $date_row['start_time'];
    $end_time = $date_row['end_time'];
    $break_start_time = $date_row['break_start_time'];
    $break_end_time = $date_row['break_end_time'];
    $duration = $date_row['duration'];
} else {
    $start_date = $end_date = $start_time = $end_time = $break_start_time = $break_end_time = $duration = null;
}


$slots_query = "SELECT * FROM slots WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY date, start_time";
$slots_result = mysqli_query($conn, $slots_query);

// Fetch all users who haven't been assigned a slot yet
$users_query = "SELECT * FROM FORM WHERE ration_no NOT IN (SELECT ration_no FROM slot_allocations)";
$users_result = mysqli_query($conn, $users_query);

// Arrays to classify users based on priority
$priority_users = [];  // Age >= 60 or disability = 'Yes'
$evening_users = [];   // Employed users
$other_users = [];     // Other users

// Classify users into priority groups
while ($user = mysqli_fetch_assoc($users_result)) {
    $age = $user['age'];
    $disability = strtoupper($user['disability']); 
    $profession = strtoupper($user['profession']); 

    if ($age >= 60 || $disability == "YES") {
        $priority_users[] = $user;
    } elseif ($profession == "EMPLOYED") {
        $evening_users[] = $user;
    } else {
        $other_users[] = $user;
    }
}

if (mysqli_num_rows($slots_result) == 0 && $start_date && $end_date) {
   
    die("No slots available for allocation. Please create slots first.");
}


$current_date = $start_date;
while (strtotime($current_date) <= strtotime($end_date)) {
   
    $slots_query = "SELECT * FROM slots WHERE date = '$current_date' ORDER BY start_time";
    $daily_slots = mysqli_query($conn, $slots_query);

    $morning_slots = [];
    $evening_slots = [];
    $other_slots = [];

    // Classify slots into morning, evening, and remaining
    while ($slot = mysqli_fetch_assoc($daily_slots)) {
        $slot_start_time = $slot['start_time'];
        $slot_end_time = $slot['end_time'];

        // Morning slots 
        if (strtotime($slot_start_time) < strtotime('11:00:00')) {
            $morning_slots[] = $slot;
        }
        // Evening slots
        elseif (strtotime($slot_start_time) >= strtotime('16:30:00')) {
            $evening_slots[] = $slot;
        }
        // Other slots
        else {
            $other_slots[] = $slot;
        }
    }

    // Assign morning slots to priority users
    foreach ($morning_slots as $slot) {
        if (count($priority_users) > 0) {
            $user = array_shift($priority_users); // Assign to next priority user
            $ration_no = $user['ration_no'];
            $allocate_slot_query = "INSERT INTO slot_allocations (ration_no, slot_date, start_time, end_time) 
            VALUES ('$ration_no', '$current_date', 
                    TIME_FORMAT('{$slot['start_time']}', '%h:%i %p'), 
                    TIME_FORMAT('{$slot['end_time']}', '%h:%i %p'))";
mysqli_query($conn, $allocate_slot_query);

            
            sendSMS($user['phone'], $user['fname'] . ' ' . $user['lname'], $current_date, date('h:i A', strtotime($slot['start_time'])), date('h:i A', strtotime($slot['end_time'])));


        } else {
            break; 
        }
    }

    // Assign evening slots to employed users
    foreach ($evening_slots as $slot) {
        if (count($evening_users) > 0) {
            $user = array_shift($evening_users); // Assign to next evening user
            $ration_no = $user['ration_no'];
            $allocate_slot_query = "INSERT INTO slot_allocations (ration_no, slot_date, start_time, end_time) 
            VALUES ('$ration_no', '$current_date', 
                    TIME_FORMAT('{$slot['start_time']}', '%h:%i %p'), 
                    TIME_FORMAT('{$slot['end_time']}', '%h:%i %p'))";
mysqli_query($conn, $allocate_slot_query);

           
            sendSMS($user['phone'], $user['fname'] . ' ' . $user['lname'], $current_date, date('h:i A', strtotime($slot['start_time'])), date('h:i A', strtotime($slot['end_time'])));

        } else {
            break; 
        }
    }

    // Assign remaining slots to other users
    foreach ($other_slots as $slot) {
        if (count($other_users) > 0) {
            $user = array_shift($other_users); // Assign to next other user
            $ration_no = $user['ration_no'];
            $allocate_slot_query = "INSERT INTO slot_allocations (ration_no, slot_date, start_time, end_time) 
            VALUES ('$ration_no', '$current_date', 
                    TIME_FORMAT('{$slot['start_time']}', '%h:%i %p'), 
                    TIME_FORMAT('{$slot['end_time']}', '%h:%i %p'))";
            mysqli_query($conn, $allocate_slot_query);
            sendSMS($user['phone'], $user['fname'] . ' ' . $user['lname'], $current_date, date('h:i A', strtotime($slot['start_time'])), date('h:i A', strtotime($slot['end_time'])));

        } else {
            break; 
        }
    }

    // Move to the next day
    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
}
    function sendSMS($phone, $name, $date, $start_time, $end_time) {
        
    $sid = "your twilio sid";
    $token = 'your twilio token';
    $from =' twilio number ';
    
        $client = new Client($sid, $token);
    
        // Send SMS
        $message = $client->messages->create(
            $phone, 
            [
                'from' => $from,
                'body' => "Dear {$name}, your slot for ration collection is allotted on {$date} from {$start_time} to {$end_time}.Please collect your ration on time."
            ]
        );
    
        
        if ($message->sid) {
            echo "<div class='alert-message'>SMS sent successfully to $phone</div>";
        } else {
            echo "<div class='alert-message'>Failed to send SMS to $phone</div>";
        }
        
        
    }


// Fetch allocated slots and user details for display
$query = "
    SELECT s.slot_date, s.start_time, s.end_time, f.ration_no, f.fname, f.lname, f.phone, s.is_collected, s.Id AS allocation_id
    FROM slot_allocations s
    JOIN FORM f ON s.ration_no = f.ration_no
    ORDER BY s.slot_date ASC, STR_TO_DATE(s.start_time, '%H:%i:%s') ASC";

    $result = mysqli_query($conn, $query);
    checkAndReallocate($conn)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slot Allocation</title>
  <link rel="stylesheet" href="allocation1.css">
</head>
<body>
<div class="container">
    <header class="top-header">
      <div class="title">Ration Management System</div>
      <button class="logout-button" onclick="redirectToLoginLogout()">Logout</button>
    </header>

    </header>

    <div class="content-wrapper">
      <div class="sidebar">
        <button class="menu-btn" onclick="goToDashboard()">Dashboard</button>
        <button class="menu-btn" onclick="goToManageUsers()">Manage Users</button>
        <button class="menu-btn" onclick="goToSlotCreation()">Slot Creation</button>
        <button class="menu-btn active" onclick="goToSlotAllocation()">Slot Allocation</button>
        <button class="menu-btn" onclick="goToViewSlot()">View Details</button>
      </div>

      <div class="main-content">
        <div class="content">
          <h2>Allocated Slots</h2>

          <!-- Delete Slot Creation Button -->
          <form action="delete_slots.php" method="POST" onsubmit="return confirmDeletion()">
              <button type="submit" name="delete_creation" 
                      <?php echo ($start_date && $end_date) ? '' : 'disabled'; ?>>Delete All Slots</button>
          </form>

          
          <table>
            <thead>
              <tr>
                <th>Ration Number</th>
                <th>Name</th>
                <th>Slot Date</th>
                <th>Slot Time</th>
                <th>Phone Number</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['ration_no'] . "</td>";
                      echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                      echo "<td>" . $row['slot_date'] . "</td>";
                      echo "<td>" . date('h:i ', strtotime($row['start_time'])) . " - " . date('h:i ', strtotime($row['end_time'])) . "</td>";


                      echo "<td>" . $row['phone'] . "</td>";
                      echo "<td>";
                if ($row['is_collected'] == 0) {
                    echo "<form method='POST' action='mark_collected.php'>
                            <input type='hidden' name='allocation_id' value='" . $row['allocation_id'] . "'>
                            <button type='submit' name='mark_collected'>Mark as Collected</button>
                          </form>";
                } else {
                    echo "Collected";
                }
                echo "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='5'>No slots allocated yet.</td></tr>";
              }
              ?>
             </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
<script>
function confirmDeletion() {
    console.log("Confirm function is triggered");
    var userConfirmed = confirm("Are you sure you want to delete the slot creation and all associated slots and allocations? This action cannot be undone.");
    if (userConfirmed) {
        console.log("User confirmed, submitting the form.");
        return true;  
    } else {
        console.log("User canceled, not submitting.");
        return false;  
    }
}
</script>
<script>
    // Function to hide all messages with the 'alert-message' class after 5 seconds
    setTimeout(() => {
        const alertMessages = document.querySelectorAll('.alert-message');
        alertMessages.forEach(message => {
            message.style.display = 'none';
        });
    }, 5000); // 5000ms = 5 seconds
</script>


<script src="allocation1.js"></script>
</body>
</html>