<?php
require_once 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = intval($_POST['doctor_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $published_date = date("Y-m-d"); // Automatically sets today's date

    $sql = "INSERT INTO Articles (Doctor_ID, Title, Content, Published_Date) 
            VALUES ($doctor_id, '$title', '$content', '$published_date')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success'>Article published successfully! Check the Knowledge Hub.</div>";
    } else {
        $message = "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Publish Article - MediConnect</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        header { background-color: #0056b3; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #0056b3; margin-bottom: 1.5rem; text-align: center; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        input[type="text"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        textarea { resize: vertical; height: 200px; }
        .btn-submit { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; }
        .btn-submit:hover { background-color: #218838; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center; }
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
        <h2>Publish a Medical Article</h2>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Author (Select Doctor)</label>
                <select name="doctor_id" required>
                    <option value="">-- Choose Doctor --</option>
                    <?php
                    // Fetch doctors for the dropdown
                    $docs = $conn->query("SELECT Doctor_ID, Full_Name FROM Doctor");
                    while($row = $docs->fetch_assoc()) {
                        echo "<option value='" . $row['Doctor_ID'] . "'>Dr. " . htmlspecialchars($row['Full_Name']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Article Title</label>
                <input type="text" name="title" required placeholder="e.g., The Importance of Heart Health">
            </div>
            
            <div class="form-group">
                <label>Article Content</label>
                <textarea name="content" required placeholder="Write your medical article here..."></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Publish Article</button>
        </form>
    </div>

</body>
</html>