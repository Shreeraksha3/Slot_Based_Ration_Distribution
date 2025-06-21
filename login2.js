const loginForm = document.getElementById("login-form");
const createAccountForm = document.getElementById("create-account-form");
const createAccountLink = document.getElementById("create-account-link");
const loginLink = document.getElementById("login-link");

// Event listeners for switching between forms
createAccountLink.addEventListener("click", (e) => {
  e.preventDefault();
  loginForm.style.display = "none";
  createAccountForm.style.display = "block";
});

loginLink.addEventListener("click", (e) => {
  e.preventDefault();
  createAccountForm.style.display = "none";
  loginForm.style.display = "block";
});

// Handle Login Form Submission
loginForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  fetch("login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Login successful!");
        window.location.href = "dashboard.php"; 
      } else {
        alert(data.message);
      }
    })
    .catch((err) => console.error(err));
});

// Handle Create Account Form Submission
createAccountForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const username = document.getElementById("new-username").value.trim();
  const password = document.getElementById("new-password").value.trim();
  const confirmPassword = document.getElementById("confirm-password").value.trim();

  
  if (password !== confirmPassword) {
    alert("Passwords do not match!");
    return;
  }

  fetch("register.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Account created successfully! Please log in.");
        createAccountForm.reset();
        createAccountForm.style.display = "none";
        loginForm.style.display = "block";
      } else {
        alert(data.message);
      }
    })
    .catch((err) => console.error(err));
});
