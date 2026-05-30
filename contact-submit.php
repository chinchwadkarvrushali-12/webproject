<?php
$host = "localhost";
$username = "acptwebsite";
$password = "acptwebsite@2024"; // or your actual password
$database = "acptwebsite";

// Connect to DB
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$full_name  = $_POST['full_name'] ?? '';
$contact_no = $_POST['contact_no'] ?? '';
$email      = $_POST['email'] ?? '';
$company    = $_POST['company'] ?? '';
$request    = $_POST['request'] ?? '';
$privacy_accepted = isset($_POST['privacy_policy']) ? 1 : 0;

// Insert query
$sql = "INSERT INTO contact_information (full_name, contact_no, email, company, request, privacy_policy_accepted)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $full_name, $contact_no, $email, $company, $request, $privacy_accepted);

if ($stmt->execute()) {
    // Send email
    $to = "demo@gmail.com";
    $subject = "New Contact Form Submission";
    $message = "
    New contact form submission:\n
    Name: $full_name
    Contact No: $contact_no
    Email: $email
    Company: $company
    Request: $request
    Privacy Policy Accepted: " . ($privacy_accepted ? 'Yes' : 'No') . "
    ";
    $headers = "From: no-reply@yourdomain.com\r\n"; // change to your domain

    mail($to, $subject, $message, $headers);

    // Redirect back to homepage
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
