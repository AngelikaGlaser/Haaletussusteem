<?php
session_start();
 
if (isset($_POST['start'])) {
    // Reset session timer
    $_SESSION['timer'] = time() + 600; // 10 min

    // Connect to database
include_once 'database.php';

// Call the stored procedure and insert the start time
$sql = "CALL uus_haaletus(); INSERT INTO TULEMUSED (H_alguse_aeg) VALUES (NOW())";

if (!mysqli_multi_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

// Redirect to main page
header('Location: add_vote.php');
exit();
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
	<h1>H채채letamine</h1>
	<form method="post" action="">
		<input type="submit" name="start" value="Start">
	</form>
</body>
</html>
