<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MediConnect</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        header { background-color: #343a40; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 1000px; margin: 3rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #343a40; margin-bottom: 1.5rem; border-bottom: 2px solid #eee; padding-bottom: 0.5rem; }
        
        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #0056b3; color: white; }
        tr:hover { background-color: #f1f1f1; }
        
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: bold; }
        .status-pending { background-color: #ffc107; color: #333; }
        .status-confirmed { background-color: #28a745; color: white; }
    </style>
</head>
<body>

    <header>
        <h1>MediConnect Admin</h1>
        <nav>
            <ul>
                <li><a href="index.php">View Live Site</a></li>
                <li><a href="add_doctor.php">Add Doctor</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>All Scheduled Appointments</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Appt ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Complex SQL Query using JOINs to get readable names instead of just IDs
                $sql = "SELECT Appointments.Appointment_ID, Appointments.Appointment_Date, Appointments.Appointment_Time, Appointments.Status,
                               Patients.Full_Name AS Patient_Name, 
                               Doctor.Full_Name AS Doctor_Name
                        FROM Appointments
                        JOIN Patients ON Appointments.Patient_ID = Patients.Patient_ID
                        JOIN Doctor ON Appointments.Doctor_ID = Doctor.Doctor_ID
                        ORDER BY Appointments.Appointment_Date ASC, Appointments.Appointment_Time ASC";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Determine status badge color
                        $statusClass = ($row['Status'] == 'Pending') ? 'status-pending' : 'status-confirmed';
                        
                        echo "<tr>";
                        echo "<td>#" . $row['Appointment_ID'] . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['Patient_Name']) . "</strong></td>";
                        echo "<td>Dr. " . htmlspecialchars($row['Doctor_Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Appointment_Date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Appointment_Time']) . "</td>";
                        echo "<td><span class='status-badge " . $statusClass . "'>" . htmlspecialchars($row['Status']) . "</span></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No appointments scheduled yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>