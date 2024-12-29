<?php
session_start();
require 'connect.php';  


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Full_Name'];
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($username) && !empty($password)) {
        // Query to find the user in the database
        $stmt = $conn->prepare("SELECT User_Type , password  FROM admin_table WHERE Full_Name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
        
            $user = $result->fetch_assoc();

            // Verify the password using password_verify
            if (password_verify($password, $user['password'])) {

                // Store user information in session
                $_SESSION['Full_Name'] = $user['Full_Name'];
                $_SESSION['User_Type'] = $user['User_Type'];
                


                // Redirect based on user type
                switch ($user['User_Type']) {
                    case ' Security':
                        header("Location: dashboard security.php");
                        break;
                    case ' User':
                        header("Location: dashboard.php");
                        break;
                   

                    default:
                        echo "Invalid user type!";
                        break;
                }
            } else {
                echo "invalid_Password";
            }
        } else {
        echo "invalid_username";
        }
    } else {
        echo "all fields are requied";
    }
}
?>
































<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Zetech Lots</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f0f8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
            color: #2E7D32;
            font-size: 24px;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #2E7D32;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2E7D32;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1B5E20;
        }

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .signup-link a {
            color: #2E7D32;
            text-decoration: none;
        }

        .error {
            color: #d32f2f;
            background-color: #ffebee;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 1rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">Zetech Lots</div>
        <h2>Welcome Back</h2>
        <div id="error-message" class="error"></div>
        
       

        <form method="POST" action="login form.php">
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
