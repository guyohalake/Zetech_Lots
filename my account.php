<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account - Dashboard</title>
  <link rel="stylesheet" href="my account.css">
</head>
<body>

  <!-- My Account Section -->
  <div class="my-account-section">
    <h2>My Account</h2>
    
    <!-- Profile Information -->
    <div class="profile-info">
      <h3>Profile Information</h3>
      <form id="profile-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="Vctor Mukavi" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="mkavivictor@gmail.com" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="071014037" required><br>

        <button type="submit">Update Profile</button>
      </form>
    </div>

    <!-- Password Change -->
    <div class="password-change">
      <h3>Change Password</h3>
      <form id="password-form">
        <label for="current-password">Current Password:</label>
        <input type="password" id="current-password" name="current-password" required><br>

        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" name="new-password" required><br>

        <label for="confirm-password">Confirm New Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required><br>

        <button type="submit">Change Password</button>
      </form>
    </div>

    <!-- Notification Preferences -->
    <div class="notification-preferences">
      <h3>Notification Preferences</h3>
      <form id="notification-form">
        <label for="email-notifications">Email Notifications:</label>
        <input type="checkbox" id="email-notifications" name="email-notifications" checked><br>

        <label for="sms-notifications">SMS Notifications:</label>
        <input type="checkbox" id="sms-notifications" name="sms-notifications"><br>

        <button type="submit">Update Preferences</button>
      </form>
    </div>
  </div>




  






  <script src="my account.js"></script>
</body>
</html>
