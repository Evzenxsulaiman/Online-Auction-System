<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <style>
    p{
    text-align: center;
    }
    a{
        color: white;
        background-color: green;
        border: 10px;
        border-radius: 8px;
        width: 400px;
        height: 25px;
        text-align: center;
        padding-top: 10px;
        padding-bottom: 10px;
        display: block;
        background-color: red;
    }
    a:hover{
        color: aliceblue;
    }
    
   </style>
    <div class="container">
        <h1>Logout</h1>
        <p>Are you sure you want to logout?</p>
        <form method="POST" action="logout_process.php">
            <button type="submit" name="logout">Yes, Logout</button>
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
