<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Hub - Medical Articles</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; color: #333; }
        header { background-color: #0056b3; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        
        .container { max-width: 1000px; margin: 3rem auto; padding: 0 2rem; }
        .page-title { text-align: center; color: #0056b3; margin-bottom: 2rem; font-size: 2.5rem; }
        
        .article-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        .article-title { color: #0056b3; margin-bottom: 0.5rem; }
        .article-meta { font-size: 0.9rem; color: #666; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; }
        .article-content { line-height: 1.6; }
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
        <h2 class="page-title">Medical Knowledge Hub</h2>
        <p style="text-align: center; margin-bottom: 2rem; color: #555;">Read trusted articles published by our verified specialists.</p>

        <?php
        // Fetch articles AND the name of the doctor who wrote them using a SQL JOIN
        $sql = "SELECT Articles.Title, Articles.Content, Articles.Published_Date, Doctor.Full_Name 
                FROM Articles 
                JOIN Doctor ON Articles.Doctor_ID = Doctor.Doctor_ID 
                ORDER BY Articles.Published_Date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='article-card'>";
                echo "<h3 class='article-title'>" . htmlspecialchars($row["Title"]) . "</h3>";
                echo "<div class='article-meta'>Published on " . htmlspecialchars($row["Published_Date"]) . " | Written by <strong>Dr. " . htmlspecialchars($row["Full_Name"]) . "</strong></div>";
                // Only show a snippet of the content
                echo "<p class='article-content'>" . substr(htmlspecialchars($row["Content"]), 0, 200) . "...</p>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center;'>No articles published yet.</p>";
        }
        ?>

    </div>

</body>
</html>