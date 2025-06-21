<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];


$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    
    // Verify password 
    if (password_verify($password, $user['password'])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid password."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid username or password."]);
}
?>
