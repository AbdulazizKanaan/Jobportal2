<?php

session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin') {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:index.php');
}
;
include 'db_connect.php';
// Handle job deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $job_id = intval($_POST['job_id']);
    $sql = "DELETE FROM `jobs` WHERE id = :job_id";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['job_id' => $job_id])) {
        $_SESSION['message'] = 'Job deleted successfully.';
    } else {
        $_SESSION['message'] = 'Failed to delete the job.';
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
// Fetch job data from the database with search filter
$sql = "SELECT * FROM `jobs`";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Job Applications</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="body-pd">
    <!-- Sidebar -->

    <?php include 'components/sidebar.php'; ?>

    <!-- Main Content -->
    <main>
        <section class="applications">
            <h2>Jobs</h2>
            <a href="add_job.php" class="addJob">Add job</a>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rate</th>
                        <th>Employment type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="applications-list">
                    <?php if (!empty($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($job['title']); ?></td>
                                <td><?php echo htmlspecialchars($job['rate']); ?></td>
                                <td><?php echo htmlspecialchars($job['employment_type']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                                        <button type="submit" class="reject-btn"
                                            onclick="return confirm('Are you sure you want to delete this job?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No jobs found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="script.js"></script>
</body>

</html>