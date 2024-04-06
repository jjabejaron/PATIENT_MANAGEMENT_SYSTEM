<?php
session_start();

if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

include "db_conn.php";

if (isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];

    // Retrieve patient information from the database based on $patient_id
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
        // Continue retrieving other patient details as needed

        // Display form for editing patient information
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Patient Information</title>
        </head>
        <body>
            <h2>Edit Patient Information</h2>
            <form action="update_patient_info.php" method="post">
                <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                <label for="patientName">Patient Name:</label>
                <input type="text" name="patientName" value="<?php echo $patientName; ?>"><br>
                <label for="birthdate">Birthdate:</label>
                <input type="date" name="birthdate" value="<?php echo $birthdate; ?>"><br>
                <label for="age">Age:</label>
                <input type="number" name="age" value="<?php echo $age; ?>"><br>
                <label for="contactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" value="<?php echo $contactNumber; ?>"><br>
                <label for="bloodType">Blood Type:</label>
                <input type="text" name="bloodType" value="<?php echo $bloodType; ?>"><br>
                <label for="smoker">Smoker:</label>
                <input type="checkbox" name="smoker" <?php if ($smoker) echo "checked"; ?>><br>
                <label for="drinker">Drinker:</label>
                <input type="checkbox" name="drinker" <?php if ($drinker) echo "checked"; ?>><br>
                <label for="allergies">Allergies:</label>
                <input type="text" name="allergies" value="<?php echo $allergies; ?>"><br>
                <label for="familyMedicalHistory">Family Medical History:</label>
                <input type="text" name="familyMedicalHistory" value="<?php echo $familyMedicalHistory; ?>"><br>
                <label for="pastMedications">Past Medications:</label>
                <input type="text" name="pastMedications" value="<?php echo $pastMedications; ?>"><br>
                <label for="pastOperations">Past Operations:</label>
                <input type="text" name="pastOperations" value="<?php echo $pastOperations; ?>"><br>

                <input type="submit" value="Save Changes">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Patient not found.";
        exit();
    }
}
?>
