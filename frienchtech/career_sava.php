<?php

require_once 'config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, $_POST['Name']);
    $lname = mysqli_real_escape_string($conn, $_POST['lName']);
    $dob = mysqli_real_escape_string($conn, $_POST['Dob']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);

    // Handle file upload
    $targetDirectory = "uploads/";
    $resumeFileName = time() . '_' . basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDirectory . $resumeFileName;

    // Check if the directory exists, if not, create it
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // File uploaded successfully, proceed to insert data into MySQL database
        $sql = "INSERT INTO users (first_name, last_name, dob, email, phone, position, start_date, resume_file_path) 
                VALUES ('$fname', '$lname', '$dob', '$email', '$phone', '$position', '$start_date', '$resumeFileName')";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully, redirect to career.html with success flag
            header("location: career.html?success=1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // File upload failed, display error message
        echo "Error uploading file.";
    }
}

// Close connection
$conn->close();
?>
