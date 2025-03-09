<?php
session_start();
include("connection.php");


$error='';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $pid= $_SESSION['user_id'];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $city = $_POST["city"];
   
    $gender = $_POST["gender"];
    $phonenum = $_POST["phonenumber"];
    $education=$_POST["education"];
    $experience=$_POST["experience"];
    $bio = $_POST["bio"];
  

    if (!empty($_FILES["image"]["name"])) {
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
        
        $newImageName = $fileName;
        $destination = '../images/' . $newImageName;
       
      move_uploaded_file($tmpName, $destination);
    }
  }


   
    if (isset($_POST['save'])) {
        //validate email and pass
        /* add condition to identify user */

      

        $sql_check = "SELECT * FROM tutor WHERE Email='$email' AND ID != '$pid' ";
      $result_check = mysqli_query($conn, $sql_check);
  
      $selected_languages = []; // Store selected languages from checkboxes
      foreach ($_POST['languages'] as $language) {
          $selected_languages[] = $language;
      }

      $sql_languages = "DELETE FROM tutor_languages WHERE P_ID= '$pid' "; // Delete existing languages
      mysqli_query($conn, $sql_languages);

      // Insert selected languages into tutor_languages table
      foreach ($selected_languages as $language) {
          $sql_insert_language = "INSERT INTO tutor_languages (P_ID, Language) VALUES ('$pid' , '$language')";
          mysqli_query($conn, $sql_insert_language);
      }
    

      if (mysqli_num_rows($result_check) > 0) {
        $error = " Email already exists. Please choose a different email.";
      }else{

        $sql = "UPDATE tutor SET Firstname='$firstname', Lastname='$lastname', Email='$email', password='$password',age='$age',gender='$gender',PhoneNumber='$phonenum' ,city='$city',bio='$bio',experience='$experience',eduction='$education' ";
           // Update PP field only if a new image was uploaded
           if (!empty($_FILES["image"]["name"])) {
            $sql .= ", image='$newImageName'";
        }

        $sql .= " WHERE ID='$pid'";

        if (mysqli_query($conn, $sql)) {
            $success = true;
            $successM="Profile updated successfully!";
            //echo "Profile updated successfully!"; 
            
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $city = $_POST["city"];
            
            $gender = $_POST["gender"];
            $phonenum = $_POST["phonenumber"];
            $education=$_POST["education"];
            $experience=$_POST["experience"];
            $bio = $_POST["bio"];
           
            // if(!isset($newImageName)){
            //   $newImageName ='profile.png';
            // }else{
            //   $newImageName=$_POST["image"];
            // }

        } else {
            
            echo "Update failed: " . mysqli_error($conn);
           // $errors[] = "Error updating profile: " . mysqli_error($conn);
        }
    }
    } else if (isset($_POST['delete']) && $_POST['confirm_delete'] === "yes" ) {
        $sql = "DELETE FROM tutor WHERE ID=$pid " ; // Replace with your actual delete query
    if (mysqli_query($conn, $sql)) {
      echo "Account deleted successfully.";
      // Redirect user to a relevant page (e.g., login)
      exit(); 
    } else {
        echo "Error deleting account: " . mysqli_error($conn);
     //   $errors[] = "Invalid action."; // Handle unexpected actions
    }
}
}

