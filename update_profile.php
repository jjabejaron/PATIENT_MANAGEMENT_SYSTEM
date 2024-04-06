<?php
session_start();

if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

include "db_conn.php";

$patient_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patientName = $_POST['patientName'];
    // Retrieve more form data as needed

    // Update patient information in the database
    $sql = "UPDATE patients SET patient_name='$patientName' WHERE id=$patient_id";
    // Update other fields in the database as needed
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        // Redirect back to the patient profile page after successful update
        header("Location: patient_profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
