<?php
require_once 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['full_name']);
    $specialty = $conn->real_escape_string($_POST['specialty']);
    $experience = intval($_POST['experience_years']);
    $qualifications = $conn->real_escape_string($_POST['qualifications']);
    $cv_text = $conn->real_escape_string($_POST['cv_text']);

    $sql = "INSERT INTO Doctor (Full_Name, Specialty, Experience_Years, Qualifications, CV_Text, Profile_Photo) 
            VALUES ('$name', '$specialty', $experience, '$qualifications', '$cv_text', 'default.jpg')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success'>Doctor added successfully! Check your homepage.</div>";
    } else {
        $message = "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add Doctor</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #e9ecef; color: #333; padding: 2rem; }
        .container { max-width: 600px; margin: auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 1.5rem; text-align: center; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        textarea { resize: vertical; height: 100px; }
        .btn-submit { width: 100%; padding: 12px; background-color: #0056b3; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 1rem; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add a New Doctor</h2>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Doctor's Full Name (without 'Dr.')</label>
                <input type="text" name="full_name" required>
            </div>
            <div class="form-group">
                <label>Specialty</label>
                <input type="text" name="specialty" required placeholder="e.g., Cardiologist, Pediatrician">
            </div>
            <div class="form-group">
                <label>Years of Experience</label>
                <input type="number" name="experience_years" required min="0">
            </div>
            <div class="form-group">
                <label>Qualifications</label>
                <textarea name="qualifications" required placeholder="e.g., MD from University of Sulaimani..."></textarea>
            </div>
            <div class="form-group">
                <label>CV / Bio</label>
                <textarea name="cv_text" required placeholder="Write a short biography..."></textarea>
            </div>
            <button type="submit" class="btn-submit">Add Doctor to System</button>
        </form>
        <div style="text-align: center; margin-top: 1rem;">
            <a href="index.php">Go back to Homepage</a>
        </div>
    </div>

</body>
</html>