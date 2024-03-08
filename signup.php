<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            background: linear-gradient(to right, #ff5f6d, #ffc371);
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .signup {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box; /* Include padding and border in the total width */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            gap: 15px;
        }

        label {
            display: block;
            width: 100%;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ff6361;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #e04844;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="signup">
        <h1>Sign Up</h1>
        <form method="POST">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" required>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" required>

            <label for="gender">Gender:</label>
            <input type="text" name="gender" required>

            <label for="cnum">Contact Number:</label>
            <input type="tel" name="cnum" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="pass">Password:</label>
            <input type="password" name="pass" required>

            <input type="submit" value="Submit">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
