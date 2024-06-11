<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$stmt = $pdo->query("SELECT * FROM items");
$items = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Auction</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Online Auction</h1>
        <div class="logout-button-container">
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
        <h2>Auction Items</h2>
        <div class="add-item-container">
            <a href="add_item.php" class="add-item-button">Add New Item</a>
        </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Starting Bid</th>
                <th>Highest Bid</th>
                <th>Bid</th>
            </tr>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td><?= htmlspecialchars($item['starting_bid']) ?></td>
                <td><?= htmlspecialchars($item['highest_bid']) ?></td>
                <td>
                    <form method="POST" action="bid.php">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <input type="number" name="bid_amount" min="<?= $item['highest_bid'] + 1 ?>" required>
                        <button type="submit" class="bid-button">Bid</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
