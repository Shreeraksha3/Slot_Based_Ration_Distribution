function addUser() {

  const rationNumber = document.getElementById("rationNumber").value;
  const name = document.getElementById("name").value;
  const age = document.getElementById("age").value;
  const profession = document.getElementById("profession").value;
  const address = document.getElementById("address").value;
  const phoneNumber = document.getElementById("phoneNumber").value;
  const members = document.getElementById("members").value;

  console.log("User added:", {
    rationNumber,
    name,
    age,
    profession,
    address,
    phoneNumber,
    members
  });
  
  
}

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

function goToAddUser() {
  window.location.href = "form.php"; 
}
function goToUpdateDetails() {
  window.location.href="viewslot.php";
}

function goToDeleteUser() {
  window.location.href = "viewslot.php"; 
}

 opdownContent.style.display === "block" ? "none" : "block";
 function toggleDropdown() {
  const dropdown = document.querySelector(".dropdown");
  dropdown.classList.toggle("active");
}


  
  
  function redirectToLoginLogout() {
    window.location.href = "login.html"; 
  }
 