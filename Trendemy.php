
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tredemy</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="login-container">   
        <div class="left-section">
            <div class="ellipse"></div>
            <div class="Trendemy-logo">
            <img src="newhere.png" alt="Newhere" class="newhere">
            </div>
            <a href="Trendemy2.php" class="button">SIGNUP</a>
            <img src="illustration1.png" alt="Illustration" class="illustration1">
        </div>
        <!-- <div class="tabs">
            <a href="login.php" class="active">Đăng nhập</a>
            <a href="register.php">Đăng ký</a>
        </div> -->

        <div class="right-section">
            <div class="logo-container">
            
                <img src="trendemy.png" alt="Trendemy Logo" class="logo">

                <form action="login.php" method="post">

    <label for="email">Email / Number phone</label>
    <div class="input-container">
        <input type="text" name="email" placeholder="Email / Number phone" required>
    </div>
    <label for="password">Mật khẩu</label>
    <div class="input-container">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <div class="eye-container">
            <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('password')"></i>
        </div>
    </div>
    <div class="forgot-password-container">
        <a href="forgot_password.php" class="forgot-password">Quên mật khẩu?</a>
    </div>
    <!-- <p class="terms-and-conditions">Việc tiếp tục sử dụng trang web có nghĩa là bạn đồng ý với <a href="#">Điều khoản và Điều kiện</a> và <a href="#">Chính sách bảo mật</a> của chúng tôi</p> -->
    <button type="submit" class="button">LOGIN</button>
</form>



                <div class="social-login">
                    <div class="social-buttons">
                    <a href="YOUR_FACEBOOK_LOGIN_URL" class="social-button github-login">
    <img src="icons8-facebook-48.png" alt="GitHub" class="icon">
</a>
                        <a href="YOUR_GOOGLE_LOGIN_URL" class="social-button github-login">
    <img src="icons8-google-48 (1).png" alt="GitHub" class="icon">
</a>
                        <!-- <a href="YOUR_GITHUB_LOGIN_URL" class="social-button github-login">
    <img src="icons8-github-50.png" alt="GitHub" class="icon">
</a> -->

<a href="YOUR_LINKEDIN_LOGIN_URL" class="social-button github-login">
    <img src="icons8-linked-in-48.png" alt="GitHub" class="icon">
</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordIcon = passwordField.nextElementSibling;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
