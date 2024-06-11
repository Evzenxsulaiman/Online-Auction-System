<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

   
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $existing_user = $stmt->fetch();

    if ($existing_user) {
        $error = "An account with this username already exists. Please choose a different username.";
    } else {
      
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            $message = "Registration successful!";
        } else {
            $error = "Error: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <style>
        .txt{
            text-align: center;
        }
        a{
            text-align: center;
        }
    </style>
    <div class="container">
        <h1>Register</h1>
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <p class="txt">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
