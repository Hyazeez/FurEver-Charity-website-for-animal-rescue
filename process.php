<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $donations = $_POST['donations'];
    $message = $_POST['message'];

    $sql = "INSERT INTO donations (name, email, amount, message) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssds", $name, $email, $donations, $message);
        if ($stmt->execute()) {
            echo "Application submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Statement Preparation Failed: " . $conn->error;
    }

    $conn->close();
}
?>
