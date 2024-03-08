<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ADD EXPENSE</title>
<style type = "text/css">
  body {
  font-family: Arial, sans-serif;
  background-color: #000000d3;
}

.container {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
}

form {
  margin-top: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="date"],
select,
input[type="text"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 25px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

button {
  padding: 10px 20px;
  margin-right: 10px;
  margin-left: 150px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
</head>
<body>
  <div class="container">
    <h1>ADD EXPENSE</h1>
    <form action="save_expense.php" method="post">
      
      <label for="datepicker">Select a Date:</label>
      <input type="date" id="datepicker" name="datepicker"><br><br>
      
      <label for="dropdown1">Category:</label>
      <select id="dropdown1" name="dropdown1">
        <option value="Food">Food</option>
        <option value="Shopping">Shopping</option>
        <option value="Travelling">Travelling</option>
        <option value="Bills">Bills</option>
        <option value="Others">Others</option>
      </select><br><br>
      
      <label for="dropdown2">Mode of Expense:</label>
      <select id="dropdown2" name="dropdown2">
        <option value="Cash">Cash</option>
        <option value="Credit Card">Credit Card</option>
        <option value="Debit Card">Debit Card</option>
        <option value="UPI">UPI</option>
      </select><br><br>
      
      <label for="textbox">Expense</label>
      <input type="text" id="textbox" name="textbox"><br><br>
      
      <button type="submit">Add</button>
      <button type="reset">Edit</button>
    </form>
  </div>
</body>
</html>