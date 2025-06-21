<?php include("connection.php"); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cardholder Registration</title>
  <link rel="stylesheet" href="form1.css">
</head>
<body>
  <div class="top-header">
    <div class="title">Ration Distribution System</div>
    <button class="logout-button" onclick="redirectToLoginLogout()">Logout</button>
  </div>
  <div class="sidebar">
    <button onclick="goToDashboard()">Dashboard</button>
  
    <div class="dropdown">
      <button class="dropdown-button" onclick="toggleDropdown()">Manage Users ▾</button>
      <div class="dropdown-content">
        <button onclick="goToAddUser()">Add User</button>
        <button onclick="goToUpdateDetails()">Update User</button>
        <button onclick="goToDeleteUser()">Delete User</button>
      </div>
    </div>
  
    <button onclick="goToSlotCreation()">Slot Creation</button>
    <button onclick="goToSlotAllocation()">Slot Allocation</button>
    <button onclick="goToViewSlot()">View Details</button>
  </div>

  <div class="main-content">
    <h1 class="header-title">Cardholder Registration</h1>
    <div class="form-wrapper">
      <div class="form-container">
        <div class="form-border-container">
          <form action="#" method="POST">
            <div class="form-group">
              <label for="rationNumber">Ration Number</label>
              <input type="text" id="rationNumber" placeholder="Enter Ration Number" name="ration_no" required>
            </div>
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" id="fname" placeholder="Enter First Name" name="fname" required>
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" placeholder="Enter Last Name" name="lname">
            </div>
            <div class="form-group">
              <label for="age">Age</label>
              <input type="number" id="age" placeholder="Enter Age" name="age" required>
            </div>

            <!-- Disability Field (Dropdown) styled as input -->
            <div class="form-group">
              <label for="disability">Disability</label>
              <select id="disability" name="disability" class="custom-select" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>

            <!-- Profession Field (Dropdown) styled as input -->
            <div class="form-group">
              <label for="profession">Profession</label>
              <select id="profession" name="profession" class="custom-select" required>
                <option value="Employed">Employed</option>
                <option value="Unemployed">Unemployed</option>
              </select>
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" placeholder="Enter Address" name="address" required>
            </div>
            <div class="form-group">
              <label for="phoneNumber">Phone Number</label>
              <input type="text" id="phoneNumber" placeholder="Enter Phone Number" name="phno" required>
            </div>
            <div class="form-group">
              <label for="members">Members</label>
              <input type="number" id="members" placeholder="Enter Number of Members" name="members" required>
            </div>
            <button class="submit-button" type="submit" name="add_user">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="form1.js"></script>
</body>
</html>

<?php
  if(isset($_POST['add_user']))
  {
    $ration_no=$_POST['ration_no'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $disability=$_POST['disability'];
    $profession=$_POST['profession'];
    $address=$_POST['address'];
    $phone=$_POST['phno'];
    $members=$_POST['members'];
    
    $query = "INSERT INTO FORM (ration_no,fname,lname,age,disability,profession,address,phone,members) VALUES ('$ration_no', '$fname', '$lname', '$age','$disability', '$profession', '$address', '$phone', '$members')";
    $data = mysqli_query($conn,$query);
    if($data)
    {
        echo "Data Inserted into Database";
    }
    else{
        echo "failed";
    }
  }
?>
