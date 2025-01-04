<?php
// Include the database connection file
include 'db_connect.php';
session_start();

// Initialize error variable
$error = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Validate inputs
   if (empty($email) || empty($password)) {
      $error = "Please fill in both fields.";
   } else {
      // Prepare a query to check if the user exists
      $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
      $stmt->execute([$email]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
         // Verify the password
         if ($password==$user['password']) {
            // Start session and set user info
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            // Redirect to a protected page (e.g., dashboard)
            if($user['role']=="admin") {
               header("Location: admin.php");
            } else {
               header("Location: jobs.php");
            }
            exit();
         } else {
            $error = "Incorrect password.";
         }
      } else {
         $error = "No user found with this email.";
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="css/auth.css">
   <link rel="stylesheet" href="css/navbar.css" />
   <link rel="stylesheet" href="css/footer.css" />
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>

   <!-- Header Section-->
   <?php include 'components/user_header.php'; ?>
   <!-- Login Form-->
   <div class="login" id="loginAccessRegister">
      <div class="login__access">
         <h1 class="login__title">Log in to your account.</h1>

         <?php if ($error): ?>
            <div class="login__error">
               <p><?php echo $error; ?></p>
            </div>
         <?php endif; ?>

         <div class="login__area">
            <form action="login.php" method="POST" class="login__form">
               <div class="login__content">
                  <div class="login__box">
                     <input type="email" name="email" id="email" required placeholder=" " class="login__input">
                     <label for="email" class="login__label">Email</label>
                     <i class="ri-mail-fill login__icon"></i>
                  </div>

                  <div class="login__box">
                     <input type="password" name="password" id="password" required placeholder=" " class="login__input">
                     <label for="password" class="login__label">Password</label>
                     <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                  </div>
               </div>

               <a href="#" class="login__forgot">Forgot your password?</a>
               <button type="submit" class="login__button">Login</button>
            </form>

            <p class="login__switch">
               Don't have an account?
               <a href="register.php" id="loginButtonRegister">Create Account</a>
            </p>
         </div>
      </div>

   </div>

   <!-- Footer Section-->
   <?php include 'components/footer.php'; ?>

   <script src="js/main.js"></script>

</body>

</html>