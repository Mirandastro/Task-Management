document.addEventListener("DOMContentLoaded", function() {
  var signupForm = document.getElementById('signupForm');
  var passwordField = document.getElementById('password');
  var passwordRepeatField = document.getElementById('password-repeat');

  signupForm.addEventListener('submit', function(event) {
    var password = passwordField.value;
    var passwordRepeat = passwordRepeatField.value;

    if (password !== passwordRepeat) {
      alert('Passwords do not match.');
      event.preventDefault();
      return;
    }

    if (!validatePassword(password)) {
      alert('Invalid password. It must contain at least 8 characters, at least one uppercase letter, one lowercase letter, and one number.');
      event.preventDefault(); 
    }
  });

  function validatePassword(password) {
    var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return re.test(password);
  }
});

function goToWelcomePage() {
  console.log('Function called');
  window.location.href = 'welcome-page.html';
}