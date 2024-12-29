<?php
include "connect.php";

if(isset($_POST['Submit'])){
    // Fetch form data
    $Owners_Name = $_POST['Owners_Name'] ?? null;
    $Owners_Phone = $_POST['Owners_Phone'] ?? null;
    $Car_Model = $_POST['Car_Model'] ?? null;
    $Car_No_Plate = $_POST['Car_No_Plate'] ?? null;
    $Assigned_Parking_Spot = $_POST['Assigned_Parking_Spot'] ?? null;

    // Ensure all fields are set before proceeding
    if ($Owners_Name && $Owners_Phone && $Car_Model && $Car_No_Plate && $Assigned_Parking_Spot) {
        // Prepare SQL query with the correct table name
        $sql = "INSERT INTO car_detail_table (Owners_Name, Owners_Phone, Car_Model, Car_No_Plate, Assigned_Parking_Spot) 
                VALUES ('$Owners_Name', '$Owners_Phone', '$Car_Model', '$Car_No_Plate', '$Assigned_Parking_Spot')";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if($result){
            header('location: home.php');
        } else {
            die("Error: " . mysqli_error($conn));
        }
    } else {
        echo "All fields are required!";
    }
}

// Close the connection
mysqli_close($conn);
?>







    






















<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Record New Car Details</title>
  <link rel="stylesheet" href="record car details.css">
</head>
<body>

  <!-- Car Details Section -->
  <div class="car-details-section">
    <h2>Record New Car Details</h2>
    <form id="car-details-form" method= "POST">
      
      <!-- Owner's Information -->
      <div class="form-group">
        <label for="owner-name">Owner's Name:</label>
        <input type="text" id="owner-name" name="Owners_Name" placeholder="Enter owner's name" required>
      </div>

      <div class="form-group">
        <label for="owner-phone">Owner's Phone:</label>
        <input type="tel" id="owner-phone" name="Owners_Phone" placeholder="Enter owner's phone number" required>
      </div>
      
      <!-- Car Information -->
      <div class="form-group">
        <label for="car-make">Car Model:</label>
        <input type="text" id="car-make" name="Car_Model" placeholder="Enter car make (e.g., Toyota)" required>
       
      </div>

     

      <div class="form-group">
        <label for="license-plate">Car No.Plate:</label>
        <input type="text" id="license-plate" name="Car_No_Plate" placeholder="Enter license plate number" required>
      </div>

      <div class="form-group">
        <label for="parking-spot">Assigned Parking Spot:</label>
        <input type="text" id="parking-spot" name="Assigned_Parking_Spot" placeholder="Enter assigned parking spot" required>
      </div>

      <button type="submit" name="Submit">Submit Car Details</button>
    </form>

    <!-- Confirmation Message -->
    <div id="confirmation-message"></div>
  </div>

  <script src="script.js"></script>
</body>
</html>
