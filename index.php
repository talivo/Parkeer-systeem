<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Attractieparking - Parkeren</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Attractieparking</h1>
        </header>
        <main>
            <section class="intro">
                <h2>Reserveer uw parkeerplek</h2>
                <p>Voer uw kenteken in om veilig geparkeerd te staan onder officieel en veilig toezicht van Attractieparking</p>
                <a href="logging/login.php" class="reserveer-knop">Reserveer nu uw parkeerplek</a>
            </section>
            <section class="outro">
                <h2>Betaal uw tijd</h2>
                <p>Heeft u al gelogd? Voer uw kenteken in om de sessie te beeindigen</p>

                <!-- STUURT DOOR NAAR SESSION CONTROLLER -->
                <form action="backend/sessionController.php" method="POST">
                    <div class="form-group">
                        <label for="kenteken">Kentekenplaat:</label>
                        <input type="text" id="kenteken" name="kenteken" placeholder="XX-123-XX" oninput="formatKenteken(this)">
                        <br><br>
                        <input type="submit" class="reserveer-knop" value="Eindig uw parkeersessie">
                    </div>
                </form>
            </section>
        </main>
        <footer>
            <p>© 2024 Attractieparking</p>
        </footer>
    </div>

    <script>
        function formatKenteken(input) {
            var kenteken = input.value.toUpperCase();
            var formatted = kenteken.replace(/[^A-Z0-9]/g, ''); // Verwijder alle niet-alfanumerieke tekens
            formatted = formatted.substring(0, 6); // Beperk tot maximaal 6 karakters
            
            // Voeg streepjes toe op de juiste posities
            if (formatted.length > 2) {
                formatted = formatted.substring(0, 2) + '-' + formatted.substring(2);
            }
            if (formatted.length > 5) {
                formatted = formatted.substring(0, 5) + '-' + formatted.substring(5);
            }
            
            input.value = formatted;
        }
    </script>
</body>
</html>
