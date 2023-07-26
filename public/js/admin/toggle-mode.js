// Get the current mode from localStorage when the page loads
  const currentMode = localStorage.getItem("userMode") || "admin";

  // Function to update the user mode
  function updateUserMode(mode) {
    const toggleSwitch = document.getElementById("modeSwitch");
    const modeLabel = document.getElementById("modeLabel");

    if (mode === "user") {
      toggleSwitch.checked = true;
      modeLabel.textContent = "User Mode";
    } else {
      toggleSwitch.checked = false;
      modeLabel.textContent = "Admin Mode";
    }

    // Store the mode in localStorage
    localStorage.setItem("userMode", mode);
  }

  // Call the function to set the initial user mode
  updateUserMode(currentMode);


const toggleSwitch = document.getElementById("modeSwitch");

toggleSwitch.addEventListener("change", function() {
    if (this.checked) {
      updateUserMode("user");
      // Redirect to the user dashboard or any other route for user mode
      window.location.href = userDashboardUrl;
    } else {
      updateUserMode("admin");
      // Redirect to the admin dashboard or any other route for admin mode
      window.location.href = adminDashboardUrl;
    }
  });
