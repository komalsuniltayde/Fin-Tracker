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

// Create user_salary table if not exists
$createTableSql = "CREATE TABLE IF NOT EXISTS user_salary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    salary DECIMAL(10, 2) NOT NULL
)";

if ($conn->query($createTableSql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}
// Handle salary form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salary = $_POST['salary'];

    // Validate and store the salary in the database
    $insertSalarySql = "INSERT INTO user_salary (salary) VALUES ($salary)";
    if ($conn->query($insertSalarySql) === FALSE) {
        echo "Error: " . $insertSalarySql . "<br>" . $conn->error;
    }
}

// Function to format date based on the selected period
function formatDate($date, $period) {
    switch ($period) {
        case 'weekly':
            return date('Y-m-d', strtotime('last Monday', strtotime($date)));
        case 'monthly':
            return date('Y-m-01', strtotime($date));
        case 'yearly':
            return date('Y-01-01', strtotime($date));
        default:
            return $date;
    }
}

// Get selected period from the request, default to 'weekly'
$period = isset($_GET['period']) ? $_GET['period'] : 'weekly';

// Fetch data from the database based on the selected period
$sql = "SELECT category, SUM(amount) as total FROM expense_records
        WHERE date >= '" . formatDate(date('Y-m-d'), $period) . "'
        GROUP BY category";

$result = $conn->query($sql);
// Set the expense limits for each category based on the user's salary
// Assuming the salary is stored in the user_salary table
$getSalarySql = "SELECT salary FROM user_salary ORDER BY id DESC LIMIT 1";
$salaryResult = $conn->query($getSalarySql);

$userSalary = 0; // Default value if no salary is found
if ($salaryResult->num_rows > 0) {
    $userSalary = $salaryResult->fetch_assoc()['salary'];
}

// Set the expense limits for each category
$expenseLimits = [
    'Bills' => $userSalary * 0.2,
    'Travelling' => $userSalary * 0.01,
    'Food' => $userSalary * 0.4,
    'Others' => $userSalary * 0.2,
    // Add more categories and limits as needed
];

// Array to store categories exceeding the limit
$exceededCategories = [];

$categories = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $category = $row['category'];
    $totalExpense = $row['total'];

    // Check if the total expense for the category exceeds the limit
    if (isset($expenseLimits[$category])) {
        if ($totalExpense > $expenseLimits[$category]) {
            $exceededCategories[$category] = $totalExpense;
        }
    } else {
        echo "Category '$category' not found in expenseLimits array.<br>";
    }

    // Populate arrays for chart rendering
    $categories[] = $category;
    $totals[] = $totalExpense;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #001f3f, #004080); /* Gradient Blue Background */
            color: #fff; /* White Font Color */
        }

        h2 {
            text-align: center;
            padding: 20px;
        }

        button {
            background-color:#fff ; /* Dark Blue Background for Buttons */
            color: #007bff; /* White Font Color for Buttons */
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border:none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h2>Expense Chart</h2>

    <form method="post" action="">
        <label for="salary">Enter your Monthly Salary:</label>
        <input type="number" name="salary" id="salary" required>
        <button type="submit">Submit</button>
    </form>
    <div>
        <button onclick="changePeriod('weekly')">Weekly</button>
        <button onclick="changePeriod('monthly')">Monthly</button>
        <button onclick="changePeriod('yearly')">Yearly</button>
    </div>

    <div style="display: flex; justify-content: space-around; align-items: center; height: 80vh;">
        <div>
            <canvas id="barChart" width="400" height="300"></canvas>
        </div>
        <div>
            <canvas id="pieChart" width="400" height="300"></canvas>
        </div>
    </div>

    <script>
        const categories = <?php echo json_encode($categories); ?>;
        const totals = <?php echo json_encode($totals); ?>;
        let currentPeriod = '<?php echo $period; ?>';

        const periodLabel = {
            'weekly': 'Weekly',
            'monthly': 'Monthly',
            'yearly': 'Yearly'
        };

        // Function to change the period and reload the chart
        function changePeriod(newPeriod) {
            window.location.href = `render_chart.php?period=${newPeriod}`;
        }

        // Create bar chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: `Total Expenses by Category (${periodLabel[currentPeriod]})`,
                    data: totals,
                    backgroundColor: ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create pie chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: categories,
                datasets: [{
                    data: totals,
                    backgroundColor: ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Check if any category exceeds the limit and show an alert
        const exceededCategories = <?php echo json_encode($exceededCategories); ?>;
        const selectedPeriod = '<?php echo $period; ?>';

        Object.keys(exceededCategories).forEach(category => {
            const message = `You have exceeded the limit for ${selectedPeriod} period in ${category} category. Total expense: ${exceededCategories[category]}`;
            alert(message);
        });
    </script>
</body>
</html>
