<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($job['title']); ?> - Job Details</title>
  <link rel="stylesheet" href="css/jobDetails.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>

  <!-- Header Section -->
  <?php include 'components/user_header.php'; ?>

  <?php
  // Get job ID from the URL
  $job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

  if ($job_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($job) {
      ?>
      <div class="container">
        <div id="jobDetails">
          <div class="job-header">
            <div class="job-img-row">
              <img src="<?php echo htmlspecialchars($job['image']); ?>" alt="" />
              <div>
                <h2><?php echo htmlspecialchars($job['company_name']); ?></h2>
                <span><?php echo htmlspecialchars($job['location']); ?></span>
              </div>
            </div>
            <a href="apply.php?job_id=<?php echo htmlspecialchars($job['id']); ?>" class="apply-btn">Apply Now</a>

          </div>

          <div class="features">
            <div class="fe-box">
              <div>
                <img src="images/vacancy.png" alt="" />
                <h3>Vacancy</h3>
                <p><?php echo htmlspecialchars($job['vacancy']); ?></p>
              </div>
              <div>
                <img src="images/fe 1.png" alt="" />
                <h3>Position</h3>
                <p><?php echo htmlspecialchars($job['title']); ?></p>
              </div>
              <div>
                <img src="images/hour.png" alt="" />
                <h3>Hours</h3>
                <p><?php echo htmlspecialchars($job['hours']); ?></p>
              </div>
              <div>
                <img src="images/salary.png" alt="" />
                <h3>Salary</h3>
                <p><?php echo htmlspecialchars($job['rate']); ?></p>
              </div>
            </div>
          </div>

          <div class="job-description">
            <div>
              <h3>Job Description</h3>
              <p><?php echo htmlspecialchars($job['description']); ?></p>
            </div>
            <div>
              <h3>Employment Status</h3>
              <p><?php echo htmlspecialchars($job['employment_type']); ?></p>
            </div>
            <div>
              <h3>Workplace</h3>
              <p><?php echo htmlspecialchars($job['workplace']); ?></p>
            </div>
            <div>
              <h3>Educational Requirements</h3>
              <p><?php echo htmlspecialchars($job['education']); ?></p>
            </div>
            <div>
              <h3>Experience Requirements</h3>
              <p><?php echo htmlspecialchars($job['experience']); ?></p>
            </div>
          </div>
        </div>
      </div>
      <?php
    } else {
      echo "<p>Job not found.</p>";
    }
  } else {
    echo "<p>Invalid job ID.</p>";
  }
  ?>

  <!-- Footer Section -->
  <?php include 'components/footer.php'; ?>
  <script src="js/toggle.js"></script>

</body>

</html>