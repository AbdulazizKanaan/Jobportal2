<?php
session_start();

// Ensure admin access
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin') {
    $user_id = $_SESSION['user_id'];
} else {
    header('location:index.php');
    exit;
}

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form input
    $title = $_POST['title'];
    $rate = $_POST['rate'];
    $employment_type = $_POST['employment_type'];
    $companyName = $_POST['companyName'];
    $location = $_POST['location'];
    $vacancy = $_POST['vacancy'];
    $hours = $_POST['hours'];
    $description = $_POST['description'];
    $workplace = $_POST['workplace'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];

    // Handle file upload
    $uploadDir = 'images/'; // Ensure this directory is writable
    $imageFile = $uploadDir . basename($_FILES['image']['name']);
    $fileType = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));

    if (in_array($fileType, ['jpg', 'jpeg', 'png']) && move_uploaded_file($_FILES['image']['tmp_name'], $imageFile)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO jobs (image, title, rate, employment_type, company_name, location, vacancy, hours, description, workplace, education, experience) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([$imageFile, $title, $rate, $employment_type, $companyName, $location, $vacancy, $hours, $description, $workplace, $education, $experience]);
            
            echo "Job posted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload the image. Ensure it's a valid image file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/addJob.css">
    <title>Add Job</title>
</head>

<body id="body-pd">
    <!-- Sidebar -->

    <?php include 'components/sidebar.php'; ?>
    <div class="add_form">
        <div class="addForm__access">
            <h1>Add New Job</h1>
            <div class="addForm__area">
                <form action="add_job.php" method="POST" enctype="multipart/form-data">
                    <div class="addForm__content">
                        <div class="addForm__group">
                            <div class="addForm__box">
                                <input type="text" name="title" required placeholder=" " class="addForm__input">
                                <label for="title" class="addForm__label">Title</label>
                            </div>
                            <div class="addForm__box">
                                <input type="text" name="rate" required placeholder=" " class="addForm__input">
                                <label for="rate" class="addForm__label">Rate</label>
                            </div>
                        </div>
                        <div class="addForm__group">
                            <div class="addForm__box">
                                <input type="text" name="employment_type" required placeholder=" " class="addForm__input">
                                <label for="employment_type" class="addForm__label">Eployment Type</label>
                            </div>
                            <div class="addForm__box">
                                <input type="text" name="companyName" required placeholder=" " class="addForm__input">
                                <label for="companyName" class="addForm__label">Company Name</label>
                            </div>
                        </div>
                        <div class="addForm__group">
                            <div class="addForm__box">
                                <input type="text" name="location" required placeholder=" " class="addForm__input">
                                <label for="location" class="addForm__label">Location</label>
                            </div>
                            <div class="addForm__box">
                                <input type="text" name="vacancy" required placeholder=" " class="addForm__input">
                                <label for="vacancy" class="addForm__label">Vacancy</label>
                            </div>
                        </div>
                        <div class="addForm__group">
                            <div class="addForm__box">
                                <input type="text" name="hours" required placeholder=" " class="addForm__input">
                                <label for="hours" class="addForm__label">Hours</label>
                            </div>
                            <div class="addForm__box">
                                <input type="text" name="workplace" required placeholder=" " class="addForm__input">
                                <label for="workplace" class="addForm__label">Workplace</label>
                            </div>
                        </div>
                        <div class="addForm__group">
                            <div class="addForm__box">
                                <input type="text" name="education" required placeholder=" " class="addForm__input">
                                <label for="education" class="addForm__label">Education</label>
                            </div>
                            <div class="addForm__box">
                                <input type="text" name="experience" required placeholder=" " class="addForm__input">
                                <label for="experience" class="addForm__label">Experience</label>
                            </div>
                        </div>
                        <div class="addForm__box">
                            <input type="text" name="description" required placeholder=" " class="addForm__input">
                            <label for="description" class="addForm__label">Description</label>
                        </div>
                        <div class="addForm__box">
                            <input type="file" name="image" accept="image/*" required class="addForm__input">
                            <label for="image" class="addForm__label">Image URL</label>
                        </div>

                        <button type="submit" class="addForm__button">Add Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="js/sidebar.js"></script>
</body>

</html>