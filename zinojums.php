<?php
include 'db.php';

$conn = new DB;


$host = "localhost"; // replace with your host
$user = "root"; // replace with your user
$pass = ""; // replace with your password
$dbname = "viesu_gramata"; // replace with your database name
// Izveido savienojumu
$conn = new mysqli($host, $user, $pass, $dbname);

// Pārbauda savienojumu
if ($conn->connect_error) {
  die("Savienojums neizdevās: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, message, date FROM records";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Message: " . $row["message"]. " - Date: " . $row["date"]. "<br>";
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `records` (`name`, `email`, `message`) VALUES('$name', '$email', '$message')";
   
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();

      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

    echo "Paldies, " . $name . ". Jūsu ziņojums ir saņemts.";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Guest book</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-container {
    background-color: #ffffff;
    width: 300px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

.form-title {
    text-align: center;
    margin-bottom: 20px;
}

.form-field {
    margin-bottom: 10px;
}

.form-field label {
    display: block;
    margin-bottom: 5px;
}

.form-field input {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-field textarea {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-field button {
    padding: 5px 10px;
    background-color: #007BFF;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Guest book</h1>
   
    <form id="guestbook-form" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <p id="nameError" style="color:red;"></p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <p id="emailError" style="color:red;"></p>
        <label for="message">Message:</label>
        <textarea name="message" id="message"></textarea>
        <p id="messageError" style="color:red;"></p>
        <input type="submit" value="Iesniegt">
      </form> 
    </div>

    <script type='text/javascript'>
  document.getElementById('guestbook-form').addEventListener('submit', function(event) {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var message = document.getElementById('message').value;

            if(name === "") {
                document.getElementById('nameError').textContent = "Name is required.";
                event.preventDefault();
            } else {
                document.getElementById('nameError').textContent = "";
            }

            if(email === "") {
                document.getElementById('emailError').textContent = "Email is required.";
                event.preventDefault();
            } else if(!validateEmail(email)) {
                document.getElementById('emailError').textContent = "Please enter a valid email address.";
                event.preventDefault();
            } else {
                document.getElementById('emailError').textContent = "";
            }

            if(message === "") {
                document.getElementById('messageError').textContent = "Message is required.";
                event.preventDefault();
            } else {
                document.getElementById('messageError').textContent = "";
            }
        });

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    </script>
</body>
</html>