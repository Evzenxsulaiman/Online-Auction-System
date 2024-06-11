<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $starting_bid = $_POST['starting_bid'];

    $stmt = $pdo->prepare("INSERT INTO items (name, description, starting_bid, highest_bid) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $description, $starting_bid, $starting_bid])) {
        $message = "Item added successfully!";
    } else {
        $error = "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Item</h1>
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Item Name" required><br>
            <textarea name="description" placeholder="Item Description" required></textarea><br>
            <input type="number" name="starting_bid" placeholder="Starting Bid" min="0" step="0.01" required><br>
            <button type="submit">Add Item</button>
        </form>
        <p><a href="index.php">Back to auction</a></p>
    </div>
</body>
</html>
