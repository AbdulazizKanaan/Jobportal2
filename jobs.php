<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "jobquestify"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the search query
$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

// Fetch job data from the database with search filter
$sql = "SELECT `id`, `image`, `title`, `rate`, `employment_type` FROM `jobs`";
if (!empty($searchQuery)) {
    $sql .= " WHERE `title` LIKE ?";
}

$stmt = $conn->prepare($sql);
if (!empty($searchQuery)) {
    $likeQuery = '%' . $searchQuery . '%';
    $stmt->bind_param('s', $likeQuery);
}
$stmt->execute();
$result = $stmt->get_result();

$jobs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
} else {
    $jobs = [];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobQuestify - Search Jobs</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->
    <?php include 'components/user_header.php'; ?>

    <!-- Job Listing Section -->
    <section class="jobs sec-space obj-width extra-space">
        <h2>Jobs in Demand</h2>
        <p>Most viewed and all-time top-selling services</p>

        <!-- Search Form -->
        <form method="POST" action="">
            <i class='bx bx-search'></i>
            <input type="text" name="search" placeholder="Search Jobs" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Job Listings -->
        <div class="jobs-container" id="root">
            <?php if (!empty($jobs)) : ?>
                <?php foreach ($jobs as $job) : ?>
                    <a class="jList" href="job-details.php?id=<?php echo htmlspecialchars($job['id']); ?>">
                        <img src="<?php echo htmlspecialchars($job['image']); ?>" alt="<?php echo htmlspecialchars($job['title']); ?>">
                        <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                        <p><?php echo htmlspecialchars($job['rate']); ?></p>
                        <span id="key"><?php echo htmlspecialchars($job['employment_type']); ?></span>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No jobs found matching your criteria.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'components/footer.php'; ?>
    <script src="js/toggle.js"></script>
</body>

</html>
