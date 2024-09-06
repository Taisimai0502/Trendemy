<?php
require 'db_connect.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

$register_success = false;
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    if ($conn->query($sql) === TRUE) {
        $register_success = true;
    } else {
        $error_message = "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <h1>Chào bạn!</h1>
            <p class="main-text">Cùng học cùng Trendemy nào!</p>
            <p class="sub-text">Vui lòng cung cấp thông tin để đăng ký tài khoản của bạn</p>
            <p class="login-text">Bạn đã có tài khoản! <a href="login.php">Đăng nhập ngay</a></p>
            <a href="login.php" class="button">Đăng nhập</a>
                <img src="illustration1.png" alt="Illustration1" class="illustration1">
        </div>

        <div class="right-section">
            <div class="logo-container">
                <div class="tabs">
                    <a href="login.php">Đăng nhập</a>
                    <a href="register.php" class="active">Đăng ký</a>
                </div>
                <img src="logo.png" alt="Trendemy Logo" class="logo">
            </div>
            <?php if ($register_success): ?>
    <p style="color: green;">Đăng ký thành công!</p>
<?php elseif ($error_message): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>
            <h2>Đăng ký tài khoản của bạn</h2>
            <form action="register.php" method="post">
                <label for="fullname">Họ và tên</label>
                <div class="input-container">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="fullname" placeholder="Full Name" required>
                </div>
                <label for="email">Email</label>
                <div class="input-container">
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <label for="verification_code">Mã xác nhận</label>
                <div class="input-container">
    <i class="fas fa-lock icon"></i>
    <input type="text" name="verification_code" placeholder="Nhập mã xác nhận" required>
    <button type="button" class="send-code-button">Gửi mã</button>
</div>

                <label for="phone">Số điện thoại</label>
                <div class="input-container">
                    <i class="fas fa-phone icon"></i>
                    <input type="tel" name="phone" placeholder="Phone number" required>
                </div>
                <label for="password">Mật khẩu</label>
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
                <div class="terms">
                    <input type="checkbox" name="terms" required>
                    <span>Bằng cách tạo tài khoản có nghĩa là bạn đồng ý với <a href="#">Điều khoản và Điều kiện</a> và <a href="#">Chính sách bảo mật</a> của chúng tôi</span>
                </div>
                <div class="button-container">
                    <button type="submit" class="button">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(id) {
            var passwordField = document.getElementById(id);
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
