<?php
// logout.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Facebook Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .logout-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
        }
        h2 {
            color: #1877f2;
        }
        p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>Logging Out...</h2>
        <p>You will be redirected to the home page.</p>
    </div>
    
    <script>
        localStorage.removeItem('currentUser');
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2000);
    </script>
</body>
</html>
