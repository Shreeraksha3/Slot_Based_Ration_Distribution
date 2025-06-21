<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];


$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  echo json_encode(["success" => false, "message" => "Username already exists."]);
} else {
 
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

 
  $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
  if (mysqli_query($conn, $insert_query)) {
    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "message" => "Failed to create account."]);
  }
}
?>
