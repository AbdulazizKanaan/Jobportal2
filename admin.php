<?php

session_start();

if(isset($_SESSION['user_id']) && $_SESSION['user_role']=='admin'){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};

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
      <header>
        <h1>Job Portal</h1>
      </header>

      <!-- Stats Cards Section -->
      <section class="stats">
        <div class="card">Total Jobs Posted<br><span id="total-jobs">1250+</span></div>
        <div class="card">Total Jobs Filled<br><span id="total-filled">5386+</span></div>
        <div class="card">Top Companies<br><span id="top-companies">165+</span></div>
        <div class="card">Freelancers<br><span id="freelancers">870+</span></div>
      </section>

      <!-- Chart Section -->
      <section class="chart-container">
        <canvas id="jobChart"></canvas>
      </section>

      <!-- Applications Section -->
      <section class="applications">
        <h2>Job Applications</h2>
        <table>
          <thead>
            <tr>
              <th>Applicant</th>
              <th>Job Title</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="applications-list">
            <!-- Dynamically loaded applications will go here -->
          </tbody>
        </table>
      </section>
    </main>

  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  <script src="js/sidebar.js"></script>
  <script>
    // Example data - this should come from your server/database
    const applications = [
      { name: "Jane Doe", jobTitle: "Frontend Developer", status: "Pending", id: 1 },
      { name: "John Smith", jobTitle: "Backend Developer", status: "Pending", id: 2 },
    ];

    // Dynamically populate the applications table
    const applicationsList = document.getElementById('applications-list');
    applications.forEach(app => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${app.name}</td>
        <td>${app.jobTitle}</td>
        <td>${app.status}</td>
        <td>
          <button class="approve-btn" onclick="handleApplication(${app.id}, 'approved')">Approve</button>
          <button class="reject-btn" onclick="handleApplication(${app.id}, 'rejected')">Reject</button>
        </td>
      `;
      applicationsList.appendChild(row);
    });

    // Handle approval/rejection of job applications
    function handleApplication(id, status) {
      // Update the status in your database here (e.g., via AJAX to your backend)
      console.log(`Application ID: ${id} has been ${status}`);

      // For now, we just log to the console. You can replace this with a database update.
    }

    // Job Chart (Example, you can replace this with real data)
    const ctx = document.getElementById('jobChart').getContext('2d');
    const jobChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
          label: 'Jobs Posted',
          data: [12, 19, 3, 5, 2],
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <script src="script.js"></script>
</body>
</html>
