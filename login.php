<?php
// login.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Facebook Clone</title>
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
        }
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #1877f2;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 1em;
        }
        .btn {
            width: 100%;
            padding: 15px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #166fe5;
        }
        .signup-link {
            margin-top: 20px;
            color: #1877f2;
            text-decoration: none;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to Facebook Clone</h2>
        <form id="loginForm">
            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="error" id="error"></p>
        <a href="#" class="signup-link" onclick="redirectTo('signup.php')">Create new account</a>
    </div>
    
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
        
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const user = users.find(u => u.email === email && u.password === password);
            if (user) {
                localStorage.setItem('currentUser', JSON.stringify(user));
                redirectTo('home.php');
            } else {
                document.getElementById('error').textContent = 'Invalid email or password';
            }
        });
    </script>
</body>
</html>
