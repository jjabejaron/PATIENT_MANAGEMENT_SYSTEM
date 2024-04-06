<?php
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sqlDoctor = "SELECT * FROM doctors WHERE id = $uname";
$resultDoctor = $conn->query($sqlDoctor);

if ($resultDoctor->num_rows > 0) {
	$rowDoctor = $resultDoctor->fetch_assoc();
	$doctorName = $rowDoctor['name'];
	$doctorField = $rowDoctor['field'];
} else {
	$doctorName = 'Unknown';
	$doctorField = 'Unknown';
}

$conn->close();
?>

<html>
<head>
	<title>Patient List</title>
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
	</style>
</head>
<body>
	<header>
		<div class="logo">
			<img src="path_to_your_logo_image.png" alt="Logo">
		</div>
		<div class="title">
			<h1>Patient Management System</h1>
		</div>
		<a href="logout.php" class="logout-btn">Logout</a>
	</header>
	<div class="welcome-message">
		<img src="path_to_doctor_image.png" alt="Doctor" class="doctor-image">
		<p>Welcome, <?php echo $doctorName; ?></p>
		<p>Field: <?php echo $doctorField; ?></p>
	</div>
	<h2>Patient List</h2>
	<table>
		<tr>
			<th>Patient Number</th>
			<th>Patient Name</th>
			<th>Appointment Date</th>
			<th>Appointment Time</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
		$connPatients = new mysqli($servername, $username, $password, $dbname);

		if ($connPatients->connect_error) {
			die("Connection failed: " . $connPatients->connect_error);
		}

		$sqlPatients = "SELECT * FROM patients";
		$resultPatients = $connPatients->query($sqlPatients);

		if ($resultPatients->num_rows > 0) {
			while ($rowPatient = $resultPatients->fetch_assoc()) {
				echo "<tr>";
				echo "<td>{$rowPatient['patient_number']}</td>";
				echo "<td>{$rowPatient['patient_name']}</td>";
				echo "<td>{$rowPatient['appointment_date']}</td>";
				echo "<td>{$rowPatient['appointment_time']}</td>";
				echo "<td><span class='status-circle status-{$rowPatient['status']}'>{$rowPatient['status']}</span></td>";
				echo "<td><a href='patient_info.php?number={$rowPatient['patient_number']}' class='view-btn'>View</a></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='6'>No patients found.</td></tr>";
		}

		$connPatients->close();
		?>
	</table>
</body>
</html>
