<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="Trendemy2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        

        <div class="right-section">
            <div class="logo-container">
                <img src="logo.png" alt="Trendemy Logo" class="logo">
            </div>
            <form action="register.php" method="post">
                <label for="email">Email / Number phone</label>
                <div class="input-container">
                    <input type="email" name="email" placeholder="Email / Number phone" required>
                </div>
                <label for="fullname">Họ và tên</label>
                <div class="input-container">
                    <input type="text" name="fullname" placeholder="Full Name" required>
                </div>
                <label for="password">Mật khẩu</label>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('password')"></i>
                </div>
                <label for="confirm_password">Nhập lại mật khẩu</label>
                <div class="input-container">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmation code" required>
                    <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('confirm_password')"></i>
                </div>
            
                <label for="verification_code">Mã xác nhận</label>
                <div class="input-container">
    <input type="text" name="verification_code" placeholder="Nhập mã xác nhận" required>
    <button type="button" class="send-code-button">Gửi mã</button>
</div>

                <div class="button-container">
                    <button type="submit" class="button">Đăng ký</button>
                </div>
            </form>
        </div>
        <div class="left-section">
        <div class="Trendemy-logo">
            <img src="newhere.png" alt="Newhere" class="newhere">
            </div>
            <a href="Trendemy.php" class="button">LOGIN</a>
                <img src="illustration1.png" alt="Illustration1" class="illustration1">
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
