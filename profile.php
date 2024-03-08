<?php
// Start the session
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "register";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user email is set in the session
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];

    // Fetch all user details based on email
    $sql = "SELECT * FROM form1 WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstname = $row['fname'];
        $lastname = $row['lname'];
        $Gender = $row['gender'];
        $num = $row['cnum'];
        $gmail = $row['email'];

        // Output the data
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profile</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background: linear-gradient(to right, #4a69bb, #56cfe1);
                }

                nav {
                    background-color: #3b5998;
                    height: 100vh;
                    width: 200px;
                    position: fixed;
                    left: 0;
                    top: 0;
                    overflow: hidden;
                    padding-top: 20px;
                }

                nav a {
                    display: block;
                    color: white;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                }

                nav a:hover {
                    background-color: #3b5998;
                }

                .logo {
                    display: block;
                    margin-bottom: 20px;
                    font-weight: bold;
                    color: white;
                    text-align: center;
                }

                .fa {
                    margin-right: 5px;
                }

                .profile-content {
                    display: none; /* Initially hide the profile content */
                    margin: 20px auto;
                    padding: 20px;
                    background: linear-gradient(to right, #4a69bb, #56cfe1);
                    color: white;
                    max-width: 600px;
                }
            </style>
        </head>
        <body>
            <nav>
                <div class="logo"><i class="fa fa-money"></i> Fin Tracker</div>
                <a href="#" onclick="toggleProfileSection()"><i class="fa fa-user"></i> Profile</a>
                <a href="#expense"><i class="fa fa-dollar-sign"></i> Expense</a>
                <a href="#expense-report"><i class="fa fa-file-alt"></i> Expense Report</a>
                <a href="#logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </nav>

            <div class="profile-content" id="profileContent">
                <h1>Profile Information</h1>
                <p><strong>Firstname:</strong> <?php echo $firstname ; ?></p>
                <p><strong>Lastname:</strong> <?php echo $lastname; ?></p>
                <p><strong>Gender:</strong> <?php echo $Gender; ?></p>
                <p><strong>Contact Number:</strong> <?php echo $num; ?></p>
                <p><strong>Email:</strong> <?php echo $gmail; ?></p>
            </div>

            <script>
                function toggleProfileSection() {
                    var profileContent = document.getElementById('profileContent');
                    profileContent.style.display = (profileContent.style.display === 'none') ? 'block' : 'none';
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "User not found!";
    }
} else {
    // Redirect to login page if the user email is not set in the session
    header("Location: login.php");
    exit();
}
?>
