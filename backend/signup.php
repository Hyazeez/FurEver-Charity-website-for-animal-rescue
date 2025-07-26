<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['fullname']);
    $age = intval($_POST['age']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $address = trim($_POST['inputAddress']);
    $zip = trim($_POST['inputZip']);

    // Validate passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Email already registered.";
        $check->close();
        exit;
    }
    $check->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (name, age, email, password, address, postal_code) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $name, $age, $email, $hashedPassword, $address, $zip);

    if ($stmt->execute()) {
        // You can echo success instead of redirect if you want to display a message
        echo "Signup success";
    } else {
        echo "Error during registration.";
    }

    $stmt->close();
    $conn->close();
}
?>
