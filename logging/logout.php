<?php
session_start();
if (!isset($_SESSION['kenteken'])) {
    $msg = "Je moet eerst een kenteken invoeren om uit te klokken!";
    header("Location: ../index.php?msg=$msg");
    exit;
}

require_once '../backend/conn.php';

$query = "SELECT * FROM numberPlates WHERE numberPlate = :numberPlate";
$statement = $conn->prepare($query);
$statement->execute([
    ':numberPlate' => $_SESSION['kenteken']
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $msg = "Geen gegevens gevonden voor het ingevoerde kenteken.";
    header("Location: ../index.php?msg=$msg");
    exit;
}

// Calculate time difference
$loginTime = $user['loginTime'];
$currentTime = date('Y-m-d H:i:s');

$loginTimeObj = new DateTime($loginTime);
$currentTimeObj = new DateTime($currentTime);
$interval = $loginTimeObj->diff($currentTimeObj);

$hours = $interval->h + ($interval->days * 24);
$minutes = $interval->i;

// Calculate parking cost (for example, €1.25 per hour)
$parkingCost = $hours * 125.25;
if ($minutes > 0) {
    $parkingCost += 125.25; // Assuming any minute over 0 adds another hour's cost
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Parkeerplek Reserveren</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <header>
            <button onclick="window.location.href='../index.php'" class="terug-knop">&larr; Terug</button>
            <h1>Parkeersessie Beeindigen</h1>
        </header>
        <main>
            <section class="reservation">
                <!-- toezicht van het totaal in kosten -->

                <h1><?php echo htmlspecialchars($user['numberPlate']); ?></h1>

                <div>
                    Uw kosten voor parkeren: €<strong><?php echo number_format($parkingCost, 2); ?></strong>
                </div>


                <form action="../backend/kentekenController.php" method="POST">
                    <input type="submit" class="reserveer-knop" value="Betaal">
                    <input type="hidden" name="action" value="delete">
                </form>




            </section>
        </main>
        <footer>
            <p>© 2024 Attractieparking</p>
        </footer>
    </div>
</body>
</html>
