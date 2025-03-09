<!DOCTYPE html>
<html><!--previous sessions for learner-->
  <head>
    <meta charset="utf-8" />
    <title>Tutor sessions</title>
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" type="text/css" href="css/sidebar-tutor.css" />
    <link rel="stylesheet" type="text/css" href="css/PreviousSessionsTutor.css"/>
    <link rel="stylesheet" type="text/css" href="css/SessionLearner.css"/>
    <link rel="stylesheet" type="text/css" href="css/PreviousSessionsTutor.css"/>


    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="header_folder/headerPartner.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
  </head>
  <script
    src="https://kit.fontawesome.com/5a18e3112f.js"
    crossorigin="anonymous"
  ></script>
  <body>
    <header id="header">
      <div id="header-div">
        <nav class="fixed-top" id="main-nav">
          <ul id="ul1">
            <li>
              <img
                src="images/linguistBlueAndWhite.jpg"
                alt="LINGUIST logo"
                id="logo-img"
              />
            </li>
            <li class="list1-item">
              <a href="tutor_Home_page.html" class="list1-item">Home</a>
            </li>
            <li class="list1-item"><a href="SESSionTutor.html">Sessions</a></li>
            <li class="list1-item"><a href="tutorReq.html">Requests</a></li>
            <li class="list1-item">
              <a href="toturRate.html">Rate and Review</a>
            </li>
            <li class="list1-item">
              <a href="SupportsPartner.html">Support</a>
            </li>
          </ul>
          <ul id="ul2">
            <li id="acnt li">
              <nav id="account-nav">
                <img src="images/account.jfif" id="account-img" />
                <ul>
                  <li class="account-list">
                    <a href="EditProfileP.html"><div class="circle"></div> Edit Profile</a>
                  </li>

                  <li class="account-list">
                    <a href="#"
                      ><div class="circle"></div>
                      Log Out</a
                    >
                  </li>
                </ul>
              </nav>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="center">


        <section class="sessions Previous-sessions">
          <h3>Previous Sessions</h3>
          <br />
          <section class="week-sesstoin">
            <div class="request-card">
              <div class="learner-info">
                <img src="images/video-play-icon-8.gif" alt="video icon" />
                <div class="day">
                  <button class="enter-btn-current">View Recording</button>
                </div>
              </div>
              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  French Session
                </p>
                <p class="level">30/2/2023</p>
                <p class="duration">60 Minutes</p>
              </section>
              <div class="item">
                <div class="rating">
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                </div>
                <div class="textarea">
                  <form action="save_feedback.php" method="POST">
                    <textarea name="description" cols="21" placeholder="Describe your experience.."></textarea>
                    <input type="hidden" name="rating" id="rating-value" value="0">
                    <button class="post-btn" type="submit">Post</button>
                  </form>
                </div>
              </div>

            </div>
            </div>

            <div class="request-card">
              <div class="learner-info">
                <img src="images/video-play-icon-8.gif" alt="profile Picture" />
                <div class="day">
                  <button class="enter-btn-current">View Recording</button>
                </div>
              </div>
              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  French Session
                </p>
                <p class="level">29/2/2023</p>
                <p class="duration">60 Minutes</p>
              </section>
              <div class="item">
                <div class="rating">
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                </div>
                <div class="textarea">
                  <form action="save_feedback.php" method="POST">
                    <textarea name="description" cols="21" placeholder="Describe your experience.."></textarea>
                    <input type="hidden" name="rating" id="rating-value" value="0">
                    <button class="post-btn" type="submit">Post</button>
                  </form>
                </div>
              </div>

            </div>
            </div>

            <div class="request-card">
              <div class="learner-info">
                <img src="images/video-play-icon-8.gif" alt="video icon" />
                <div class="day">
                  <button class="enter-btn-current">View Recording</button>
                </div>
              </div>
              <section class="incard-elements">
                <p class="language">
                  <img class="flag" src="images/france.png" alt="French" />
                  French Session
                </p>
                <p class="level">26/2/2023</p>
                <p class="duration">60 Minutes</p>
              </section>
              <div class="item">
                <div class="rating">
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                  <i class="rating__star far fa-star"></i>
                </div>
                <div class="textarea">
                  <form action="save_feedback.php" method="POST">
                    <textarea name="description" cols="21" placeholder="Describe your experience.."></textarea>
                    <input type="hidden" name="rating" id="rating-value" value="0">
                    <button class="post-btn" type="submit">Post</button>
                  </form>
                </div>
              </div>

            </div>
            </div>
            <!--second line -->
            <div class="request-card">
                <div class="learner-info">
                  <img src="images/video-play-icon-8.gif" alt="video icon" />
                  <div class="day">
                    <button class="enter-btn-current">View Recording</button>
                  </div>
                </div>
                <section class="incard-elements">
                  <p class="language">
                    <img class="flag" src="images/france.png" alt="French" />
                    French Session
                  </p>
                  <p class="level">30/12/2023</p>
                  <p class="duration">60 Minutes</p>
                </section>
                <div class="item">
                  <div class="rating">
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                  </div>
                  <div class="textarea">
                    <form action="save_feedback.php" method="POST">
                      <textarea name="description" cols="21" placeholder="Describe your experience.."></textarea>
                      <input type="hidden" name="rating" id="rating-value" value="0">
                      <button class="post-btn" type="submit">Post</button>
                    </form>
                  </div>
                </div>

              </div>
              <div class="request-card">
                <div class="learner-info">
                  <img src="images/video-play-icon-8.gif" alt="profile Picture" />
                  <div class="day">
                    <button class="enter-btn-current">View Recording</button>
                  </div>
                </div>
                <section class="incard-elements">
                  <p class="language">
                    <img class="flag" src="images/france.png" alt="French" />
                    French Session
                  </p>
                  <p class="level">29/12/2023</p>
                  <p class="duration">60 Minutes</p>
                </section>
                <div class="item">
  <div class="rating">
    <i class="rating__star far fa-star"></i>
    <i class="rating__star far fa-star"></i>
    <i class="rating__star far fa-star"></i>
    <i class="rating__star far fa-star"></i>
    <i class="rating__star far fa-star"></i>
  </div>
  <div class="textarea">
    <form action="save_feedback.php" method="POST">
      <textarea name="description" cols="21" placeholder="Describe your experience.."></textarea>
      <input type="hidden" name="rating" id="rating-value" value="0">
      <button class="post-btn" type="submit">Post</button>
    </form>
  </div>
