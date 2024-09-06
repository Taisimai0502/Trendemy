<?php
require 'db_connect.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

$error_message = ""; // Khởi tạo biến $error_message
$login_success = false; // Khởi tạo biến $login_success

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $login_success = true;
        } else {
            $error_message = "Sai thông tin tài khoản hoặc mật khẩu.";
        }
    } else {
        $error_message = "Không tìm thấy người dùng với email này.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="tabs">
            <a href="login.php" class="active">Đăng nhập</a>
            <a href="register.php">Đăng ký</a>
        </div>
        <div class="left-section">
            <div class="logo-container">
                <img src="logo.png" alt="Trendemy Logo" class="logo">
                <h2>Đăng nhập tài khoản của bạn</h2>
                <?php if ($error_message): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <?php if ($login_success): ?>
                    <p style="color: green;">Đăng nhập thành công!</p>
                <?php endif; ?>
                <form action="login.php" method="post">
    <label for="email">Email</label>
    <div class="input-container">
        <div class="icon-container">
            <i class="fas fa-envelope icon"></i>
        </div>
        <input type="text" name="email" placeholder="Email" required>
    </div>
    <label for="password">Mật khẩu</label>
    <div class="input-container">
        <div class="icon-container">
            <i class="fas fa-lock lock-icon"></i>
        </div>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <div class="eye-container">
            <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('password')"></i>
        </div>
    </div>
    <div class="forgot-password-container">
        <a href="forgot_password.php" class="forgot-password">Quên mật khẩu?</a>
    </div>
    <p class="terms-and-conditions">Việc tiếp tục sử dụng trang web có nghĩa là bạn đồng ý với <a href="#">Điều khoản và Điều kiện</a> và <a href="#">Chính sách bảo mật</a> của chúng tôi</p>
    <button type="submit" class="button">Đăng nhập</button>
</form>


<div class="divider">
    <span class="line"></span>
    <span class="text">Or</span>
    <span class="line"></span>
</div>
                <div class="social-login">
                    <div class="social-buttons">
                    <a href="YOUR_FACEBOOK_LOGIN_URL" class="social-button github-login">
    <img src="icons8-facebook-48.png" alt="GitHub" class="icon">
</a>
                        <a href="YOUR_GOOGLE_LOGIN_URL" class="social-button github-login">
    <img src="icons8-google-48 (1).png" alt="GitHub" class="icon">
</a>
                        <a href="YOUR_GITHUB_LOGIN_URL" class="social-button github-login">
    <img src="icons8-github-50.png" alt="GitHub" class="icon">
</a>

<a href="YOUR_LINKEDIN_LOGIN_URL" class="social-button github-login">
    <img src="icons8-linked-in-48.png" alt="GitHub" class="icon">
</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-section">
            <h1>Chào bạn đến Trendemy!</h1>
            <p>Cùng học cùng Trendemy nào!</p>
            <p>Vui lòng đăng nhập vào tài khoản của bạn với các thông tin để tiếp tục</p>
            <p>Bạn chưa có tài khoản?</p>
            <a href="register.php" class="button">Đăng ký</a>
            <img src="illustration.png" alt="Illustration" class="illustration">
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
