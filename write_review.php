<?php
require_once 'db_connect.php';

$message = "";
$doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doc_id = intval($_POST['doctor_id']);
    $patient_id = intval($_POST['patient_id']);
    $rating = intval($_POST['rating']);
    $comment = $conn->real_escape_string($_POST['comment']);

    $sql = "INSERT INTO Reviews (Doctor_ID, Patient_ID, Rating, Comment) 
            VALUES ($doc_id, $patient_id, $rating, '$comment')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success'>Thank you! Your review has been submitted.</div>";
    } else {
        $message = "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write Review - MediConnect</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        header { background-color: #0056b3; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 500px; margin: 3rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #0056b3; margin-bottom: 1.5rem; text-align: center; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        select, input[type="number"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        textarea { resize: vertical; height: 100px; }
        .btn-submit { width: 100%; padding: 12px; background-color: #ffc107; color: #333; border: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; }
        .btn-submit:hover { background-color: #e0a800; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center; }
    </style>
</head>
<body>

    <header>
        <h1>MediConnect</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Rate Your Doctor</h2>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
            
            <div class="form-group">
                <label>Who are you? (Select Patient)</label>
                <select name="patient_id" required>
                    <option value="">-- Select Your Name --</option>
                    <?php
                    // Fetch existing patients for the dropdown
                    $patients = $conn->query("SELECT Patient_ID, Full_Name FROM Patients");
                    while($row = $patients->fetch_assoc()) {
                        echo "<option value='" . $row['Patient_ID'] . "'>" . htmlspecialchars($row['Full_Name']) . "</option>";
                    }
                    ?>
                </select>
                <small style="color: gray;">*You must book an appointment first to appear on this list.</small>
            </div>
            
            <div class="form-group">
                <label>Rating (1 to 5 Stars)</label>
                <input type="number" name="rating" min="1" max="5" required placeholder="5">
            </div>
            
            <div class="form-group">
                <label>Leave a Comment</label>
                <textarea name="comment" required placeholder="How was your visit?"></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Submit Review</button>
        </form>
    </div>

</body>
</html>