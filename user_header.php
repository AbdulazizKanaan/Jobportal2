<?php
include 'db_connect.php';
// Sample query for fetching user info (modify as needed)
session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
}
?>
<header>
  <div class="navbar">
    <h1>JobQuestify</h1>
    <?php if (!empty($user)): ?>
      <p>Welcome, <?= htmlspecialchars($user['username']); ?></p>
    <?php else: ?>
      <a href="login.php">Login</a>
    <?php endif; ?>
  </div>
</header>
