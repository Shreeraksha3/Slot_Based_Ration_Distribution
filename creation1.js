document.querySelectorAll('.menu-btn').forEach((button) => {
  button.addEventListener('click', () => {
    document.querySelectorAll('.menu-btn').forEach((btn) => btn.classList.remove('active'));
    button.classList.add('active');
  });
});


function goToDashboard() {
  window.location.href = "dashboard.php";
}

function goToManageUsers() {
  window.location.href = "form.php";
}

function goToSlotCreation() {
  window.location.href = "creation.php";
}

function goToSlotAllocation() {
  window.location.href = "allocation.php";
}

function goToViewSlot() {
  window.location.href = "viewslot.php";
}
function redirectToLoginLogout() {
  window.location.href = "login.html"; 
}