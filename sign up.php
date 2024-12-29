<?php




?>




<html>
    <head>
        <link rel="stylesheet" a href="sign up.css">
        <body>
            <div class="signup-container">
                <h2>Sign up as Visitor </h2>
                <form id="signup-container" action="insert.php" method="POST"> 
                <input type="text"placeholder="Full Name"   name="Full_Name"     required>
                <input type="text"placeholder="Phone number"     name="Phone_Number"    required>
                <input type="text"placeholder="Email"      name="Email"     required>
                <label for="">Security</label>
                <input type="radio"     name="User_Type"     value=" Security" required>
                <label for="">User</label>
                <input type="radio"     name="User_Type"   value=" User"  required>
                
    
   <input type="password" id="visitorpassword"placeholder="Password"     name="Password"     required>
   <span class ="show-password" onclick="togglepassword('visitor password')">Show password</span><br>
   <input type="password" id="visitorpassword" placeholder="Confirm password"    name="Confirm_Password"    required>
   <div class="forgot-password">
    <label>
        <input type="checkbox">Remembr me 
    </label>
    <a href="#">Forgot password</a>
   </div>
   <br>
   <div class="terms">
    <input type="checkbox" required> I agree to the<a href="terms and conditions.php">Terms and Conditions</a>
   </div>
   <button type="submit" class="btn"       name="Submit"      > Sign  Up</button>

  
            </form> ,


            </div>
        </body>
    </head>

 


</html>

