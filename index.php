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

  <!-- Hero  Section-->

  <section class="hero">
    <div class="hero-box obj-width">
      <div class="h-left">
        <h1>Find the perfect freelance services for your business</h1>
        <p>
          Work with talented people at the most affordable price to get the
          most out of your time and cost
        </p>
        <div class="search">
          <input type="text" placeholder="Search your job here." />
          <a id="g-btn" href="#">Search</a>
        </div>
      </div>

        <img src="images/hero1.png" alt="" />
    </div>
  </section>
  <!-- Features  Section-->
  <section class="features sec-space obj-width">
    <h2>Need something done?</h2>
    <p>Most viewed and all-time top-selling services</p>

    <div class="fe-box">
      <div>
        <img src="images/fe 1.png" alt="" />
        <h3>Post a job</h3>
        <p>
          It's free and easy to post a job. Simply fill in a title,
          description.
        </p>
      </div>

      <div>
        <img src="images/fe 2.png" alt="" />
        <h3>Choose freelancers</h3>
        <p>
          It's free and easy to post a job. Simply fill in a title,
          description.
        </p>
      </div>

      <div>
        <img src="images/fe 3.png" alt="" />
        <h3>Pay safely</h3>
        <p>
          It's free and easy to post a job. Simply fill in a title,
          description.
        </p>
      </div>

      <div>
        <img src="images/fe 4.png" alt="" />
        <h3>We're here to help</h3>
        <p>
          It's free and easy to post a job. Simply fill in a title,
          description.
        </p>
      </div>
    </div>
  </section>
  <!-- Job Listing  Section-->
  <section class="jobs sec-space obj-width">
    <h2>Jobs in demand</h2>
    <p>Most viewed and all-time top-selling services</p>

    <ul class="job-id">
      <li data-target="all" class="active"> Recent Jobs</li>
      <li data-target="freelancer">Freelancer</li>
      <li data-target="fulltime">Full Time</li>
      <li data-target="parttime">Part Time</li>
    </ul>

    <div class="jobs-container">
      <li data-item="fulltime" class="jList">
        <img src="images/google.png" alt="" />
        <h3>Web Developer</h3>
        <p>$900-$1200/m</p>
        <span id="key">Full Time</span>
      </li>

      <li data-item="freelancer" class="jList">
        <img src="images/uber.png" alt="" />
        <h3>Freelancer</h3>
        <p>$900-$1200/m</p>
        <span id="key">Freelancer</span>
      </li>

      <li data-item="parttime" class="jList">
        <img src="images/linkedin.png" alt="" />
        <h3>Business Associate</h3>
        <p>$900-$1200/m</p>
        <span id="key">Part Time</span>
      </li>

      <li data-item="fulltime" class="jList">
        <img src="images/facebook.png" alt="" />
        <h3>Digital Marketing</h3>
        <p>$900-$1200/m</p>
        <span id="key">Full Time</span>
      </li>

      <li data-item="parttime" class="jList">
        <img src="images/yahoo.png" alt="" />
        <h3>User Experience</h3>
        <p>$900-$1200/m</p>
        <span id="key">Part Time</span>
      </li>
    </div>
  </section>

  <!-- Brand  Section-->

  <section class="trust sec-space obj-width">
    <h2>Trusted by the world's best </h2>
    <p>Most viewed and all-time top-selling services</p>

    <div class="t-box">
      <img src="images/t1.png" alt="">
      <img src="images/t2.png" alt="">
      <img src="images/t3.png" alt="">
      <img src="images/t4.png" alt="">
      <img src="images/t5.png" alt="">
      <img src="images/t6.png" alt="">

    </div>
  </section>
  <!-- Team  Section-->

  <section class="team sec-space obj-width">
    <h2>Highest Rated Freelancer </h2>
    <p>Most viewed and all-time top-selling services</p>

    <div class="team-container">
      <div class="fl-box">
        <img src="images/fl-1.png" alt="">
        <h3>Robert Fox</h3>
        <div class="skill">
          <span id="key">HTML</span>
          <span id="key">CSS</span>
          <span id="key">JS</span>
        </div>

        <a href="#" id="g-btn">View Profile</a>
      </div>

      <div class="fl-box">
        <img src="images/fl-2.png" alt="">
        <h3>Kristin Watson</h3>
        <div class="skill">
          <span id="key">HTML</span>
          <span id="key">CSS</span>
          <span id="key">JS</span>
        </div>

        <a href="#" id="g-btn">View Profile</a>
      </div>

      <div class="fl-box">
        <img src="images/fl-3.png" alt="">
        <h3>Darell Steward</h3>
        <div class="skill">
          <span id="key">HTML</span>
          <span id="key">CSS</span>
          <span id="key">JS</span>
        </div>

        <a href="#" id="g-btn">View Profile</a>
      </div>

      <div class="fl-box">
        <img src="images/fl-4.png" alt="">
        <h3>Theresa Webb</h3>
        <div class="skill">
          <span id="key">HTML</span>
          <span id="key">CSS</span>
          <span id="key">JS</span>
        </div>

        <a href="#" id="g-btn">View Profile</a>
      </div>
    </div>
  </section>

  <!-- Footer  Section-->
  <?php include 'components/footer.php'; ?>

  <script src="js/script.js"></script>
  <script src="js/toggle.js"></script>
</body>

</html>