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

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_regenerate_id(); 
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['name'];
            header("Location: home_loggedin.html");
            exit;
        } else {
            $loginError = "Invalid password";
        }
    } else {
        $loginError = "There is no such account. Please sign up.";
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
        <div class="form-toggle">
            <button id="loginBtn" class="active">Login</button>
            <button id="signupBtn">Signup</button>
        </div>
        <form id="loginForm" method="POST" action="login.php">
            <?php if (isset($_GET['signup']) && $_GET['signup'] === 'success'): ?>
                <div class="success">Signup successful. You can now log in.</div>
            <?php endif; ?>
            <input type="email" id="loginEmail" name="email" placeholder="Email Address" required>
            <input type="password" id="loginPassword" name="password" placeholder="Password" required>
            <?php if (!empty($loginError)): ?>
                <div class="error"><?php echo $loginError; ?></div>
            <?php endif; ?>
            <button type="submit">Login</button>
            <p><a href="#">Forgot password?</a></p>
        </form>
        <form id="signupForm" style="display: none;" method="POST" action="signup.php">
            <input type="text" id="signupName" name="name" placeholder="Name" required>
            <input type="email" id="signupEmail" name="email" placeholder="Email Address" required>
            <input type="password" id="signupPassword" name="password" placeholder="Password" required>
            <button type="submit">Signup</button>
        </form>
    </div>
<script>
    document.getElementById('loginBtn').addEventListener('click', function() {
        document.getElementById('loginForm').style.display = 'flex';
        document.getElementById('signupForm').style.display = 'none';
        this.classList.add('active');
        document.getElementById('signupBtn').classList.remove('active');
    });

    document.getElementById('signupBtn').addEventListener('click', function() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('signupForm').style.display = 'flex';
        this.classList.add('active');
        document.getElementById('loginBtn').classList.remove('active');
    });
</script>
</body>
</html>