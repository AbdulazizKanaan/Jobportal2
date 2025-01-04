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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_id'], $_POST['status'])) {
    $application_id = intval($_POST['application_id']);
    $status = $_POST['status'];

    if (in_array($status, ['accepted', 'rejected'])) {
        $sql = "UPDATE job_applications SET status = :status WHERE id = :application_id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['status' => $status, 'application_id' => $application_id])) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid status.']);
    }
    exit(); // Prevent further processing
}

// Fetch job data from the database with search filter
$sql = "SELECT 
    ja.id AS application_id, 
    ja.cover_letter, 
    ja.resume_path, 
    ja.applied_at, 
    ja.user_id, 
    ja.job_id, 
    ja.status,
    j.title AS job_title,
    u.email AS user_email 
FROM job_applications ja 
JOIN user u ON ja.user_id = u.id
JOIN jobs j ON ja.job_id = j.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$jobApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h2>Job Applications</h2>
            <table>
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Cover Letter</th>
                        <th>Resume</th>
                        <th>Applied At</th>
                        <th>User</th>
                        <th>Job Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="applications-list">
                    <?php if (!empty($jobApplications)): ?>
                        <?php foreach ($jobApplications as $application): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($application['application_id']); ?></td>
                                <td><?php echo htmlspecialchars($application['cover_letter']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($application['resume_path']); ?>" target="_blank">View
                                        Resume</a>
                                </td>
                                <td><?php echo htmlspecialchars($application['applied_at']); ?></td>
                                <td><?php echo htmlspecialchars($application['user_email']); ?></td>
                                <td><?php echo htmlspecialchars($application['job_title']); ?></td>
                                <td><?php echo htmlspecialchars($application['status']); ?></td>
                                <td style="display:flex;">
                                    <?php if ($application['status'] === 'pending'): ?>
                                        <!-- Display Accept and Reject buttons -->
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="application_id"
                                                value="<?php echo $application['application_id']; ?>">
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit"
                                                onclick="return confirm('Accept this application?')">Accept</button>
                                        </form>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="application_id"
                                                value="<?php echo $application['application_id']; ?>">
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="reject-btn" type="submit"
                                                onclick="return confirm('Reject this application?')">Reject</button>
                                        </form>
                                    <?php elseif ($application['status'] === 'accepted'): ?>
                                        <!-- Display green checkmark for accepted -->
                                        <span style="color: green; font-size: 1.5em;">&#10004;</span>
                                    <?php elseif ($application['status'] === 'rejected'): ?>
                                        <!-- Display red X for rejected -->
                                        <span style="color: red; font-size: 1.5em;">&#10060;</span>
                                    <?php endif; ?>
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