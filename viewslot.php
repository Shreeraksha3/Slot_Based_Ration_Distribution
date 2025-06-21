<?php
    include("connection.php");
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ration Distribution System</title>
    <link rel="stylesheet" href="viewslot1.css">
    <script>
       
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.menu-btn').forEach((button) => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.menu-btn').forEach((btn) => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
        });

       /* // Redirect Functions
        function goToDashboard() {
            window.location.href = "dashboard.html"; // Replace with the actual URL for Dashboard
        }

        function goToManageUsers() {
            window.location.href = "form.php"; // Replace with the actual URL for Manage Users
        }

        function goToSlotCreation() {
            window.location.href = "creation.php"; // Replace with the actual URL for Slot Creation
        }

        function goToSlotAllocation() {
            window.location.href = "allocation.php"; // Replace with the actual URL for Slot Allocation
        }

        function goToViewSlot() {
            window.location.href = "viewslot.php"; // Replace with the actual URL for View Slot
        }

        // Logout Redirect Function
        function logoutRedirect() {
            // Redirect to the desired page, for example, "login.php"
            window.location.href = "login.php";  // Replace "login.php" with your desired logout destination
        }

        // Delete Confirmation
        function checkdelete() {
            return confirm('Are you sure you want to delete this record?');
        }*/
    </script>
</head>
<body>
    <div class="container">
      
        <header class="top-header">
            <div class="title">Ration Distribution System</div>
            <button class="logout-button" onclick="redirectToLoginLogout()">Logout</button>
        </header>

      
        <div class="content-wrapper">
            <div class="sidebar">
                <button class="menu-btn" onclick="goToDashboard()">Dashboard</button>
                <button class="menu-btn" onclick="goToManageUsers()">Manage Users</button>
                <button class="menu-btn" onclick="goToSlotCreation()">Slot Creation</button>
                <button class="menu-btn" onclick="goToSlotAllocation()">Slot Allocation</button>
                <button class="menu-btn active" onclick="goToViewSlot()">View Slot</button>
            </div>

            <div class="main-content">
                <h2 class="page-title">User Details</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Ration Number</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Disability</th>
                                <th>Profession</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Members</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>                       
                               <?php
                               
                                $query = "SELECT ration_no, CONCAT(fname, ' ', lname) AS name, age, disability, profession, address, phone, members FROM form";
                                $data = mysqli_query($conn, $query);
                                $total = mysqli_num_rows($data);

                                
                                if ($total != 0) {
                                    while ($result = mysqli_fetch_assoc($data)) {
                                        echo "<tr>
                                                <td>{$result['ration_no']}</td>
                                                <td>{$result['name']}</td>
                                                <td>{$result['age']}</td>
                                                <td>{$result['disability']}</td>
                                                <td>{$result['profession']}</td>
                                                <td>{$result['address']}</td>
                                                <td>{$result['phone']}</td>
                                                <td>{$result['members']}</td>
                                                <td>
                                                    <div class='button-container'>
                                                        <a href='update.php?ration_no={$result['ration_no']}'>
                                                            <button class='update'>Update</button>
                                                        </a>
                                                        <a href='delete.php?ration_no={$result['ration_no']}' onclick='return checkdelete()'>
                                                            <button class='delete'>Delete</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No Records Found</td></tr>";
                                }
                            ?>
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <script src="viewslot1.js"></script> 
</body>
</html>
