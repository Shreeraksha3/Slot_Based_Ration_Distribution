document.querySelectorAll('.menu-btn').forEach((button) => {
    button.addEventListener('click', () => {
      // Remove 'active' class from all buttons
      document.querySelectorAll('.menu-btn').forEach((btn) => btn.classList.remove('active'));
      // Add 'active' class to the clicked button
      button.classList.add('active');
    });
  }); function goToDashboard() {
    window.location.href = "dashboard.php"; 
  }

  //redirect to the Manage Users page
  function goToManageUsers() {
    window.location.href = "form.php"; 
  }

  // redirect to the Slot Creation page
  function goToSlotCreation() {
    window.location.href = "creation.php"; 
  }

  //  redirect to the Slot Allocation page
  function goToSlotAllocation() {
    window.location.href = "allocation.php"; 
  }

  //  redirect to the View Slot page
  function goToViewSlot() {
    window.location.href = "viewslot.php"; 
  }
  function redirectToLoginLogout() {
    window.location.href = "login.html"; 
  }
  