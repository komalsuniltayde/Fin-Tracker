
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have form fields for email and password
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    // Validate the user (you need to implement your own validation logic)
    // For example, check the credentials against the database
    $sql = "SELECT * FROM form1 WHERE email = '$user_email' AND pass = '$user_password'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error executing the query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // User is authenticated
        // Set the user email in the session
        $_SESSION['user_email'] = $user_email;

        // Redirect to the profile page
        header("Location: nav1.html");
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ff5f6d, #ffc371); /* Vibrant gradient background */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9); /* Light background color for the form */
            color: #333; /* Darker text color for better readability */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center; /* Center text in the form */
        }

        h1 {
            color: #333; /* Darker text color for the heading */
            margin-bottom: 20px; /* Add some space below the heading */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555; /* Slightly darker text color for labels */
            text-align: left; /* Align labels to the left */
        }

        input {
            width: calc(100% - 20px); /* Adjusted width to account for padding */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc; /* Add a subtle border for better visibility */
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in the total width */
        }

        button {
            background-color: #3b5998;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #293e69; /* Darker blue on hover for the button */
        }

        p {
            margin-top: 10px; /* Add some space above the "Don't have an account?" link */
            color: #555; /* Slightly darker text color for the link */
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <h1>Login</h1>

        <?php
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
        <p>Don't have an account? <a href="signup.php">Signup here</a></p>
        

    </form>
</body>
</html>
