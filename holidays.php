<?php
function fetchIndianHolidays($year, $api_key) {
    $url = "https://calendarific.com/api/v2/holidays?api_key=$api_key&country=IN&year=$year";

    // Make a GET request to the API
    $response = file_get_contents($url);

    if ($response === FALSE) {
        die("Error: Unable to fetch holidays from API.");
    }

    // Decode JSON response
    $data = json_decode($response, true);

    // Parse the holidays
    $holidays = [];
    foreach ($data['response']['holidays'] as $holiday) {
        $date = $holiday['date']['iso']; 
        $name = $holiday['name'];        
        $holidays[$date] = $name;       
    }

    return $holidays;
}
?>