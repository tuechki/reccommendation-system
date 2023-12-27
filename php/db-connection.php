<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recommendation-system";

echo "before_connection"

$conn = new mysqli($servername, $username, $password, $dbname);
echo "after"


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>