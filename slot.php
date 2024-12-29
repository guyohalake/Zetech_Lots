<?php
include "connect.php";

// Function to park a car
function parkCar($carId) {
    global $conn;

    if (empty($carId)) {
        return "Car ID is required.";
    }

    // Find the first available spot
    $stmt = $conn->prepare("SELECT * FROM parking_spots WHERE car_id IS NULL LIMIT 1");
    $stmt->execute();
    $spot = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($spot) {
        // Park the car in the available spot
        $stmt = $conn->prepare("UPDATE parking_spots SET car_id = :car_id WHERE spot_number = :spot_number");
        $stmt->execute(['car_id' => $carId, 'spot_number' => $spot['spot_number']]);
        return "Car parked at spot: " . $spot['spot_number'];
    } else {
        return "No available spots.";
    }
}

// Function to remove a car (leave a spot)
function leaveSpot($spotNumber) {
    global $conn;

    if (empty($spotNumber)) {
        return "Spot number is required.";
    }

    // Check if the spot is occupied
    $stmt = $conn->prepare("SELECT * FROM parking_spots WHERE spot_number = :spot_number AND car_id IS NOT NULL");
    $stmt->execute(['spot_number' => $spotNumber]);
    $spot = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($spot) {
        // Remove the car from the spot
        $stmt = $conn->prepare("UPDATE parking_spots SET car_id = NULL WHERE spot_number = :spot_number");
        $stmt->execute(['spot_number' => $spotNumber]);
        return "Spot " . $spotNumber . " is now empty.";
    } else {
        return "Invalid spot number or the spot is already empty.";
    }
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; // Either 'park' or 'leave'
    
    if ($action === 'park') {
        $carId = $_POST['carId'];
        $result = parkCar($carId);
    } elseif ($action === 'leave') {
        $spotNumber = $_POST['spotNumber'];
        $result = leaveSpot($spotNumber);
    } else {
        $result = "Invalid action.";
    }

    echo $result;
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

  <div class="controls">
    <input type="text" id="carId" placeholder="Enter Car ID">
    <button onclick="parkCar()">Park Car</button>
    <input type="number" id="spotNumber" placeholder="Enter Spot Number">
    <button onclick="leaveSpot()">Leave Spot</button>
  </div>


  
  <script>
    const totalSpots = 20;  // Total number of parking spots
    let parkingSpots = new Array(totalSpots).fill(null);  // Null means spot is available

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
        // Send park car request to the server
        fetch('parking_system.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `action=park&carId=${carId}`
        })
        .then(response => response.text())
        .then(data => {
          alert(data);  // Display response from the server
          parkingSpots[availableSpot] = carId;  // Update the frontend
          generateParkingSpots();  // Refresh the parking spots
          document.getElementById('carId').value = '';  // Clear input
        })
        .catch(error => console.error('Error:', error));
      } else {
        alert('No available spots!');
      }
    }

    // Function to leave a spot
    function leaveSpot() {
      const spotNumber = parseInt(document.getElementById('spotNumber').value, 10);

      if (spotNumber < 1 || spotNumber > totalSpots || !parkingSpots[spotNumber - 1]) {
        alert('Invalid spot number or the spot is already empty!');
        return;
      }

      // Send leave spot request to the server
      fetch('parking_system.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `action=leave&spotNumber=${spotNumber}`
      })
      .then(response => response.text())
      .then(data => {
        alert(data);  // Display response from the server
        parkingSpots[spotNumber - 1] = null;  // Update the frontend
        generateParkingSpots();  // Refresh the parking spots
        document.getElementById('spotNumber').value = '';  // Clear input
      })
      .catch(error => console.error('Error:', error));
    }

    // Initial setup
    window.onload = generateParkingSpots;
  </script>
</body>
</html>
