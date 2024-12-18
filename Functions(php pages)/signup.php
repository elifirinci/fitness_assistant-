<?php
session_start();
$servername = "localhost:3306";
$username = "root";
$password = "rGLaR11n.Mj";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signupError = "";
$signupSuccess = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $signupError = "An account with this email already exists.";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            header("Location: login.php?signup=success");
            exit;
        } else {
            $signupError = "Error occurred during signup.";
        }
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 300px;
        }
        .form-toggle {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-toggle button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 16px;
            color: orange;
        }
        .form-toggle button.active {
            font-weight: bold;
            border-bottom: 2px solid orange;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            padding: 10px;
            border: none;
            background: #FFAC1C;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            align-self: center;
        }
        form p {
            text-align: center;
        }
        form p a {
            color: orange;
            text-decoration: none;
        }
        .error {
            color: black;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php if (!empty($signupSuccess)): ?>
            <div class="success"><?php echo $signupSuccess; ?></div>
        <?php endif; ?>
        <?php if (!empty($signupError)): ?>
            <div class="error"><?php echo $signupError; ?></div>
        <?php endif; ?>
        <form id="signupForm" method="POST" action="signup.php">
            <input type="text" id="signupName" name="name" placeholder="Name" required>
            <input type="email" id="signupEmail" name="email" placeholder="Email Address" required>
            <input type="password" id="signupPassword" name="password" placeholder="Password" required>
            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>