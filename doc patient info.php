<?php
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$patient_id = 1;

$sqlPatient = "SELECT * FROM patients WHERE id = $patient_id";
$resultPatient = $conn->query($sqlPatient);

if ($resultPatient->num_rows > 0) {
	$rowPatient = $resultPatient->fetch_assoc();
	$patientName = $rowPatient['patient_name'];
	$birthdate = $rowPatient['birthdate'];
	$age = $rowPatient['age'];
	$contactNumber = $rowPatient['contact_number'];
	$bloodType = $rowPatient['blood_type'];
	$smoker = $rowPatient['smoker'];
	$drinker = $rowPatient['drinker'];
	$allergies = $rowPatient['allergies'];
	$familyMedicalHistory = $rowPatient['family_medical_history'];
	$pastMedications = $rowPatient['past_medications'];
	$pastOperations = $rowPatient['past_operations'];
	$checkupHistory = $rowPatient['checkup_history'];
	$prescription = $rowPatient['prescription'];
	$labResults = $rowPatient['lab_results'];
	$imagePath = $row['image_path'];
} else {
	echo "Patient not found.";
	exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Patient Details</title>
	<style>
	body {
		margin: 0;
		padding: 0;
		font-family: Arial, sans-serif;
	}
	header {
		background-color: #333;
		color: #fff;
		padding: 10px 0;
		text-align: center;
	}
	.logo {
		display: inline-block;
		vertical-align: middle;
		width: 40px; /* Adjust as needed */
		height: 40px; /* Adjust as needed */
		margin-right: 10px;
	}
	.logo img {
		width: 100%;
		height: 100%;
	}
	.title {
		display: inline-block;
		vertical-align: middle;
		font-size: 24px;
	}
	.welcome-message {
		text-align: center;
		margin-bottom: 20px;
	}
	.welcome-message img {
		width: 100px; /* Adjust as needed */
		height: 100px; /* Adjust as needed */
		border-radius: 50%;
		margin-right: 10px;
	}
	.logout-btn {
		padding: 5px 10px;
		background-color: #f44336;
		color: white;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		float: right;
		margin-top: 10px;
		margin-right: 20px;
	}
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th, td {
		border: 1px solid black;
		padding: 8px;
		text-align: left;
	}
	th {
		background-color: #f2f2f2;
	}
	.status-circle {
		display: inline-block;
		width: 12px;
		height: 12px;
		border-radius: 50%;
		margin-right: 5px;
	}
	.status-done { background-color: #3498db; color: white; }
	.status-confirmed { background-color: #1abc9c; color: white; }
	.status-cancelled { background-color: #e74c3c; color: white; }
	.status-pending { background-color: #f1c40f; color: black; }
	.view-btn {
		padding: 5px 10px;
		background-color: #4CAF50;
		color: white;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
	.file-upload {
		position: fixed;
		bottom: 20px;
		right: 20px;
	}

	.file-upload input[type="file"] {
		display: none;
	}

	.file-upload label {
		display: inline-block;
		padding: 10px 15px;
		background-color: #4CAF50;
		color: white;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
</style>
</head>
<body>
	<header>
	<header>
		<div class="logo">
			<img src="path_to_your_logo_image.png" alt="Logo">
		</div>
		<div class="title">
			<h1>Patient Management System</h1>
		</div>
		<a href="logout.php" class="logout-btn">Logout</a>
	</header>
	</header>
	<div class="container">
	<div class="container">
		<div class="left-column">
			<img src="<?php echo $imagePath; ?>" alt="Patient Image" class="patient-image">
			<div class="info-block">
				<h3>Name:</h3>
				<p><?php echo $patientName; ?></p>
			</div>
			<div class="info-block">
				<h3>Birthdate:</h3>
				<p><?php echo $birthdate; ?></p>
			</div>
			<div class="info-block">
				<h3>Age:</h3>
				<p><?php echo $age; ?> years</p>
			</div>
			<div class="info-block">
				<h3>Contact Number:</h3>
				<p><?php echo $contactNumber; ?></p>
			</div>
		</div>
	</div>
		<div class="right-column'>
			<div class="info-block">
				<h3>Blood Type:</h3>
				<p><?php echo $bloodType; ?></p>
			</div>
			<div class="info-block">
				<h3>Smoker:</h3>
				<p><?php echo $smoker ? 'Yes' : 'No'; ?></p>
			</div>
			<div class="info-block">
				<h3>Drinker:</h3>
				<p><?php echo $drinker ? 'Yes' : 'No'; ?></p>
			</div>
			<div class="info-block">
				<h3>Allergies:</h3>
				<p><?php echo $allergies; ?></p>
			</div>
			<div class="info-block">
				<h3>Family Medical History:</h3>
				<p><?php echo $familyMedicalHistory; ?></p>
			</div>
			<div class="info-block">
				<h3>Past Medications:</h3>
				<p><?php echo $pastMedications; ?></p>
			</div>
			<div class="info-block">
				<h3>Past Operations:</h3>
				<p><?php echo $pastOperations; ?></p>
			</div>
			<!-- Checkup History -->
			<div class="info-block">
				<h3>Checkup History:</h3>
				<?php
				$sqlCheckups = "SELECT * FROM checkups WHERE patient_id = $patient_id";
				$resultCheckups = $conn->query($sqlCheckups);

				if ($resultCheckups->num_rows > 0) {
					while ($rowCheckup = $resultCheckups->fetch_assoc()) {
						echo "<p>Date: {$rowCheckup['date']} | Time: {$rowCheckup['time']} | <a href='view_checkup.php?id={$rowCheckup['id']}'>View File</a></p>";
					}
				} else {
					echo "<p>No checkup history found.</p>";
				}
				?>
				<label for="checkup-file">Upload Checkup File</label>
				<input type="file" id="checkup-file" name="checkup-file">
			</div>

			<!-- Prescription -->
			<div class="info-block">
				<h3>Prescription:</h3>
				<?php
				$sqlPrescriptions = "SELECT * FROM prescriptions WHERE patient_id = $patient_id";
				$resultPrescriptions = $conn->query($sqlPrescriptions);

				if ($resultPrescriptions->num_rows > 0) {
					while ($rowPrescription = $resultPrescriptions->fetch_assoc()) {
						echo "<p>Date: {$rowPrescription['date']} | <a href='view_prescription.php?id={$rowPrescription['id']}'>View File</a></p>";
					}
				} else {
					echo "<p>No prescriptions found.</p>";
				}
				?>
				<label for="prescription-file">Upload Prescription File</label>
				<input type="file" id="prescription-file" name="prescription-file">
			</div>

			<!-- Lab Results -->
			<div class="info-block">
				<h3>Lab Results:</h3>
				<?php
				$sqlLabResults = "SELECT * FROM lab_results WHERE patient_id = $patient_id";
				$resultLabResults = $conn->query($sqlLabResults);

				if ($resultLabResults->num_rows > 0) {
					while ($rowLabResult = $resultLabResults->fetch_assoc()) {
						echo "<p>Date: {$rowLabResult['date']} | <a href='view_lab_result.php?id={$rowLabResult['id']}'>View File</a></p>";
					}
				} else {
					echo "<p>No lab results found.</p>";
				}
				?>
				<label for="lab-result-file">Upload Lab Result File</label>
				<input type="file" id="lab-result-file" name="lab-result-file">
			</div>
		</div>
	</div>
</div>

	<!-- File Upload -->
	<div class="file-upload">
		<input type="file" id="file-input">
		<label for="file-input">Upload File</label>
	</div>
</body>
</html>