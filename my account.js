// Handle profile form submission
document.getElementById('profile-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
  
    alert(`Profile updated!\nName: ${name}\nEmail: ${email}\nPhone: ${phone}`);
  });
  
  // Handle password change form submission
  document.getElementById('password-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
  
    if (newPassword === confirmPassword) {
      alert('Password successfully changed!');
    } else {
      alert('New password and confirm password do not match!');
    }
  });
  
  // Handle notification preferences form submission
  document.getElementById('notification-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const emailNotifications = document.getElementById('email-notifications').checked;
    const smsNotifications = document.getElementById('sms-notifications').checked;
  
    alert(`Notification Preferences Updated:\nEmail Notifications: ${emailNotifications}\nSMS Notifications: ${smsNotifications}`);
  });
  

  <script src="my account.js"></script>