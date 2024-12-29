<?php
session_start();
include "connect.php";

?>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
   
    $username = $_POST['Full_Name'] ?? '';
    $password = $_POST['password'] ?? ''; 

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT * FROM admin_table WHERE Full_Name = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Use correct column name here
        $storedPassword = $user['password'] ?? null;

    

        if ($result){
            header('location:dashboard.php');
         }else {
             die("Error: " . mysqli_error($conn));
         }
     } else {
         echo "Error username";
     }
 }

?>



<form  method="POST">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="Full_Name" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="submit">Login</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="sign up.php">Sign up here</a>
        </div>
    </div>
</body>
</html>














<?php
session_start();
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
   
    $username = $_POST['Full_Name'] ?? '';
    $password = $_POST['password'] ?? ''; 

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT * FROM admin_table WHERE Full_Name = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Use correct column name here
        $storedPassword = $user['password'] ?? null;
        if ($result){
            header('location:dashboard.php');
         }else {
             die("Error: " . mysqli_error($conn));
         }
     } else {
         echo "Error username";
     }
 }

?>