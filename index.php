<?php
// Include the database connection file
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Platform - Book Appointments & Read Articles</title>
    <style>
        /* Basic CSS Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { background-color: #f4f7f6; color: #333; }

        /* Navigation Bar */
        header { background-color: #0056b3; color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; }
        header h1 { font-size: 1.5rem; }
        nav ul { list-style: none; display: flex; gap: 1.5rem; }
        nav ul li a { color: white; text-decoration: none; font-weight: bold; }
        nav ul li a:hover { text-decoration: underline; }

        /* Hero Section */
        .hero { text-align: center; padding: 4rem 2rem; background-color: #e9ecef; }
        .hero h2 { font-size: 2.5rem; margin-bottom: 1rem; color: #0056b3; }
        .hero p { font-size: 1.2rem; margin-bottom: 2rem; color: #555; }
        .btn { padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn:hover { background-color: #218838; }

        /* Main Content - Doctor List */
        .container { padding: 3rem 5%; }
        .section-title { text-align: center; margin-bottom: 2rem; color: #0056b3; }
        
        .doctor-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .doctor-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; }
        .doctor-card img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; background-color: #ccc; }
        .doctor-card h3 { margin-bottom: 0.5rem; }
        .doctor-card p { color: #666; margin-bottom: 1rem; }
        
        /* Footer */
        footer { text-align: center; padding: 1.5rem; background-color: #333; color: white; margin-top: 2rem; }
    </style>
</head>
<body>

    <header>
        <h1>MediConnect</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Doctors</a></li>
                <li><a href="#">Knowledge Hub</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h2>Find and Book Your Doctor Instantly</h2>
        <p>Say goodbye to long waiting times. Browse trusted doctors, read verified reviews, and book appointments online.</p>
        <a href="#doctors" class="btn">Find a Doctor</a>
    </section>

    <div class="container" id="doctors">
        <h2 class="section-title">Our Top Specialists</h2>
        <div class="doctor-grid">
            
            <?php
            // Fetch doctors from the database
            $sql = "SELECT Doctor_ID, Full_Name, Specialty, Experience_Years FROM Doctor ORDER BY Experience_Years DESC LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Loop through and display each doctor
                while($row = $result->fetch_assoc()) {
                    echo "<div class='doctor-card'>";
                    // Using a placeholder image for now since we haven't uploaded photos yet
                    echo "<img src='https://via.placeholder.com/100' alt='Doctor Photo'>";
                    echo "<h3>Dr. " . htmlspecialchars($row["Full_Name"]) . "</h3>";
                    echo "<p>Specialty: " . htmlspecialchars($row["Specialty"]) . "</p>";
                    echo "<p>Experience: " . htmlspecialchars($row["Experience_Years"]) . " Years</p>";
                    echo "<a href='doctor_profile.php?id=" . $row["Doctor_ID"] . "' class='btn'>View Profile</a>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align:center; width: 100%;'>No doctors currently registered on the platform. Add some to the database!</p>";
            }
            ?>

        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> MediConnect Platform - University of Sulaimani CS Project. All Rights Reserved.</p>
    </footer>

</body>
</html>
<?php
// Close the database connection
$conn->close();
?>