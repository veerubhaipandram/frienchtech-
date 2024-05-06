<?php
// Include the database configuration file
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    // Prepare an insert statement
    $sql = "INSERT INTO contact_form (name, mobile_number, email, address, message) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssss", $name, $mobile_number, $email, $address, $message);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to a success page
            header("location: index.html");
            header("location: contact.html?success=1");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>
