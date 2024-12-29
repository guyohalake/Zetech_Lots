<?php
include "connect.php";

if(isset($_POST['Submit'])) {
    // Fetch form data
    $Full_Name = $_POST['Full_Name'] ?? null;
    $Phone_Number = $_POST['Phone_Number'] ?? null;
    $Email = $_POST['Email'] ?? null;
    $User_Type = $_POST['User_Type'] ?? null;
    $Password = $_POST['Password'] ?? null;
    $Confirm_Password = $_POST['Confirm_Password'] ?? null;

    // Ensure all fields are set before proceeding
    if ($Full_Name && $Phone_Number && $Email && $User_Type && $Password && $Confirm_Password) {
        
        // Check if passwords match
        if ($Password !== $Confirm_Password) {
            die("Passwords do not match!");
        }

        // Hash the password before storing it
        $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

        // Prepare SQL query without the Confirm_Password field
        $sql = "INSERT INTO admin_table (Full_Name, Phone_Number, Email, User_Type, Password) 
                VALUES ('$Full_Name', '$Phone_Number', '$Email', '$User_Type', '$hashed_password')";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            header('location:login form.php');
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