</div>

              
  
              <div class="request-card">
                <div class="learner-info">
                  <img src="images/video-play-icon-8.gif" alt="video icon" />
                  <div class="day">
                    <button class="enter-btn-current">View Recording</button>
                  </div>
                </div>
                <section class="incard-elements">
                  <p class="language">
                    <img class="flag" src="images/france.png" alt="French" />
                    French Session
                  </p>
                  <p class="level">26/12/2023</p>
                  <p class="duration">60 Minutes</p>
                </section>
                <div class="item">
                  <div class="rating">
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                    <i class="rating__star far fa-star"></i>
                  </div>
                  <div class="textarea">
                    <form action="save_feedback.php" method="POST">
                      <textarea name="description" cols="21" placeholder="Describe your experience.."></textarea>
                      <input type="hidden" name="rating" id="rating-value" value="0">
                      <button class="post-btn" type="submit">Post</button>
                    </form>
                  </div>
                </div>
              </div>
              
          </section>
        </section>
        
<script>
  const ratingContainers = document.getElementsByClassName("rating");

  function executeRatings(containers) {
    const starClassActive = "rating__star fas fa-star";
    const starClassInactive = "rating__star far fa-star";

    Array.from(containers).forEach((container) => {
      const stars = container.getElementsByClassName("rating__star");

      Array.from(stars).forEach((star) => {
        star.onclick = () => {
          const clickedIndex = Array.from(stars).indexOf(star);

          for (let i = 0; i < stars.length; i++) {
            if (i <= clickedIndex) {
              stars[i].className = starClassActive;
            } else {
              stars[i].className = starClassInactive;
            }
          }
        };
      });
    });
  }

  executeRatings(ratingContainers);
</script>
      </section>
    </section>

    <!--Footer-->
    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>
              Embark on a linguistic journey with LINGUIST. Connect with native
              speakers worldwide, hone your language skills through immersive
              experiences, and unlock new cultures from the comfort of your
              home.<a class="find-more" href="About_us_pageMain.html"
                >Find more</a
              >
            </p>
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
              <span class="text"
                ><a href="mailto:content@linguist.com">content@linguist.com</a>
              </span>
            </div>
          </div>
        </div>

        <div class="right box">
          <h2>Contact us</h2>
          <div class="content">
            <form action="#" method="post">
              <div class="email">
                <div class="text">Email <span class="required">*</span></div>
                <input type="email" required />
              </div>
              <div class="msg">
                <div class="text">Message <span class="required">*</span></div>
                <textarea rows="2" cols="25" required></textarea>
              </div>
              <div class="btn">
                <button type="submit" style="width: 51.71px">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="bottom">
        <section>
          <span class="credit"
            >Created By <a href="main.html">linguist</a> |
          </span>
          <span class="far fa-copyright"></span
          ><span> 2024 All rights reserved.</span>
        </section>
      </div>
    </footer>
  </body>
</html>
