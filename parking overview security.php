<?php
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $actionType = $_POST['actionType'] ?? '';


  if ($actionType === 'Park_Car') {
      // Handle park car logic
      $Car_ID = trim($_POST['Car_ID'] ?? '');
      $Spot_Number = trim($_POST['Spot_Number'] ?? '');
      
      if (!empty($Car_ID) && !empty($Spot_Number)) {
          $sql = "INSERT INTO parking_spots (spot_number, car_id) 
                  VALUES ('$Spot_Number', '$Car_ID')";
          $result = mysqli_query($conn, $sql);

          if ($result) {
              header('Location: parking overview security.php');
              exit();
          } else {
              die("Error: " . mysqli_error($conn));
          }
      } else {
          echo "All fields are required!";
      }
  } elseif ($actionType === 'Leave_Spot') {
      // Handle leave spot logic
      $Car_ID = trim($_POST['Car_ID'] ?? '');
      
      if (!empty($Car_ID)) {
          $sql = "DELETE FROM parking_spots WHERE car_id = '$Car_ID'";
          $result = mysqli_query($conn, $sql);

          if ($result) {
              header('Location: parking overview security.php');
              exit();
          } else {
              die("Error: " . mysqli_error($conn));
          }
      } else {
          echo "Car ID is required to leave a spot!";
      }
  }
}

?>











<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Parking System</title>
 <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    text-align: center;
    padding: 20px;
  }
  
  .parking-lot {
    display: grid;
    grid-template-columns: repeat(5, 100px);
    gap: 10px;
    margin: 20px auto;
  }
  
  .parking-spot {
    width: 100px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #d3d3d3;
    border: 2px solid #999;
    border-radius: 5px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
  }
  
  .occupied {
    background-color: #f44336;
    color: white;
  }
  
  .controls {
    margin-top: 20px;
  }
  
  input, button {
    padding: 10px;
    margin: 5px;
    font-size: 16px;
  }
  
 </style>




</head>
<body>
  <h1>Car Parking System</h1>

  <div class="parking-lot" id="parkingLot">
    <!-- Parking spots will be dynamically generated here -->
     
  </div>


  <form id="parkingForm" method="POST" action="">
  <div class="controls">
    <input type="text" id="carId" placeholder="Enter Car ID" name="Car_ID" required>
    <input type="text" id="spotNumber" placeholder="Enter Spot Number" name="Spot_Number" required>
    <input type="hidden" id="actionType" name="actionType" value="">
    <button type="button" onclick="setActionAndSubmit('Park_Car')">Park Car</button>
    <button type="button" onclick="setActionAndSubmit('Leave_Spot')">Leave Spot</button>
  </div>
</form>





  <script>
    



const totalSpots = 20;  // Total number of parking spots
const parkingSpots = new Array(totalSpots).fill(null);  // Null means spot is available

// Function to generate parking spots in the UI
function generateParkingSpots() {
  const parkingLot = document.getElementById('parkingLot');
  parkingLot.innerHTML = '';  // Clear existing spots

  for (let i = 0; i < totalSpots; i++) {
    const spot = document.createElement('div');
    spot.className = 'parking-spot';
    spot.textContent = i + 1;

    if (parkingSpots[i]) {
      spot.classList.add('occupied');
      spot.textContent = `Car ${parkingSpots[i]}`;
    }

    parkingLot.appendChild(spot);
  }
}

// Function to park a car in the first available spot
function parkCar() {
  const carId = document.getElementById('carId').value;

  if (!carId) {
    alert('Please enter a Car ID!');
    return;
  }

  const availableSpot = parkingSpots.indexOf(null);

  if (availableSpot !== -1) {
    parkingSpots[availableSpot] = carId;
    generateParkingSpots();
    document.getElementById('carId').value = '';  // Clear input
  } else {
    alert('No available spots!');
  }
}

// Function to leave a spot
function leaveSpot() {
  const spotNumber = parseInt(document.getElementById('spotNumber').value, 20);

  if (spotNumber < 1 || spotNumber > totalSpots || !parkingSpots[spotNumber - 1]) {
    alert('Invalid spot number or the spot is already empty!');
    return;
  }

  parkingSpots[spotNumber - 1] = null;
  generateParkingSpots();
  document.getElementById('spotNumber').value = '';  // Clear input
}

// Initial setup
window.onload = generateParkingSpots;








function parkCar() {
    // Perform your important event for parking here
    console.log("Executing parkCar event...");
    // Optionally, validate data before submitting
    if (document.getElementById('carId').value && document.getElementById('spotNumber').value) {
        // Submit the form programmatically
        document.getElementById('parkingForm').submit();
    } else {
        alert("Please fill in all required fields.");
    }
}

function leaveSpot() {
    // Perform your important event for leaving here
    console.log("Executing leaveSpot event...");
    // Optionally, validate data before submitting
    if (document.getElementById('carId').value) {
        // Submit the form programmatically
        document.getElementById('parkingForm').submit();
    } else {
        alert("Car ID is required to leave a spot.");
    }
}















function setActionAndSubmit(action) {
    // Set the hidden input value
    document.getElementById('actionType').value = action;

    // Perform any additional important events here
    console.log(`Action set to: ${action}`);

    // Submit the form programmatically
    document.getElementById('parkingForm').submit();
}










  </script>
  
</body>
</html>
