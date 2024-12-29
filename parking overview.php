<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Parking System</title>
  <link rel="stylesheet" href="parking overview.css">
</head>
<body>
  <h1>Car Parking System</h1>

  <div class="parking-lot" id="parkingLot">
    <!-- Parking spots will be dynamically generated here -->
  </div>

  


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


  </script>
</body>
</html>
