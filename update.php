<?php include("connection.php");
$id = $_GET['ration_no'];

$query = "SELECT *FROM form where ration_no='$id'";
  $data= mysqli_query($conn,$query);



  $result=mysqli_fetch_assoc($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ration Management System</title>
  <link rel="stylesheet" href="form1.css">
</head>
<body>

  <header class="top-header">
    <button onclick="gotologin()" class="logout-button">Logout</button>
  </header>

 
  <div class="container">

    <div class="sidebar">
      <button onclick="goToDashboard()">Dashboard</button>
      <button class="active" onclick="goToManageUsers()">Manage Users</button>
      <button onclick="goToSlotCreation()">Slot Creation</button>
      <button onclick="goToSlotAllocation()">Slot Allocation</button>
      <button onclick="goToViewSlot()">View Details</button>
    </div>


    <div class="main-content">
      
      <div class="header">
        
      </div>

    
      <div class="form-wrapper">
      
        <form action="#" method="POST">
        <div class="form-container">
        
          <div class="form-border-container">
            <div class="form-group">
              <label for="rationNumber">Ration Number</label>
              <input type="text" id="rationNumber" value="<?php echo $result['ration_no'];?>" placeholder="Enter Ration Number" name="ration_no" required>
            </div>
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" id="fname" value="<?php echo $result['fname'];?>"placeholder="Enter First Name" name="fname" required>
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" value="<?php echo $result['lname'];?>" placeholder="Enter Last Name" name="lname">
            </div>
            <div class="form-group">
              <label for="age">Age</label>
              <input type="number" id="age" value="<?php echo $result['age'];?>" placeholder="Enter Age" name="age" required>
            </div>
            <div class="form-group">
              <label for="disability">Disability</label>
              <input type="text" id="disability" placeholder="Yes/No" name="disability" required>
            </div>
            <div class="form-group">
              <label for="profession">Profession</label>
              <input type="text" id="profession" value="<?php echo $result['profession'];?>" placeholder="Enter Profession" name="profession" required>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" value="<?php echo $result['address'];?>"placeholder="Enter Address" name="address" required>
            </div>
            <div class="form-group">
              <label for="phoneNumber">Phone Number</label>
              <input type="text" id="phoneNumber" value="<?php echo $result['phone'];?>" placeholder="Enter Phone Number" name="phno" required>
            </div>
            <div class="form-group">
              <label for="members">Members</label>
              <input type="number" id="members" value="<?php echo $result['members'];?>"placeholder="Enter Number of Members" name="members" required>
            </div>
           
            <button class="submit-button" onclick="addUser()" type="submit" name="update">Update Details</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
<script>
  function gotologin() {
    window.location.href = "login.html";
  }
  </script>
  <script src="form1.js"></script>

</body>
</html>

<?php
  if(isset($_POST['update']))
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
    
    

    $query = "UPDATE form 
    SET fname='$fname', lname='$lname', age='$age', disability='$disability', profession='$profession', address='$address', phone='$phone', members='$members'
    WHERE ration_no='$id'";

    
     $data = mysqli_query($conn,$query);
     if($data)
     {
        echo "<script>alert('Record Updated')</script>";
        ?>
        
        <meta http-equiv = "refresh" content = "0; url = http://localhost:8080/php_project/viewslot.php" />
        <?php
      }
      else{
        echo "failed";
      }
    }
    

?>