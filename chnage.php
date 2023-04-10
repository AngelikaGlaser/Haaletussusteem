<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hääle muutmine</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();

    // Connect to database
    include_once 'database.php';

    if (isset($_POST['name'])) {
        // Retrieve form data
        $name = $_POST['name'];

        // Check if user has already voted
        $result = mysqli_query($conn, "SELECT * FROM HAALETUS WHERE Nimi = '$name'");
        if (mysqli_num_rows($result) > 0) {
            // User has already voted
            $row = mysqli_fetch_assoc($result);
            $current_vote = $row['Otsus'];

            // Display form with current vote selected
            echo '<h2>Vali uus hääl:</h2>';
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="name" value="' . $name . '">';
            echo '<label>Nimi:</label>';
            echo '<input type="text" name="name" value="' . $name . '" readonly>';
            echo '<br><br>';
            echo '<label>Poolt:</label>';
            echo '<input type="radio" name="Otsus" value="Poolt" ' . ($current_vote == 'Poolt' ? 'checked' : '') . ' required>';
            echo '<label>Vastu:</label>';
            echo '<input type="radio" name="Otsus" value="Vastu" ' . ($current_vote == 'Vastu' ? 'checked' : '') . ' required>';
            echo '<br><br>';
            echo '<input type="submit" name="Muuda" value="Muuda häält">';
            echo '</form>';

            echo '<form action="results.php">';
            echo '<input type="submit" name="Tulemused" value="Vaata tulemusi!">';
            echo '</form>';

            if (isset($_POST['Muuda'])) {
                // Retrieve form data
                $Otsus = $_POST['Otsus'];

                // Update user's vote in database
                $sql = "UPDATE HAALETUS SET Otsus='$Otsus', Haaletamise_aeg=NOW() WHERE Nimi='$name'";

                if (mysqli_query($conn, $sql)) {
                    echo '<p>Hääl on muudetud!</p>';
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        } else {
            // User has not voted
            echo '<h2>Kasutaja ' . $name . ', sa ei ole hääletanud!</h2>';
            echo '<form method="post" action="">';
            echo '<label>Nimi:</label>';
            echo '<input type="text" name="name" value="' . $name . '" readonly>';
            echo '<br><br>';
            echo '<label>Poolt:</label>';
            echo '<input type="radio" name="Otsus" value="Poolt" required>';
            echo '<label>Vastu:</label>';
            echo '<input type="radio" name="Otsus" value="Vastu" required>';
            echo '<br><br>';
            echo '<input type="submit" name="Hääleta" value="Hääleta">';
            echo '</form>';

            echo '<form action="results.php">';
echo '<input type="submit" name="Tulemused" value="Vaata tulemusi!">';
echo '</form>';
        if (isset($_POST['Hääleta'])) {
            // Retrieve form data
            $Otsus = $_POST['Otsus'];

            // Insert new vote into database
            $sql = "INSERT INTO HAALETUS (Nimi, Otsus) VALUES ('$name', '$Otsus')";

            if (mysqli_query($conn, $sql)) {
                echo '<p>Sinu hääl on lisatud!</p>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
} else {
    // Display form to enter user's name
    echo '<h2>Sisesta oma nimi:</h2>';
    echo '<form method="post" action="">';
    echo '<label>Nimi:</label>';
    echo '<input type="text" name="name" required>';
    echo '<br><br>';
    echo '<input type="submit" name="submit" value="Jätka">';
    echo '</form>';
}

// Close database connection
mysqli_close($conn);
?>
