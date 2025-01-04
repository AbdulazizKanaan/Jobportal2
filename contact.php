<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobQuestify - Search Jobs</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <!-- Header  Section-->
  <?php include 'components/user_header.php'; ?>

  <!-- Contact-->
  <section class="contact obj-width sec-space extra-space">
    <div class="contact-img">
      <h2>Get in touch</h2>
      <p>Most viewed and all-time top-selling services</p>
      <img src="images/contact.svg" alt="" />
    </div>
    <form id="contact-form" method="post" action="send_email.php">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" autocomplete="off" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" autocomplete="off" required>

      <label for="message">Message:</label>
      <textarea name="message" id="message" rows="5" required></textarea>

      <input type="submit" id="g-btn" value="Submit" />

    </form>
  </section>

  <section class="contact obj-width sec-space">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.
        97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f08
        3b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sph!4v1732541282528!5m2!1sen!2sph"
      width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </section>

  <!-- Footer  Section-->
  <?php include 'components/footer.php'; ?>

  <script src="js/script.js"></script>
  <script src="js/toggle.js"></script>
</body>

</html>