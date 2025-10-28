<?php
// signup.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Facebook Clone</title>
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
        .signup-container {
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
            background-color: #42b72a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #36a420;
        }
        .login-link {
            margin-top: 20px;
            color: #1877f2;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up for Facebook Clone</h2>
        <form id="signupForm">
            <input type="text" id="name" placeholder="Full Name" required>
            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>
            <input type="text" id="bio" placeholder="Bio (optional)">
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p class="error" id="error"></p>
        <a href="#" class="login-link" onclick="redirectTo('login.php')">Already have an account? Login</a>
    </div>
    
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
        
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const bio = document.getElementById('bio').value;
            const users = JSON.parse(localStorage.getItem('users')) || [];
            if (users.find(u => u.email === email)) {
                document.getElementById('error').textContent = 'Email already exists';
                return;
            }
            const newUser = { name, email, password, bio, friends: [], posts: [], notifications: [] };
            users.push(newUser);
            localStorage.setItem('users', JSON.stringify(users));
            localStorage.setItem('currentUser', JSON.stringify(newUser));
            redirectTo('home.php');
        });
    </script>
</body>
</html>
