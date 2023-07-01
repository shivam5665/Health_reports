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

$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// Save the uploaded file to the "uploads" directory
$targetDir = "uploads/";
$healthReportName = basename($_FILES["healthReport"]["name"]);
$targetFilePath = $targetDir . $healthReportName;
move_uploaded_file($_FILES["healthReport"]["tmp_name"], $targetFilePath);

$sql = "INSERT INTO user_details (name, age, weight, email, health_report) 
        VALUES ('$name', '$age', '$weight', '$email', '$healthReportName')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
