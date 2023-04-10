<?php
session_start();

if (isset($_POST['Hääleta'])) {
  // Retrieve form data
  $name = $_POST['name'];
  $Otsus = $_POST['Otsus'];

  // Connect to database
  include_once 'database.php';

  // Insert data into database
  $sql = "INSERT INTO HAALETUS (Nimi, Otsus, Haaletamise_aeg) VALUES ('$name', '$Otsus', NOW())";

  if (mysqli_query($conn, $sql)) {
    // Redirect to results page
    header('Location: results.php');
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Hääletamine</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h2>Hääle lisamine</h2>
	<form method="post" action="">
		<label>Nimi:</label>
		<input type="text" name="name" required>
		<br><br>
		<label>Poolt:</label>
		<input type="radio" name="Otsus" value="Poolt" required>
		<label>Vastu:</label>
		<input type="radio" name="Otsus" value="Vastu" required>
		<br><br>
		<input type="submit" name="Hääleta" value="Hääleta">
	</form>
	<form action='results.php'>
	    <input type="submit" name="Tulemused" value="Vaata tulemusi!">
	</form>
</body>
</html>
