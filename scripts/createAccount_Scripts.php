<?php
#header("Location: /inc/createAccount.php");

$user_id;
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordVarify = $_POST['passwordVarify'];

$email = $_POST['email'];
$city = $_POST['city'];
$state = $_POST['state'];
$userType = $_POST['userType'];

$date = date_create();
$registerDate = date_timestamp_get($date);
echo $registerDate;

include "db_connection.php";

echo $password;
echo $passwordVarify;
# Check if passwords match. If not, exit.
if ($password != $passwordVarify) {
  echo "Your passwords do not match";
  exit();
}

# Check if username is already taken
$sql = "SELECT 1 FROM vrstorygram_users WHERE username='$username'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$n = $stmt->rowCount();

if ($n > 0) {
  echo "This username is already taken";
  exit();
}

# Check if user email already exists
$sql = "SELECT 1 FROM vrstorygram_users WHERE email='$email' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$n = $stmt->rowCount();
if ($n > 0) {
  echo "Email already in use";
  exit();
}


# Define User ID Number
$sql = "SELECT 1 FROM vrstorygram_users ORDER BY DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user_id = $stmt->fetchColumn() + 1;



$sql = "INSERT INTO vrstorygram_users SET first_name='$firstName', last_name='$lastName', email='$email', city='$city', state='$state', user_type='$userType', creation_date=now(), password='$password', username='$username', user_id=$user_id";
$stmt = $conn->prepare($sql);
$stmt->execute();

echo $stmt->rowCount() . " records UPDATED successfully";



?>