/* retrieve user ID from session/cookie */
$user_id = $_SESSION['user_id'] ;
$sql = "SELECT * FROM tutor WHERE ID='$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $firstname = $user["Firstname"];
    $lastname = $user["Lastname"];
    $age = $user["age"];
    $email = $user["Email"];
    $password = $user["password"];
    $city = $user["city"];
    $education=$user["eduction"];
    $experience=$user["experience"];
    $gender = $user["gender"];
    $phonenum = $user["PhoneNumber"];
   
    $bio = $user["bio"];
    $newImageName=$user["image"];
      // Prepare checkbox values based on user's languages
      $sql_languages = "SELECT Language FROM tutor_languages WHERE P_ID= '$user_id' ";
      $result_languages = mysqli_query($conn, $sql_languages);

  $languages = [];
  while ($row = mysqli_fetch_assoc($result_languages)) {
      $languages[] = $row['Language'];
    
  }
  $checked_languages = array_fill_keys($languages, 'checked');
    // Validate 
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
   
    
} else {
    echo "Error retrieving user data.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/EditProfileP.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <title>Edit Profile</title>

    <script>
  function confirmDelete() {
    if (confirm("Are you sure you want to delete your account? This action is irreversible.")) {
      document.getElementById('confirm_delete').value = "yes"; // Set confirmation to yes on click
      return true; // Allow form submission
    } else {
      return false; // Prevent form submission
    }
  }
  function handleDocumentReady() { 

    function previewImage(event, previewId) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const imgElement = document.getElementById(previewId);
            imgElement.src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }

    // Add event listener for file input change in learner form
    const learnerFileInput = document.querySelector('input[name="image"]');
    learnerFileInput.addEventListener('change', function(event) {
        previewImage(event, 'preview');
    }); 

  const emailPartner = document.getElementById('email');
    const passwordPartner = document.getElementById('password');
    const partnerError = document.getElementById('error');
    const submitPartnerBtn = document.getElementById('save');

    function validateEmail(email) {
      const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

    function validatePassword(password) {
      return password.length >= 8;
    }
    function validateAge(age) {
  return !isNaN(age) && age > 0; // Check if age is a valid number and positive
}

function validatePhone(phoneNumber) {
  const phoneNumberRegex = /^\d{10}$/; // Basic phone number validation (adjust as needed)
  return phoneNumberRegex.test(phoneNumber);
}
    function handleInputChange(event) {
      const inputField = event.target;
      let isValid = true; // Assume valid initially

      if (inputField.name === 'email') {
        if (!validateEmail(inputField.value)) {
          isValid = false;
          partnerError.textContent = 'Please enter a valid email address.';
        } else {
            partnerError.textContent = ''; // Clear error on valid input
        }
      } else if (inputField.name === 'password') {
        if (!validatePassword(inputField.value)) {
          isValid = false;
          partnerError.textContent = 'Password must be at least 8 characters long.';
        } else {
            partnerError.textContent = ''; // Clear error on valid input
        }
      }else if (inputField.name === 'age') { // Add age validation
      if (isNaN(inputField.value) || inputField.value <= 0) {
          isValid = false;
          partnerError.textContent = 'Please enter a valid age (positive number).';
      } else {
          partnerError.textContent = ''; // Clear error on valid input
      }
  } else if (inputField.name === 'phonenumber') { // Add phone number validation
      const phoneNumberRegex = /^\d{10}$/; // Basic phone number validation (adjust as needed)
      if (!phoneNumberRegex.test(inputField.value)) {
          isValid = false;
          partnerError.textContent = 'Please enter a valid phone number (10 digits).';
      } else {
          partnerError.textContent = ''; // Clear error on valid input
      }
  }

      if (isValid) {
        inputField.classList.remove('error');
      } else {
        inputField.classList.add('error'); // Add error class for styling
      }
    }

    const ageInput = document.getElementById('age');
   const phoneNumberInput = document.getElementById('phonenumber');

    ageInput.addEventListener('blur', handleInputChange);
     phoneNumberInput.addEventListener('blur', handleInputChange);
      emailPartner.addEventListener('blur', handleInputChange);
      passwordPartner.addEventListener('blur', handleInputChange);
    

    function handleFormSubmit(event) {
      const emailField = document.getElementById('email');
      const passwordField = document.getElementById('password');

      const ageField = document.getElementById('age');
   const phoneNumberField = document.getElementById('phonenumber');

      const email = emailField.value;
      const password = passwordField.value;

      const age = ageField.value;
      const phonenumber = phoneNumberField.value;
      let isValid = true;

      if (!validateEmail(email)) {
        emailField.classList.add('error');
        partnerError.textContent = 'Please enter a valid email address.';
        isValid = false; // Prevent form submission if email is invalid
      }

      if (!validatePassword(password)) {
        passwordField.classList.add('error');
        partnerError.textContent = 'Password must be at least 8 characters long.';
        isValid = false; // Prevent form submission if password is invalid
      }
      if (!validateAge(age)) {
        ageField.classList.add('error');
        partnerError.textContent = 'Please enter a valid age (positive number).';
        isValid = false; // Prevent form submission if password is invalid
      }
      if (!validatePhone(phonenumber)) {
        phoneNumberField.classList.add('error');
        partnerError.textContent = 'PPlease enter a valid phone number (10 digits).';
        isValid = false; // Prevent form submission if password is invalid
      }
      
      
      if (!isValid) {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    }

    submitPartnerBtn.addEventListener('click', handleFormSubmit);
  }
  window.onload = handleDocumentReady; 
</script>
</head>
<body>
    <header id="header">
        <div id="header-div">
        <nav class="fixed-top" id="main-nav">
            <ul id="ul1">
                <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"></li>
                <li class="list1-item"><a href="tutor_Home_page.php" class="list1-item">Home</a></li>
                <li class="list1-item"><a href="SESSionTutor.php">Sessions</a></li>
                <li class="list1-item"><a href="tutorReq.php">Requests</a></li>
                <li class="list1-item"><a href="toturRate.php">Rate and Review</a></li>
                <li class="list1-item"><a href="Supports.php">Support</a></li>
            </ul>
            <ul id="ul2">
                
                <li id="acnt li">
                    <nav id="account-nav"><img src="../images/<?php echo $newImageName; ?>" id="account-img">
                        <ul>
                            
                            <li class="account-list"><a href="EditProfileP.php"><div class="circle"></div>Edit Profile</a></li>
                            
                            <li class="account-list"><a href="logout.php"><div class="circle"></div>Log Out</a></li>
                        </ul>

                    </nav>
                </li>
            </ul>
        </nav>
    </div>
     </header>
     
      <div class="main">
      
 <?php
   
      if (isset($successM)) {
        echo " <span class='success-message' id='success'>$successM </span>";
      }
    ?>
       <h3> Account / Edit profile</h3>
    <form class="edit-learner" method="POST" enctype="multipart/form-data">


        <h2>Edit Profile</h2>
     
        <div class="wrapper">
                   
            <div class="image">
            <img src="../images/<?php echo $newImageName; ?>" alt="Uplaod pic" id="preview">
            <input type="file" accept="Image/jpeg, Image/png, Image/jpg" id="file-choose" name="image">
             </div>
             <h3>Change Picture</h3> <!-- update -->
             <span class="error-message" id="error"></span>
        <?php
      if (isset($error)) {
        echo "<script>document.getElementById('error').textContent = '$error';</script>";
      }
    ?>
         </div>
                <label for="firstname">First name</label>
                <input type="text" class="input-field"id="firstname" name="firstname" value="<?php echo $firstname; ?>">
                <label for="lastname">Last name</label>
                <input type="text" class="input-field" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
            <label for="age">Age</label>
            <input type="text" class="input-field" id="age" name="age"value="<?php echo $age; ?>">

            <label for="gender">Gender</label>
            <select name="gender" class="input-field" id="gender" >
                <option value="male"  <?php if ($gender == 'male') echo 'selected'; ?> >Male</option>
                <option value="female" <?php if ($gender == 'female') echo 'selected'; ?> >Female</option>
                </select>

            <label for="email">Email</label>
            <input type="text"class="input-field" id="email" name="email" value="<?php echo $email; ?>"> <!-- type email?-->
            <label for="password">Password</label>
            <input type="text"class="input-field" id="password" name="password" value="<?php echo $password; ?>">
            <label for="phonenumber">Phone Number</label>
            <input type="text" class="input-field" id="phonenumber" name="phonenumber" value="<?php echo $phonenum; ?>">
            <label for="city">City</label>
            <input type="text" class="input-field" id="city" name="city" value="<?php echo $city; ?>"> <!-- choices?-->
      
       
        <label for="language">Languages </label> <br><br><br>
      <div class="language-container">
            <input type="checkbox"  name="languages[]" value="English" <?php echo isset($checked_languages['English']) ? $checked_languages['English'] : ''; ?> > English
            <input type="checkbox" name="languages[]" value="Spanish" <?php echo isset($checked_languages['Spanish']) ? $checked_languages['Spanish'] : ''; ?>  > Spanish 
            <input type="checkbox" name="languages[]" value="French" <?php echo isset($checked_languages['French']) ? $checked_languages['French'] : ''; ?> > French 
            <input type="checkbox" name="languages[]" value="Arabic" <?php echo isset($checked_languages['Arabic']) ? $checked_languages['Arabic'] : ''; ?> > Arabic </div>
   
   
            <label for="education">Education</label>
            <textarea rows="2" class="input-field" id="education" name="education" > <?php echo $education; ?></textarea>
            <label for="experience">Experience</label>
            <textarea rows="2" class="input-field" id="experience" name="experience" > <?php echo $experience; ?></textarea>
            <label for="bio">Bio</label>
            <textarea rows="3" class="input-field" id="bio" name="bio" > <?php echo $bio; ?></textarea>

            
            <button type="submit" class="submit-btn" name ="save"id="save">Save Changes</button>
            <button type="submit" class="submit-btn" id="delete"  name="delete" onclick="return confirmDelete()">Delete Account</button>  
            <input type="hidden" name="confirm_delete" id="confirm_delete" value="no">

    </form>
</div>
<footer>
    <div class="main-content">
      <div class="left box">
        <h2>About us</h2>
        <div class="content">
          <p> Embark on a linguistic journey with LINGUIST. Connect with native speakers worldwide,
               hone your language skills through immersive experiences, and unlock new cultures from the comfort of your home.<a class="find-more" href="About_us_page.html">Find more</a></p>
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
