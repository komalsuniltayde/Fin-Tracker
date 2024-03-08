document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('myModal');
    var closeBtn = document.getElementsByClassName('close')[0];

    // Set the idle time threshold (in milliseconds)
    var idleTimeThreshold = 60000 * 1; // 30 minutes

    var lastActivityTime = new Date().getTime();

    function checkIdleTime() {
        var currentTime = new Date().getTime();
        var idleTime = currentTime - lastActivityTime;

        if (idleTime > idleTimeThreshold) {
            modal.style.display = 'block';
            console.log("Popup is displayed!"); // Add this line for logging
        }
    }

    // Update last activity time on user interaction
    document.addEventListener('mousemove', function() {
        lastActivityTime = new Date().getTime();
    });

    // Close the modal when the close button is clicked
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        console.log("Popup is closed!"); // Add this line for logging
    });

    // Check idle time periodically
    setInterval(checkIdleTime, 1000); // Check every second

    // Simulate a user login (replace this with your actual login logic)
    function simulateUserLogin() {
        // Add your login logic here

        // After successful login, display the popup
        modal.style.display = 'block';
    }

    // Call the simulateUserLogin function when the user logs in
    simulateUserLogin();
});
