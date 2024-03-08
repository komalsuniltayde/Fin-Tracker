<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$date = $_POST['datepicker'];
$category = $_POST['dropdown1'];
$mode = $_POST['dropdown2'];
$amount = $_POST['textbox'];

// Insert data into the database
$sql = "INSERT INTO expense_records (date, category, mode, amount) VALUES ('$date', '$category', '$mode', '$amount')";

if ($conn->query($sql) === TRUE) {
   

    header("Location:expense_report.php");
    exit();
 
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

