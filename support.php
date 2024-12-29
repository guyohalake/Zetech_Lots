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










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home_page</title>
    <link rel="stylesheet" href="support.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c5cdba9a5c.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="nav_container">
<img src="HOMElogo.png" class="logo">

<div class="nav_links">
<ul>
    <a href="/home.php"><li>Home</li></a>
    <a href="#"><li>Support</li></a>
    <a href="login form.php"><li>LogIn</li></a>
</ul>

</div>
    </div>
    <br><br>







    

    <section class="contact" id="contact">
        <div class="container">

          <div class="contact-content">
            <h2 class="h2 contact-title">Got Any Questions?? Feel Free To Reach US</h2>

            <figure class="contact-banner">
             
            </figure>
          </div>

          <form action="" class="contact-form">

            <div class="input-wrapper">
              <label for="name" class="input-label">Name *</label>
              <input type="text" name="name" id="name" required placeholder="Type Name" class="input-field">

              
            </div>

            <div class="input-wrapper">
              <label for="phone" class="input-label">Phone</label>

              <input type="tel" name="phone" id="phone" placeholder="Type Phone Number" class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="email" class="input-label">Email Address *</label>

              <input type="email" name="email" id="email" required placeholder="Type Email Address" class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="message" class="input-label">How can we help? *</label>

              <textarea name="message" id="message" placeholder="Type Description" required
                class="input-field"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>

          </form>

        </div>
      </section>

    </article>

  </main>














    
  </div>


    <footer class="footer">
<h2>Contact Information</h2>
<div class="contact_info">

   <span class="icon">
    <i class="fa-solid fa-phone"></i>
    <p>0769295800</p>
   </span>

   <span class="icon">
    <i class="fa-brands fa-whatsapp"></i>
    <p>0769295800</p>
   </span>

   <span class="icon">
    <i class="fa-solid fa-envelope"></i>
    <p>mukavivictor@gmail.com</p>
   </span>

   <span class="icon">
    <i class="fa-brands fa-instagram"></i>
    <p>@mukavi</p>
   </span>
   

</div>
    </footer>





</body>
</html>