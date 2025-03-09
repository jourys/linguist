<?php
session_start();
include("connection.php");
$emailError = "";
$passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sqlLearner = "SELECT * FROM learner WHERE email='$email'";
    $resultLearner = mysqli_query($conn, $sqlLearner);

    $sqlPartner = "SELECT * FROM tutor WHERE Email='$email'";
    $resultPartner = mysqli_query($conn, $sqlPartner);

    if (mysqli_num_rows($resultLearner) > 0) {
        $rowLearner = mysqli_fetch_assoc($resultLearner);
   
    
        // if my pass is shashed ill use verify  if (password_verify($password, $rowLearner['password'])) { 
        if ($password === $rowLearner['password']) {
            echo "<h1>Login Successful - Learner!</h1>";
             $_SESSION['user_id'] = $rowLearner['ID'];
             header("Location: HomePageLearner.php "); 
             exit(); 
        } else {
            $passwordError = "Invalid password"; 
        }
    } elseif (mysqli_num_rows($resultPartner) > 0) {
        $rowPartner = mysqli_fetch_assoc($resultPartner);

        if ($password === $rowPartner['password']) {
            echo "<h1>Login Successful - partner!</h1>";
            $_SESSION['user_id'] = $rowPartner['ID'];
            header('Location: tutor_Home_page.php');
            // header("Location: singup.html"); 
             exit(); 
        } else {

            $passwordError = "Invalid password"; 
        }
    } else {
        $emailError = "Email not found"; 
    }
} else {
    // Set initial error messages to empty values
    $emailError = "";
    $passwordError = "";
}

mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../css/loginStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script>
    function validateForm() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var emailError = document.getElementById("email-error");
      var passwordError = document.getElementById("password-error");

      emailError.textContent = "";
      passwordError.textContent = "";

    
      if (email === "") {
        emailError.textContent = "Email is required";
        return false; // Prevent form submission
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        emailError.textContent = "Invalid email format";
        return false; 
      }

      if (password === "") {
        passwordError.textContent = "Password is required";
        return false; 
      }

     
      return true;
    }
  </script>
</head>
<body>
    <div class="hero">
        <a href="main.html" ><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"> </a>
        <div class="form-box">
            <h2>Log In</h2>
            <?php
   
    if (!empty($emailError)) {
      echo "<span class='error-message' style='color:red;>$emailError</span>";
    }
    if (!empty($passwordError)) {
      echo "<span class='error-message' style='color:red;'>$passwordError</span>";
    }
    ?>

      <form  class="input-group" method="POST"onsubmit="return validateForm()">
        <span class="error-message" id="email-error"></span> 
        <input type="text" class="input-field" placeholder="E-mail" name="email" required >
        <span class="error-message" id="password-error"></span>  
        <input type="password" class="input-field" placeholder="Password" name="password" required >

        <span class="forgetPass"> <a href="forgetPassword.php">Forget Password </a></span> 

        <button type="submit" class="submit-btn">Log in</button>
        <span> Don't have an account? <a href="signup.php" onclick="signup()">Sign Up</a></span> 
        </form>
      </div>
    </div>
    <div class="bottom">
      <section>
        <span class="credit">Created By <a href="main.html">linguist</a>|</span>
        <span class="far fa-copyright"></span><span>2024 All rights reserved.</span>

      </section>
    </div>
</body>
</html>
