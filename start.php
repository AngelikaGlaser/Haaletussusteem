<?php
include_once 'database.php';
$result = mysqli_query($conn, "SELECT Vastanute_arv AS Kokku, Poolt_h_arv AS Poolt, Vastu_h_arv AS Vastu FROM TULEMUSED WHERE  ID_tulemused = (SELECT MAX(ID_tulemused) FROM TULEMUSED)");

$row = mysqli_fetch_assoc($result);
$Kokku = $row['Kokku'];
$Poolt = $row['Poolt'];
$Vastu = $row['Vastu'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container text-center">
        <h1>Tulemused</h1>
        <table>
            <tr>
                <th>Kokku</th>
                <th>Poolt</th>
                <th>Vastu</th>
            </tr>
            <tr>
                <td><?php echo $Kokku; ?></td>
                <td><?php echo $Poolt; ?></td>
                <td><?php echo $Vastu; ?></td>
            </tr>
        </table>
        <a href="add_vote.php">Uuesti h채채letama</a>
        <a href="change.php">Muuda h채채lt</a>
    </div>
</body>
</html>
