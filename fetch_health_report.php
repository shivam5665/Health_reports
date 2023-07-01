<?php
// Replace the database connection details with your own credentials
$servername = "localhost";
$username = "shivasara";
$password = "shiva4554";
$dbname = "health_reports";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

$sql = "SELECT health_report FROM user_details WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $healthReportName = $row['health_report'];
    $healthReportPath = "uploads/" . $healthReportName;

    if (file_exists($healthReportPath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $healthReportName . '"');
        readfile($healthReportPath);
    } else {
        echo "Health report not found.";
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
