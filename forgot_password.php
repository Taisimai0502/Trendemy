<?php
require 'db_connect.php';

$reset_email_sent = false;
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));

        // Save the token in the database with an expiration time
        $expires = date('U') + 1800; // Token expires in 30 minutes

        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires);
        $stmt->execute();

        // Send reset email
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Please click the following link to reset your password: $reset_link";
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            $reset_email_sent = true;
        } else {
            $error_message = "Unable to send reset email.";
        }
    } else {
        $error_message = "No user found with this email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <h1>Chào bạn!</h1>
            <p class="main-text">Cùng học cùng Trendemy nào!</p>
            <p class="sub-text">Vui lòng nhập email của bạn để chúng tôi có thể gửi mã xác nhận đến hộp thư</p>
            <p class="login-text">Nếu bạn đã khôi phục tài khoản? <br><a href="login.php">Đăng nhập ngay!</a></p>
            <a href="index.php" class="button">Trang chủ</a>
            <img src="illustration2.png" alt="Illustration2" class="illustration2">
        </div>
        <div class="right-section">
    <div class="logo-container">
        <img src="logo.png" alt="Trendemy Logo" class="logo">
    </div>
    <h2>Bạn quên mật khẩu?</h2>
    <div class="email-instructions">
    <p>Vui lòng nhập email của bạn để chúng tôi gửi mã khôi phục mật khẩu</p>
</div>
<form action="forgot_password.php" method="post">
    <label for="email">Gmail</label>
    <div class="input-container">
        <i class="fas fa-envelope icon"></i>
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <label for="confirmation_code">Mã khôi phục</label>
<div class="input-container">
    <i class="fas fa-lock icon"></i>
    <input type="text" name="confirmation_code" placeholder="Confirmation code" required>
    <button type="button" class="button-small">Gửi mã</button>
</div>

    <p class="terms-and-conditions">Việc tiếp tục sử dụng trang web có nghĩa là bạn đồng ý với <a href="#">Điều khoản và Điều kiện</a> và <a href="#">Chính sách bảo mật</a> của chúng tôi</p>
</form>

        <div class="button-container">
            <button type="submit" class="button">Xác nhận</button>
        </div>
    </form>
</div>
    </div>
</body>
</html>
