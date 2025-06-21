<?php
    include("connection.php");
    error_reporting(0);
   $query = "SELECT *FROM form";
   $data= mysqli_query($conn,$query);

   $total= mysqli_num_rows($data);
   
   
   
   //echo $total;

   if($total!=0)
   {
      ?>
    <table border="3">
       <tr> 
        <th>Ration Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Profession</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Members</th>
      </tr>

    <?php
    //echo "Table has Records";
    while($result=mysqli_fetch_assoc($data))
    {
        echo "<tr> 
        <td>".$result['ration_no']."</td>
        <td>".$result['fname']."</td>
        <td>".$result['lname']."</td>
        <td>".$result['age']."</td>
        <td>".$result['profession']."</td>
        <td>".$result['address']."</td>
        <td>".$result['phone']."</td>
        <td>".$result['members']."</td>
        
        
        
      </tr>";
    }
    }
   else
   {
    echo "No Records found";
   }

?>
</table>
