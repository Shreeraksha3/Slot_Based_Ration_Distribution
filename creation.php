<?php include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slot Creation</title>
  <link rel="stylesheet" href="creation1.css">
</head>
<body>
  <div class="container">
    <header class="top-header">
      <div class="title">Ration Distribution System</div>
      <button class="logout-button" onclick="redirectToLoginLogout()">Logout</button>
    </header>
    </header>

    <div class="content-wrapper">
      <div class="sidebar">
        <button class="menu-btn" onclick="goToDashboard()">Dashboard</button>
        <button class="menu-btn" onclick="goToManageUsers()">Manage Users</button>
        <button class="menu-btn active" onclick="goToSlotCreation()">Slot Creation</button>
        <button class="menu-btn" onclick="goToSlotAllocation()">Slot Allocation</button>
        <button class="menu-btn" onclick="goToViewSlot()">View Details</button>
      </div>

      <div class="main-content">
        <div class="content">
          <h2>Create Slot</h2>
          <form id="slotForm" action="#" method="POST">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>

            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required>

            <label for="break_start_time">Break Start Time:</label>
            <input type="time" id="break_start_time" name="break_start_time" required>

            <label for="break_end_time">Break End Time:</label>
            <input type="time" id="break_end_time" name="break_end_time" required>

            <label for="duration">Slot Duration (minutes):</label>
            <input type="number" id="duration" name="duration" min="1" required>

            <button type="submit" name="create_slot">Create Slot</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<script src="creation1.js"></script>
</body>
</html>


<?php
include("connection.php");

function fetchIndianHolidays($year, $api_key) {
    $url = "https://calendarific.com/api/v2/holidays?api_key=$api_key&country=IN&year=$year";
    $response = file_get_contents($url);
    if ($response === FALSE) {
        die("Error: Unable to fetch holidays from API.");
    }
    $data = json_decode($response, true);
    $holidays = [];
    foreach ($data['response']['holidays'] as $holiday) {
        $date = $holiday['date']['iso'];
        $holidays[$date] = $holiday['name'];
    }
    return $holidays;
}

if (isset($_POST['create_slot'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $break_start_time = $_POST['break_start_time'];
    $break_end_time = $_POST['break_end_time'];
    $duration = $_POST['duration'];

    // Fetch holidays for the current year
    $api_key = "r6gnWmbmlY8Drdu5b7xO0k1wpyE1n2mA"; //  Calendarific API key
    $year = date('Y', strtotime($start_date));
    $holidays = fetchIndianHolidays($year, $api_key);

    // Insert admin input into SLOT_CREATION table
    $query = "INSERT INTO SLOT_CREATION (start_date, end_date, start_time, end_time, break_start_time, break_end_time, duration) 
              VALUES ('$start_date', '$end_date', '$start_time', '$end_time', '$break_start_time', '$break_end_time', '$duration')";

    if (mysqli_query($conn, $query)) {
        echo "Admin data inserted into SLOT_CREATION table";

        // Converting times to minutes
        $start_minutes = strtotime($start_time);
        $end_minutes = strtotime($end_time);
        $break_start_minutes = strtotime($break_start_time);
        $break_end_minutes = strtotime($break_end_time);

        $current_date = $start_date;

        while (strtotime($current_date) <= strtotime($end_date)) {
            // Skip holidays and weekends
            $day_of_week = date('N', strtotime($current_date));
            if ($day_of_week == 7 || array_key_exists($current_date, $holidays)) {
                $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                continue;
            }

            $current_time = $start_minutes;
            while ($current_time + $duration * 60 <= $end_minutes) {
                // Skip break time
                if ($current_time >= $break_start_minutes && $current_time < $break_end_minutes) {
                    $current_time = $break_end_minutes;
                    continue; 
                }
                $slot_start_time = date('H:i:s', $current_time);
                $slot_end_time = date('H:i:s', $current_time + $duration * 60);

                // Insert the slot into the slots table
                $slot_query = "INSERT INTO slots (date, start_time, end_time) 
                               VALUES ('$current_date', '$slot_start_time', '$slot_end_time')";
                mysqli_query($conn, $slot_query);

                $current_time += $duration * 60;
            }

            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }

        echo "Slots created successfully!";
    } else {
        echo "Error inserting data into SLOT_CREATION: " . mysqli_error($conn);
    }
}
?>
