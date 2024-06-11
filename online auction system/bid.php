<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $item_id = $_POST['item_id'];
    $bid_amount = $_POST['bid_amount'];
    $user_id = $_SESSION['user_id'];

    
    $stmt = $pdo->prepare("SELECT highest_bid FROM items WHERE id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch();

    if ($bid_amount > $item['highest_bid']) {
        
        $stmt = $pdo->prepare("INSERT INTO bids (user_id, item_id, bid_amount) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $item_id, $bid_amount]);

        
        $stmt = $pdo->prepare("UPDATE items SET highest_bid = ?, highest_bidder = ? WHERE id = ?");
        $stmt->execute([$bid_amount, $user_id, $item_id]);

        $message = "Bid placed successfully!";
    } else {
        $error = "Bid must be higher than the current highest bid.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bid</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <a href="index.php">Back to auction</a>
    </div>
</body>
</html>
