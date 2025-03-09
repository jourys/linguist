<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mainStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <title>Home</title>
</head>
<body>
    <nav class="bar">
      <img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img">
        <ul class="links">
            <li><a href="main.html" class="link ">Home</a></li>
            <li><a href="#service" class="link">Services</a></li> 
            <li><a href="About_us_pageMain.html" class="link">About Us</a></li>
            <li class="ctn"><a href="login.php">Log In</a></li> <!--update-->
        </ul>
     </nav>
    <header>
        <img src="images/mainPicture.png" alt="communication with tutors">
        <div class="header-content">
            <h2> EXPLORE, LEARN, CONNECT:</h2>
            <div class="line"></div>
            <h1>Your Easy Path to Mastering Every Language.</h1>
            <a href="signup.php" class="ctn">Join Us</a> <!-- update -->
        </div>
        
    </header>

    <section class="service" id="service">
        <div class="col">
            <img src="../images/explore.png" alt="exploring diffrenet languages">
            <h2>Explore</h2>
            <p>our vast array of languages <br> and cultures from around <br> the globe, each waiting <br>to be discovered and embraced.</p>
        </div>
        <div class="col">
            <img src="../images/learn.png" alt="learning diffrenet languages">
            <h2>Learn</h2>
            <p>at your own pace with interactive lessons, tailored to your proficiency level and learning style, ensuring steady progress on your language journey.</p>
        </div>
        <div class="col">
            <img src="../images/discover.png" alt="discovering diffrenet languages">
            <h2>Discover</h2>
            <p>with fellow language enthusiasts, native speakers, and experienced tutors to practice and exchange knowledge, fostering a supportive community dedicated to linguistic excellence.
            </p>
        </div>
    </section>
    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p> Embark on a linguistic journey with LINGUIST. Connect with native speakers worldwide,
                 hone your language skills through immersive experiences, and unlock new cultures from the comfort of your home.<a class="find-more" href="About_us_pageMain.html">Find more</a></p>
            <div class="social">
              <a href="#"><span class="fab fa-facebook-f"></span></a>
              <a href="#"><span class="fab fa-twitter"></span></a>
              <a href="#"><span class="fab fa-instagram"></span></a>
              <a href="#"><span class="fab fa-youtube"></span></a>
            </div>
          </div>
        </div>

        <div class="center box">
          <h2>Address</h2>
          <div class="content">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text">Riyadh, KSA</span>
            </div>
            <div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">+966-505432100</span>
            </div>
            <div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text"><a href="mailto:content@linguist.com"></a>
                content@linguist.com</span>
            </div>
          </div>
        </div>

        <div class="right box">
          <h2>Contact us</h2>
          <div class="content">
            <form action="#" method="post">
              <div class="email">
                <div class="text">Email <span class="required">*</span></div>
                <input type="email" required>
              </div>
              <div class="msg">
                <div class="text">Message <span class="required">*</span></div>
                <textarea rows="2" cols="25" required></textarea>
              </div>
              <div class="btn">
                <button type="submit">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="bottom">
        <section>
          <span class="credit">Created By <a href="main.html">linguist</a> | </span>
          <span class="far fa-copyright"></span><span> 2024 All rights reserved.</span>
        </section>
      </div>
    </footer>
</body>
</html>
