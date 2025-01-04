<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jobId = $_POST['job_id'];
    $userId = $_POST['user_id'];
    $coverLetter = htmlspecialchars(trim($_POST['coverLetter']));

    // Handle file upload
    $uploadDir = 'uploads/';
    $resume = $uploadDir . basename($_FILES['resume']['name']);
    $fileType = strtolower(pathinfo($resume, PATHINFO_EXTENSION));

    if (in_array($fileType, ['pdf', 'doc', 'docx']) && move_uploaded_file($_FILES['resume']['tmp_name'], $resume)) {
        include 'db_connect.php';
        $stmt = $pdo->prepare("INSERT INTO job_applications (cover_letter, resume_path,user_id,job_id) VALUES (?, ?, ?, ?)");

        try {
            $stmt->execute([$coverLetter, $resume, $userId, $jobId]);
            echo "Your application has been submitted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload resume. Please try again.";
    }
}
?>
