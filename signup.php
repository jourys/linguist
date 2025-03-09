<?php
  session_start();
include("connection.php");



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if formType is set and not empty
    if (isset($_POST["formType"]) && !empty($_POST["formType"])) {
        $formType = $_POST["formType"];
        
        // Common user data

        $firstname = mysqli_real_escape_string($conn,$_POST["Firstname"]);
        $lastname = mysqli_real_escape_string($conn,$_POST["Lastname"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]) ;
        $password = mysqli_real_escape_string($conn, $_POST["password"]) ;
        $city = mysqli_real_escape_string($conn,$_POST["city"]);
        
        
        
        // Insert user data into respective table
        if ($formType === "learner") {
            $location = mysqli_real_escape_string($conn, $_POST["location"]) ;
         
            if (!empty($_FILES["limage"]["name"])) {
            $fileName = $_FILES["limage"]["name"];
            $fileSize = $_FILES["limage"]["size"];
            $tmpName = $_FILES["limage"]["tmp_name"];
        
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
            $sql_check = "SELECT * FROM learner WHERE email='$email' ";
            $result_check = mysqli_query($conn, $sql_check); 
            
            if (mysqli_num_rows($result_check) > 0) {
                //echo "error";
  
                $error = " Email already exists. Please choose a different email.";
              }else{
                if(!isset($newImageName) ){
                    $newImageName ='profile.png';
                }

                 $sql = "INSERT INTO learner (Firstname, Lastname, email, password, city,location,image)
                    VALUES ('$firstname', '$lastname', '$email', '$password', '$city','$location','$newImageName')";
                    //redirect
        }
        } elseif ($formType === "partner") {
            $age = mysqli_real_escape_string($conn, $_POST["age"]);
            $gender = $_POST["Gender"];
            $phonenum = mysqli_real_escape_string($conn, $_POST["phonenum"]);
            $bio = mysqli_real_escape_string($conn, $_POST["bio"]);
            $Price =$_POST['Price'];
            

            if (!empty($_FILES["pimage"]["name"])) {
            $fileName = $_FILES["pimage"]["name"];
            $fileSize = $_FILES["pimage"]["size"];
            $tmpName = $_FILES["pimage"]["tmp_name"];
        
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
       
           
           

            $sql_check = "SELECT * FROM tutor WHERE Email='$email' ";
            $result_check = mysqli_query($conn, $sql_check); 
            if (mysqli_num_rows($result_check) > 0) {
                

                $errorP = " Email already exists. Please choose a different email.";
              }else{
                


            $sql = "INSERT INTO tutor (Email ,image, Firstname, Lastname,age, gender, password, PhoneNumber, city ,bio, Price)
                    VALUES ('$email', '$newImageName','$firstname', '$lastname', '$age','$gender','$password', '$phonenum', '$city','$bio', '$Price')";
           


                    
        }
    }
    
        if (empty($error) && empty($errorP)) {
          
            

        if (mysqli_query($conn, $sql)) {
            $Id = mysqli_insert_id($conn); // Retrieve the ID of the newly inserted tutor
            if ($formType === "partner") {
            // Inserting languages into tutor_languages table
            if (isset($_POST['languages'])) {
                
                $languages = $_POST['languages'];
                foreach ($languages as $language) {
                    
                    $language = mysqli_real_escape_string($conn, $language);
                    $sql = "INSERT INTO tutor_languages (P_ID, Language) VALUES ('$Id', '$language')";
                    mysqli_query($conn, $sql);
                }
            }
          
            $_SESSION['user_id']= $Id ;
            header("Location: tutor_Home_page.php");
            exit();
           // echo "New record created successfully";
        }elseif($formType === "learner"){
          $_SESSION['user_id']= $Id ;
           header("Location: HomePageLearner.php");
           exit();
           // echo "New record created successfully";
        }
    
        } else {
            
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        }
    } else {
        echo "Form type is not set or empty";
    }
}
?>


<html>
<head> 
    <title>Sign up</title>
    <link rel="stylesheet" href="../css/signupStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
   
  

    <div class="hero">
        <a href="main.html" ><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"> </a>
        <div class="form-box">
            
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="signlearner()">Learner</button>
                <button type="button" class="toggle-btn"onclick="signpartner()">Partner</button>
            </div>
            
            <form id="signup-learner" class="input-group"  method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="formType" value="learner">
                <div class="wrapper">
                   
                    <div class="image">
                    <img src="#" alt="Profile Preview" id="profile-preview-learner">
                    <input type="file" accept="Image/jpeg, Image/png, Image/jpg" id="file-choose" name="limage" >
                     </div>
                     <h3>Profile Photo</h3>
                 </div>
                <div class="two-form">
                <input type="text" class="input-field" name="Firstname"placeholder="First name" required >
                <input type="text" class="input-field" name="Lastname" placeholder="Last name" required >
            </div>
                <input type="text" class="input-field" name="email" placeholder="E-mail" id="email-learner" required >
                <input type="password" class="input-field" name="password" placeholder="Password" id="password-learner"required >
                
                <input type="text" class="input-field" name="city" placeholder="City" required >
                <input type="text" class="input-field" name="location" placeholder="Location" >
                <input type="checkbox" class="checkbox" ><span>I agree to the <a href="#" onclick="termsandconditions()">term & conditions <br> <br> </a></span>
                <span class="error-message" id="learner-error"></span>
               
                <?php
      if (isset($error)) {
        echo "<script>document.getElementById('learner-error').textContent = '$error';</script>";
      }
    ?>
                <button type="submit" class="submit-btn">Sign Up</button>
                <span> Have an account? <a href="login.html" >Log in</a></span> <!-- onclick? + update --> 
            
            </form>
        
        
            <form id="signup-partner" class="input-group"  method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="formType" value="partner">

                 <div class="wrapper">
                   
                    <div class="image">
                    <img src="#" alt="Profile Preview" id="profile-preview-partner">
                    <input type="file" accept="Image/jpeg, Image/png, Image/jpg" id="file-choose"name="pimage">
                     </div>
                     <h3>Profile Photo</h3>
                 </div>

                <div class="two-form">
                <input type="text" class="input-field" name="Firstname" placeholder="First name" required >
                <input type="text" class="input-field" name="Lastname" placeholder="Last name" required >
            </div>
                <input type="text" class="input-field" name="age" placeholder="Age" required id="age">
               <br><br>
                <select name="Gender" class="input-field" placeholder="Gender"  id="gender" required>
                    <option selected value="gender">Gender</option> <!-- if not chosen-->
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                <input type="text" class="input-field" name="email" placeholder="E-mail" id="email-partner" required >

                <input type="password" class="input-field" name="password" placeholder="Password" id="password-partner" required >
                 <input type="text" class="input-field" name="phonenum" id="phonenumber" placeholder="Phone Number" required >
                <input type="text" class="input-field" name="city" placeholder="City" required >
                <input type="text" class="input-field" name="Price" placeholder="price" required >
                
               
        <div class="languages">
        <h5>Languages :</h5>
        <div class="language-container">
            <input type="checkbox"  name="languages[]" value="English"> English &nbsp;
            <input type="checkbox" name="languages[]" value="Spanish"> Spanish &nbsp;
            <input type="checkbox" name="languages[]" value="French"> French &nbsp;
            <input type="checkbox" name="languages[]" value="Arabic"> Arabic &nbsp; </div>
      
    </div>
                <textarea rows="3" class="input-field" name="bio" placeholder="Bio"></textarea>
                <input type="checkbox" class="checkbox" ><span>I agree to the <a href="#" onclick="termsandconditions()">term & conditions</a></span>
                <span class="error-message" id="partner-error"></span>
                


                <?php
      if (isset($errorP)) {
        echo "<script>document.getElementById('partner-error').textContent = '$errorP';</script>";
      }
    ?>
                <button type="submit" class="submit-btn">Sign Up</button>
                <span> Have an account? <a href="#" onclick="login()">Login</a></span>
            </form>
        
            
        </div>
    </div>
    <script> 

    var x= document.getElementById("signup-learner");
    var y= document.getElementById("signup-partner");
    var z= document.getElementById("btn");

    function signpartner(){
        x.style.left ="-400px";
        y.style.left ="50px";
        z.style.left ="110px";
    }
    function signlearner(){
        x.style.left ="50px";
        y.style.left ="450px";
        z.style.left ="0";
    }


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
    const learnerFileInput = document.querySelector('input[name="limage"]');
    learnerFileInput.addEventListener('change', function(event) {
        previewImage(event, 'profile-preview-learner');
    });

    // Add event listener for file input change in partner form
    const partnerFileInput = document.querySelector('input[name="pimage"]');
    partnerFileInput.addEventListener('change', function(event) {
        previewImage(event, 'profile-preview-partner');
    });

    const emailLearner = document.getElementById('email-learner');
    const passwordLearner = document.getElementById('password-learner');
    const learnerError = document.getElementById('learner-error');
    const submitLearnerBtn = document.querySelector('#signup-learner .submit-btn');

    const emailPartner = document.getElementById('email-partner');
    const passwordPartner = document.getElementById('password-partner');
    const partnerError = document.getElementById('partner-error');
    const submitPartnerBtn = document.querySelector('#signup-partner .submit-btn');
    const ageInput = document.getElementById('age');
   const phoneNumberInput = document.getElementById('phonenumber');




    
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
        const errorElement = inputField.parentElement.querySelector('.error-message');
        let isValid = true;
        errorElement.textContent = '';

        if (inputField.name === 'email') {
            if (!validateEmail(inputField.value)) {
                isValid = false;
                errorElement.textContent = 'Please enter a valid email address.';
            }
        } else if (inputField.name === 'password') {
            if (!validatePassword(inputField.value)) {
                isValid = false;
                errorElement.textContent = 'Password must be at least 8 characters long.';
            }
        }else if (inputField.name === 'age') { // Add age validation
      if (!validateAge(inputField.value)) {
          isValid = false;
          errorElement.textContent = 'Please enter a valid age (positive number).';
      } 
  } else if (inputField.name === 'phonenum') { // Add phone number validation
      if (!validatePhone(inputField.value)) {
          isValid = false;
          errorElement.textContent = 'Please enter a valid phone number (10 digits).';
      } 
  }

        if (isValid) {
            inputField.classList.remove('error');
        } else {
            inputField.classList.add('error');
        }
    }

    emailLearner.addEventListener('blur', handleInputChange);
    passwordLearner.addEventListener('blur', handleInputChange);

    emailPartner.addEventListener('blur', handleInputChange);
    passwordPartner.addEventListener('blur', handleInputChange);
    ageInput.addEventListener('blur', handleInputChange);
    phoneNumberInput.addEventListener('blur', handleInputChange);

    function handleFormSubmit(event) {
        const form = event.target.closest('form');
        const emailField = form.querySelector('input[name="email"]');
        const passwordField = form.querySelector('input[name="password"]');
        const email = emailField.value;
        const password = passwordField.value;

        let isValid = true;

        if (!validateEmail(email)) {
            emailField.classList.add('error');
            learnerError.textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        if (!validatePassword(password)) {
            passwordField.classList.add('error');
            learnerError.textContent = 'Password must be at least 8 characters long.';
            isValid = false;
        }

        if (!isValid ) {
            event.preventDefault(); // Prevent form submission
        }
    }
    function handleFormSubmitP(event) {
        const form = event.target.closest('form');
        const emailField = form.querySelector('input[name="email"]');
        const passwordField = form.querySelector('input[name="password"]');
        const ageField = form.querySelector('input[name="age"]');
        const phoneField = form.querySelector('input[name="phonenum"]');
        const email = emailField.value;
        const password = passwordField.value;
        const age = ageField.value;
        const phonenum = phoneField.value;

        let isValid = true;

        if (!validateEmail(email)) {
            emailField.classList.add('error');
            partnerError.textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        if (!validatePassword(password)) {
            passwordField.classList.add('error');
            partnerError.textContent = 'Password must be at least 8 characters long.';
            isValid = false;
        }
        if (!validateAge(age)) {
            ageField.classList.add('error');
            partnerError.textContent = 'Please enter a valid age (positive number).';
            isValid = false;
        }
        if (!validatePhone(phonenum)) {
            phoneField.classList.add('error');
            partnerError.textContent = 'Please enter a valid phone number (10 digits).';
            isValid = false;
        }

        if (!isValid ) {
            event.preventDefault(); // Prevent form submission
        }
    }

    submitLearnerBtn.addEventListener('click', handleFormSubmit);
    submitPartnerBtn.addEventListener('click', handleFormSubmitP);

    </script>

   

</body>


</html>
