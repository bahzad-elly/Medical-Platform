# MediConnect - Medical Appointment & Knowledge Platform

**University of Sulaimani - Computer Science Department** **Course:** Database Concept  
**Supervisor:** Dr. Mohammed Anwar  

---

## 📖 About the Project
MediConnect is a web-based medical platform designed to seamlessly connect patients with doctors, reducing critical waiting times and improving healthcare accessibility. Beyond just an appointment booking system, this platform combats medical misinformation in the digital age by featuring a "Knowledge Hub"—a dedicated space where verified doctors can publish reliable, peer-reviewed medical articles to empower patients.

## 👥 Team Members & Contributions
* **Mohammed Mosab Abdulkareem** (Team Lead)
* **Hardi Ali Hameed** * **Daryan Omer Mohammed** * **Arin Anwar Ahmed** ## ✨ Key Features
1.  **Patient-Doctor Connectivity:** Browse verified doctors, view their detailed profiles (CV, experience, specialty), and read reviews.
2.  **Instant Online Booking:** Patients can securely book appointments by selecting their preferred date and time.
3.  **Medical Knowledge Hub:** A library of articles published directly by doctors to educate patients and combat health misinformation.
4.  **Rating & Review System:** Patients can leave 1 to 5-star ratings and comments after their appointments.
5.  **Admin Dashboard:** A centralized view mapping complex relational data (Doctors, Patients, and Appointments) using SQL `JOIN` queries.

## 🛠️ Technologies Used
* **Frontend:** HTML5, CSS3 
* **Backend:** PHP (Procedural & Object-Oriented MySQLi)
* **Database:** MySQL (Relational Database Management System)
* **Architecture:** Client-Server model running on local servers (XAMPP/WAMP).

## 🗂️ File Structure
* `medical_platform.sql` - The core database schema containing 5 tables (Patients, Doctor, Appointments, Articles, Reviews).
* `db_connect.php` - Establishes the secure connection to the MySQL database.
* `index.php` - The main homepage listing top specialists.
* `doctor_profile.php` - Dynamic page displaying a specific doctor's full CV and qualifications.
* `book_appointment.php` - Form handling dual-insertion into Patients and Appointments tables.
* `articles.php` - The public Knowledge Hub displaying medical articles.
* `publish_article.php` - Interface for doctors to insert new articles into the database.
* `write_review.php` - Patient feedback form.
* `add_doctor.php` - Admin tool for populating the database.
* `dashboard.php` - Admin view linking relational data to show all scheduled appointments.

## 🚀 How to Install and Run Locally
To test and run this project on your local machine, follow these steps:

1.  **Install a Local Server:** Download and install [XAMPP](https://www.apachefriends.org/index.html) or WAMP.
2.  **Start Services:** Open the XAMPP Control Panel and start **Apache** and **MySQL**.
3.  **Set up the Database:**
    * Open your browser and go to `http://localhost/phpmyadmin/`.
    * Click on **Import** in the top menu.
    * Upload the `medical_platform.sql` file included in this project and click **Go**. This will automatically create the `MedicalPlatform` database and all necessary tables.
4.  **Host the Files:**
    * Navigate to your XAMPP installation directory (usually `C:\xampp\htdocs`).
    * Create a new folder named `mediconnect`.
    * Copy all the `.php` files into this folder.
5.  **Run the Application:**
    * Open your web browser and go to: `http://localhost/mediconnect/index.php`.
    * *(Tip: Use `add_doctor.php` first to populate the site with sample doctors!)*

---
*Developed for the 2024 Academic Year.*
