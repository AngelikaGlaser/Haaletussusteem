<?php
session_start();

$servername='localhost';
$username='glaserangelika_Haaletus';
$password='Ki5)q&]ukgDz';
$dbname='glaserangelika_haaletussusteem';
$conn=mysqli_connect($servername,$username,$password,"$dbname");

// Check connection
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}
?>
