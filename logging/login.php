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
            <h1>Parkeerplek Reserveren</h1>
        </header>
        <main>
            <section class="reservation">
                <h2>Vul uw gegevens in:</h2>
                <!-- FORM BEGIN -->
                <form action="../backend/kentekenController.php" method="POST">

                    <div class="form-group">
                        <label for="kenteken">Kentekenplaat:</label>
                        <input type="text" id="kenteken" name="kenteken" placeholder="XX-123-XX" oninput="formatKenteken(this)">
                    </div>
                    <input type="submit" class="reserveer-knop" value="Verstuur melding">
                    <input type="hidden" name="action" value="create">

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
            var formatted = kenteken.replace(/[^A-Z0-9]/g, '');
            formatted = formatted.substring(0, 6); 
            
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
