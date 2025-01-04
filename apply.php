<?php
// Include database connection
session_start();
include 'db_connect.php';

if(isset($_SESSION['user_id']) && $_SESSION['user_role']=='user'){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
    header('location:index.php');
 };

// Retrieve job ID from URL
$jobId = $_GET['job_id'] ?? null;

if ($jobId) {
    // Fetch job details from the database
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$jobId]);
    $job = $stmt->fetch();
} else {
    echo "Job not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="application.css">
    <title>Apply for <?php echo htmlspecialchars($job['title']); ?></title>
</head>

<body>
    <header>
        <h1>Apply for <?php echo htmlspecialchars($job['title']); ?></h1>
        <p>Position at <?php echo htmlspecialchars($job['company_name']); ?></p>
    </header>

    <main>
        <form action="submit_application.php" method="POST" enctype="multipart/form-data" class="application-form">
            <input type="hidden" name="job_id" value="<?php echo $jobId; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="form-group">
                <label for="resume">Upload Resume</label>
                <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
            </div>

            <div class="form-group">
                <label for="coverLetter">Cover Letter</label>
                <textarea id="coverLetter" name="coverLetter" rows="5" required></textarea>
            </div>

            <button type="submit" class="apply-btn">Submit Application</button>
        </form>
    </main>
</body>

</html>
