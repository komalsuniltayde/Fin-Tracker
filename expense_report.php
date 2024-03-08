<!DOCTYPE html>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #001f3f; /* Dark Blue Background */
            
        }

        h1 {
            text-align: center;
            padding: 20px;
            color:#fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for better readability */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #fff; /* White Background for Date */
           
        }

        td.category {
            background-color: #ff0 !important; /* Yellow Background for Category */
            
        }

        td.mode {
            background-color: #f00 !important; /* Red Background for Mode */
            
        }

        td.amount {
            background-color: #add8e6 !important; /* Light Blue Background for Amount */
            
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Expense Report</h1>


        

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "register";
    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch and display the expense details
    $result = $conn->query("SELECT * FROM expense_records ORDER BY date DESC");

    if ($result->num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Mode</th>
                <th>Amount</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['category']}</td>
                <td>{$row['mode']}</td>
                <td>{$row['amount']}</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No expenses found.";
    }

    $conn->close();
    ?>
</body>
</html>