<?php
require_once 'db_connect.php';

// Check if a doctor ID was passed in the URL
if (isset($_GET['id'])) {
    $doctor_id = intval($_GET['id']); // intval for basic security
    
    // Fetch doctor details
    $sql = "SELECT * FROM Doctor WHERE Doctor_ID = $doctor_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
    } else {
        die("Doctor not found.");
    }
} else {
    die("No doctor selected.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. <?php echo htmlspecialchars($doctor['Full_Name']); ?> - Profile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        header { background-color: #0056b3; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .profile-header { display: flex; gap: 2rem; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 2rem; margin-bottom: 2rem; }
        .profile-header img { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; background-color: #ccc; }
        .profile-info h2 { color: #0056b3; margin-bottom: 0.5rem; }
        .badge { display: inline-block; background: #28a745; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.9rem; margin-bottom: 1rem; }
        
        .section-title { color: #0056b3; margin-bottom: 1rem; margin-top: 1.5rem;}
        .content-box { background: #f9f9f9; padding: 1rem; border-left: 4px solid #0056b3; margin-bottom: 1rem; }
        
        .btn-book { display: block; width: 100%; text-align: center; padding: 15px; background-color: #0056b3; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; margin-top: 2rem; }
        .btn-book:hover { background-color: #004494; }
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
        <div class="profile-header">
            <img src="https://via.placeholder.com/150" alt="Dr. <?php echo htmlspecialchars($doctor['Full_Name']); ?>">
            <div class="profile-info">
                <h2>Dr. <?php echo htmlspecialchars($doctor['Full_Name']); ?></h2>
                <span class="badge"><?php echo htmlspecialchars($doctor['Specialty']); ?></span>
                <p><strong>Experience:</strong> <?php echo htmlspecialchars($doctor['Experience_Years']); ?> Years</p>
            </div>
        </div>

        <h3 class="section-title">Qualifications</h3>
        <div class="content-box">
            <p><?php echo nl2br(htmlspecialchars($doctor['Qualifications'])); ?></p>
        </div>

        <h3 class="section-title">Professional CV</h3>
        <div class="content-box">
            <p><?php echo nl2br(htmlspecialchars($doctor['CV_Text'])); ?></p>
        </div>

        <a href="#" class="btn-book">Book an Appointment Now</a>
    </div>

</body>
</html>