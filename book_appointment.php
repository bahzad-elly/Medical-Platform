<?php
require_once 'db_connect.php';

$message = "";
$doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doc_id = intval($_POST['doctor_id']);
    $patient_name = $conn->real_escape_string($_POST['full_name']);
    $contact_info = $conn->real_escape_string($_POST['contact_info']);
    $medical_history = $conn->real_escape_string($_POST['medical_history']);
    $appt_date = $conn->real_escape_string($_POST['appointment_date']);
    $appt_time = $conn->real_escape_string($_POST['appointment_time']);

    // Step 1: Insert Patient into the Patients table
    $sql_patient = "INSERT INTO Patients (Full_Name, Contact_Info, Medical_History) VALUES ('$patient_name', '$contact_info', '$medical_history')";
    
    if ($conn->query($sql_patient) === TRUE) {
        $patient_id = $conn->insert_id; // Get the newly created Patient_ID

        // Step 2: Insert the Appointment into the Appointments table
        $sql_appt = "INSERT INTO Appointments (Patient_ID, Doctor_ID, Appointment_Date, Appointment_Time, Status) 
                     VALUES ($patient_id, $doc_id, '$appt_date', '$appt_time', 'Pending')";
        
        if ($conn->query($sql_appt) === TRUE) {
            $message = "<div class='success'>Appointment booked successfully! Your status is Pending.</div>";
        } else {
            $message = "<div class='error'>Error booking appointment: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='error'>Error registering patient: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - MediConnect</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        header { background-color: #0056b3; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 600px; margin: 3rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #0056b3; margin-bottom: 1.5rem; text-align: center; }
        
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="time"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        textarea { resize: vertical; height: 80px; }
        
        .btn-submit { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; margin-top: 1rem; }
        .btn-submit:hover { background-color: #218838; }
        
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center; }
    </style>
</head>
<body>

    <header>
        <h1>MediConnect</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="articles.php">Knowledge Hub</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Book Your Appointment</h2>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" required placeholder="John Doe">
            </div>
            
            <div class="form-group">
                <label>Contact Info (Phone/Email)</label>
                <input type="text" name="contact_info" required placeholder="0770 123 4567">
            </div>
            
            <div class="form-group">
                <label>Brief Medical History / Reason for Visit</label>
                <textarea name="medical_history" placeholder="Any allergies, previous conditions, or current symptoms..."></textarea>
            </div>
            
            <div class="form-group">
                <label>Preferred Date</label>
                <input type="date" name="appointment_date" required>
            </div>
            
            <div class="form-group">
                <label>Preferred Time</label>
                <input type="time" name="appointment_time" required>
            </div>
            
            <button type="submit" class="btn-submit">Confirm Booking</button>
        </form>
    </div>

</body>
</html>