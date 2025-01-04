<?php
// Include the database connection file
include 'db_connect.php';

// Initialize error and success variables
$error = "";
$success = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim and sanitize inputs
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['emailCreate']);
    $password = trim($_POST['passwordCreate']);

    // Validate inputs
    if (empty($name) || empty($surname) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare a query to insert the new user
        $stmt = $pdo->prepare("INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$name, $surname, $email, $hashedPassword]);
            $success = "Account created successfully. You can now log in.";
        } catch (PDOException $e) {
            // Check for duplicate email error
            if ($e->getCode() == 23000) {
                $error = "An account with this email already exists.";
            } else {
                $error = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/auth.css">
   <link rel="stylesheet" href="css/navbar.css" />
   <link rel="stylesheet" href="css/footer.css" />
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <title>Create Account</title>
</head>

<body>

   <!-- Header Section-->
   <?php include 'components/user_header.php'; ?>

   <div>
      <!-- Register Form-->
      <div class="login" id="loginAccessRegister">
         <div class="login__register">
            <h1 class="login__title">Create new account.</h1>

            <?php if ($error): ?>
                <div class="login__error">
                    <p><?php echo $error; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="login__success">
                    <p><?php echo $success; ?></p>
                </div>
            <?php endif; ?>

            <div class="login__area">
               <form action="register.php" method="POST" class="login__form">
                  <div class="login__content">
                     <div class="login__group">
                        <div class="login__box">
                           <input type="text" name="name" required placeholder=" " class="login__input">
                           <label for="name" class="login__label">Name</label>
                           <i class="ri-id-card-fill login__icon"></i>
                        </div>

                        <div class="login__box">
                           <input type="text" name="surname" required placeholder=" " class="login__input">
                           <label for="surname" class="login__label">Surname</label>
                           <i class="ri-id-card-fill login__icon"></i>
                        </div>
                     </div>

                     <div class="login__box">
                        <input type="email" name="emailCreate" required placeholder=" " class="login__input">
                        <label for="emailCreate" class="login__label">Email</label>
                        <i class="ri-mail-fill login__icon"></i>
                     </div>

                     <div class="login__box">
                        <input type="password" name="passwordCreate" required placeholder=" " class="login__input">
                        <label for="passwordCreate" class="login__label">Password</label>
                        <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                     </div>
                  </div>

                  <button type="submit" class="login__button">Create account</button>
               </form>

               <p class="login__switch">
                  Already have an account?
                  <a href="login.php"  id="loginButtonAccess">Log In</a>
               </p>
            </div>
         </div>
      </div>
   </div>

   <!-- Footer Section-->
   <?php include 'components/footer.php'; ?>

   <script src="js/main.js"></script>
</body>

</html>
