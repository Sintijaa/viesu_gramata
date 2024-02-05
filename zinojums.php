<?php
include 'db.php';

// Izveido savienojumu
$conn = new mysqli($servername, $username, $password, $dbname);

// Pārbauda savienojumu
if ($conn->connect_error) {
  die("Savienojums neizdevās: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, message, date FROM Records";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Message: " . $row["message"]. " - Date: " . $row["date"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    echo "Paldies, " . $name . ". Jūsu ziņojums ir saņemts.";
}
?>