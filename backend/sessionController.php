<?php
session_start();
$userKenteken = $_POST['kenteken'];

// Query
require_once 'conn.php';
$query = "SELECT * FROM numberPlates WHERE numberPlate = :numberPlate";
$statement = $conn->prepare($query);
$statement->execute([
    ":numberPlate" => $userKenteken
]);
$user = $statement->fetch();

if($statement->rowCount() < 1) {
    die("Error: kenteken bestaat niet");
}

$_SESSION['kenteken'] = $user['kenteken'];

header("Location: $base_url/logging/logout.php");