<?php
    session_start();
    if (!isset($_SESSION['kenteken'])) {
        $msg = "Je moet eerst een kenteken invoeren om uit te klokken!";
        header("Location: ../index.php?msg=$msg");
        exit;
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
                <div>
                    Uw kosten voor parkeren: €<strong>0.00</strong>
                </div>
                <button type="submit" form="parkeerForm">Sessie Beeindigen</button>
            </section>
        </main>
        <footer>
            <p>© 2024 Attractieparking</p>
        </footer>
    </div>
</body>
</html>
