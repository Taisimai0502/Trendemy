<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý đăng ký ở đây
    // Ví dụ: Lưu vào cơ sở dữ liệu
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'your_database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<?php
require 'db_connect.php'; // Bao gồm tệp kết nối cơ sở dữ liệu

$register_success = false;

function isPasswordStrong($password) {
    // Kiểm tra độ mạnh của mật khẩu
    return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,15}$/', $password) &&
           !preg_match('/\d{4,}/', $password) && // Không chứa chuỗi số dài
           !preg_match('/(12345678|113|115|123)/', $password); // Không chứa các số nổi tiếng
}

function isUniquePassword($password, $conn) {
    // Kiểm tra tính duy nhất của mật khẩu
    $stmt = $conn->prepare("SELECT * FROM users WHERE password = ?");
    $stmt->bind_param("s", password_hash($password, PASSWORD_BCRYPT));
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows === 0;
}

function isValidEmail($email) {
    // Kiểm tra tính hợp lệ của email
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra tính hợp lệ của số điện thoại
    if (!preg_match('/^0\d{9}$/', $phone)) {
        echo "Số điện thoại không hợp lệ.";
        exit;
    }

    // Kiểm tra tính hợp lệ của email
    if (!isValidEmail($email)) {
        echo "Địa chỉ email không hợp lệ.";
        exit;
    }

    // Kiểm tra độ mạnh của mật khẩu
    if (!isPasswordStrong($password)) {
        echo "Mật khẩu không hợp lệ.";
        exit;
    }

    // Kiểm tra mật khẩu có trùng khớp không
    if ($password !== $confirm_password) {
        echo "Mật khẩu không trùng khớp.";
        exit;
    }

    // Kiểm tra tính duy nhất của mật khẩu
    if (!isUniquePassword($password, $conn)) {
        echo "Mật khẩu này đã được sử dụng.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        $register_success = true;
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>
