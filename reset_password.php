<?php
require 'db_connect.php';

$reset_success = false;
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check token and expiration
        $stmt = $conn->prepare("SELECT * FROM password_resets WHERE token=? AND expires >= ?");
        $current_time = date('U');
        $stmt->bind_param("ss", $token, $current_time);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];

            // Update the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
            $stmt->bind_param("ss", $hashed_password, $email);
            $stmt->execute();

            // Delete the token
            $stmt = $conn->prepare("DELETE FROM password_resets WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $reset_success = true;
        } else {
            $error_message = "Invalid or expired token.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <h1>Chào bạn!</h1>
            <p>Cùng học cùng Trendemy nào!</p>
            <p>Vui lòng nhập mật khẩu mới của bạn</p>
            <p class="login-text">Nếu bạn đã khôi phục tài khoản? <br><a href="login.php">Đăng nhập ngay!</a></p>
            <a href="index.php" class="button">Trang chủ</a>
            <img src="illustration3.png" alt="Illustration3" class="illustration3">
        </div>
        <div class="right-section">
            <div class="logo-container">
                <img src="logo.png" alt="Trendemy Logo" class="logo">
            </div>
            <h2>Bạn quên mật khẩu?</h2>
            <div class="password-instructions">
    <p>Vui lòng nhập mật khẩu mới của bạn để hoàn tất việc đặt lại mật khẩu</p>
</div>
<form action="reset_password.php" method="post">
    <label for="password">Mật khẩu mới</label>
    <div class="input-container">
        <i class="fas fa-lock lock-icon"></i>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('password')"></i>
    </div>
    <label for="confirm_password">Xác nhận mật khẩu</label>
    <div class="input-container">
        <i class="fas fa-lock lock-icon"></i>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmation code" required>
        <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('confirm_password')"></i>
    </div>
    <p class="terms-and-conditions">Việc tiếp tục sử dụng trang web có nghĩa là bạn đồng ý với <a href="#">Điều khoản và Điều kiện</a> và <a href="#">Chính sách bảo mật</a> của chúng tôi</p>
</form>

                <div class="button-container">
            <button type="submit" class="button">Đặt lại mật khẩu</button>
        </div>
            </form>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("confirm_password");
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
