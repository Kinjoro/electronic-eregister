document.addEventListener("DOMContentLoaded", function() {
    // Carousel
    let index = 0;
    const images = document.querySelectorAll('.carousel img');
    const interval = 3000; // 3 seconds

    function showNextImage() {
        images[index].classList.remove('active');
        index = (index + 1) % images.length;
        images[index].classList.add('active');
    }

    setInterval(showNextImage, interval);
    images[0].classList.add('active');

    // Form validation for login/register
    const loginButton = document.querySelector('.login-button');
    loginButton.addEventListener('click', function() {
        const userType = prompt("Are you an Admin or a Student?").toLowerCase();
        if (userType === 'admin') {
            window.location.href = 'register_admin.php?type=admin';
        } else if (userType === 'student') {
            window.location.href = 'register_student.php?type=student';
        } else {
            alert('Invalid input! Please enter Admin or Student.');
        }
    });
});


const registrationForm = document.getElementById('registration-form');
const errorMessage = document.getElementById('error-message');

registrationForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    // Basic validation (you can add more checks here)
    if (username.trim() === '' || password.trim() === '') {
        errorMessage.textContent = 'Please fill all fields';
        return;
    }

    // Send registration data to server (using AJAX or fetch API)
    // ... (example using fetch API)
    fetch('register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password, role })
    })
    .then(response => {
        if (response.ok) {
            // Successful registration, redirect or show success message
            errorMessage.textContent = 'Registration successful!';
            // Redirect to login or another page
        } else {
            return response.json();
        }
    })
    .then(data => {
        if (data) {
            errorMessage.textContent = data.message;
        }
    })
    .catch(error => {
        errorMessage.textContent = 'Error occurred. Please try again later.';
    });
});


//register form
// Get the form elements
const registrationNumberInput = document.getElementById('registration_number');
const schoolEmailInput = document.getElementById('school_email');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm_password');
const signupButton = document.getElementById('signup_button');
const loadingGif = document.getElementById('loading_gif');

// Add event listener to signup button
signupButton.addEventListener('click', (e) => {
  e.preventDefault();
  validateForm();
});

// Validate form function
function validateForm() {
  // Registration number validation
  if (registrationNumberInput.value.trim() === '') {
    alert('Please enter your registration number');
    registrationNumberInput.focus();
    return;
  }

  // School email validation
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(ke)$/;
  if (!emailRegex.test(schoolEmailInput.value.trim())) {
    alert('Please enter a valid school email address');
    schoolEmailInput.focus();
    return;
  }

  // Password validation
  if (passwordInput.value.trim() === '') {
    alert('Please enter a password');
    passwordInput.focus();
    return;
  }

  // Confirm password validation
  if (confirmPasswordInput.value.trim() !== passwordInput.value.trim()) {
    alert('Passwords do not match');
    confirmPasswordInput.focus();
    return;
  }

  // Show loading GIF
  loadingGif.style.display = 'block';

  // Submit form data to server using Fetch API
  fetch('/signup', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      registration_number: registrationNumberInput.value,
      school_email: schoolEmailInput.value,
      password: passwordInput.value,
    }),
  })
  .then((response) => response.json())
  .then((data) => {
    console.log(data);
    // Hide loading GIF
    loadingGif.style.display = 'none';
    // Display success message or redirect to next page
    alert('Signup successful!');
    // window.location.href = '/next-page';
  })
  .catch((error) => {
    console.error(error);
    // Hide loading GIF
    loadingGif.style.display = 'none';
    // Display error message
    alert('Error signing up. Please try again.');
  });
}




function registerStudent() {
var registration_number = document.getElementById("registration_number").value;
            var school_email = document.getElementById("school_email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;            
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");   

            // Regular expression for checking if the email is from a school domain
            var schoolEmailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(ke)$/;

            if (username === "" || email === "" || password === "" || confirmPassword === "") {
                alert("All fields are required");
                return;
            }

            if (!schoolEmailPattern.test(email)) {
                alert("Please enter a valid school email address ending with '@kabarak.ac.ke'");
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return; 
                // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
  }
  
  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
  }
  
  // When the user starts to type something inside the password field
  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }
    
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }
  
    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
    
    // Validate length
    if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  } 
            
function validate_password(password) {
  // Check if password is at least 8 characters long
  if (strlen(password) < 8) {
    return false;
  }

  // Check if password contains at least one uppercase letter
  if (!preg_match('/[A-Z]/', password)) {
    return false;
  }

  // Check if password contains at least one lowercase letter
  if (!preg_match('/[a-z]/', password)) {
    return false;
  }

  // Check if password contains at least one number
  if (!preg_match('/\d/', password)) {
    return false;
  }

  // Check if password contains at least one special character
  if (!preg_match('/[^A-Za-z0-9]/', password)) {
    return false;
  }

  return true;

}
password = POST['password'];

if (validate_password(password)) {
  alert ("Password is valid!");
} else {
  alert ("Password is not valid. Please try again.");
}               
                 
    // In a real application, you would retrieve the hashed password from a secure database
    var storedPasswordHash = "hashed_password_here";
    
    // For simplicity, let's assume a basic comparison here. In real scenarios, use a secure hashing algorithm like bcrypt.
    if (inputPassword === storedPasswordHash) {
        alert("Authentication successful!");
    } else {
        alert("Authentication failed. Incorrect password.");
            }
        }

            // Send form data asynchronously to the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    alert(this.responseText);
                }
            };
            xhr.open("POST", "register_student.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("Registration Number=" + $registration_number + "school_email=" + $school_email + "password=" + $password);
        }