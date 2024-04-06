<?php
session_start();

if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

include "db_conn.php";

$patient_id = $_SESSION['id'];

$sql = "SELECT * FROM patients WHERE id = $patient_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $patientName = $row['patient_name'];
    $birthdate = $row['birthdate'];
    $age = $row['age'];
    $contactNumber = $row['contact_number'];
    $bloodType = $row['blood_type'];
    $smoker = $row['smoker'];
    $drinker = $row['drinker'];
    $allergies = $row['allergies'];
    $familyMedicalHistory = $row['family_medical_history'];
    $pastMedications = $row['past_medications'];
    $pastOperations = $row['past_operations'];
    // Add more fields as needed
} else {
    echo "Patient not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <!-- Include your CSS styling here -->
</head>
<body>
    <h2>Welcome, <?php echo $patientName; ?>!</h2>
    <h3>Your Personal Information</h3>
    <div>
        <p><strong>Name:</strong> <?php echo $patientName; ?></p>
        <p><strong>Birthdate:</strong> <?php echo $birthdate; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $contactNumber; ?></p>
        <p><strong>Blood Type:</strong> <?php echo $bloodType; ?></p>
        <p><strong>Smoker:</strong> <?php echo $smoker ? 'Yes' : 'No'; ?></p>
        <p><strong>Drinker:</strong> <?php echo $drinker ? 'Yes' : 'No'; ?></p>
        <p><strong>Allergies:</strong> <?php echo $allergies; ?></p>
        <p><strong>Family Medical History:</strong> <?php echo $familyMedicalHistory; ?></p>
        <p><strong>Past Medications:</strong> <?php echo $pastMedications; ?></p>
        <p><strong>Past Operations:</strong> <?php echo $pastOperations; ?></p>
        <!-- Add more fields as needed -->
    </div>
    <p><a href="patient_profile.php">Edit Personal Information</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
