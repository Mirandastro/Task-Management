function goToSignUpPage() {
  window.location.href = 'sign-up.php';
}

document.addEventListener("DOMContentLoaded", function() {
  var loginForm = document.getElementById('loginForm');
  var passwordField = document.getElementById('password');

  loginForm.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting

      var email = document.querySelector('input[name="email"]').value;
      var password = passwordField.value;

      // Check if the provided email and password match the temporary account
      if (email === 'abc@example.com' && password === 'Abc123456') {
          // Redirect to the dashboard.html page
          window.location.href = 'dashboard.php';
      } else {
          alert('Invalid email or password. Please try again.');
      }
  });
});

document.addEventListener("DOMContentLoaded", function() {
  var forgotPassword = document.querySelector('.psw a');
  forgotPassword.addEventListener('click', function(event) {
    event.preventDefault(); 
    var email = prompt('Please enter your email to reset the password');
    
    if (email) {
      alert('An email has been sent to ' + email + ' with further instructions.');
    }
  });
});