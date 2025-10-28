<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Clone - Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #1c1e21;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #1877f2;
            color: white;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .info-section {
            padding: 40px 20px;
            text-align: center;
        }
        .info-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .info-section p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .advantages, .functions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: left;
        }
        .card h3 {
            color: #1877f2;
            margin-bottom: 10px;
        }
        .auth-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }
        .btn {
            padding: 15px 30px;
            font-size: 1.2em;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-btn {
            background-color: #1877f2;
            color: white;
        }
        .login-btn:hover {
            background-color: #166fe5;
        }
        .signup-btn {
            background-color: #42b72a;
            color: white;
        }
        .signup-btn:hover {
            background-color: #36a420;
        }
        footer {
            background-color: #1877f2;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Facebook Clone</h1>
    </header>
    <div class="container">
        <section class="info-section">
            <h2>About Facebook</h2>
            <p>Facebook is a social networking platform that connects people from all over the world. It allows users to share updates, photos, and videos, connect with friends and family, and discover new content.</p>
            
            <h2>Advantages of Using Facebook</h2>
            <div class="advantages">
                <div class="card">
                    <h3>Stay Connected</h3>
                    <p>Keep in touch with friends and family no matter where they are.</p>
                </div>
                <div class="card">
                    <h3>Share Moments</h3>
                    <p>Post photos, videos, and status updates to share your life.</p>
                </div>
                <div class="card">
                    <h3>Discover Communities</h3>
                    <p>Join groups and pages based on your interests.</p>
                </div>
                <div class="card">
                    <h3>Business Opportunities</h3>
                    <p>Promote your business and reach a wider audience.</p>
                </div>
            </div>
            
            <h2>Key Functions</h2>
            <div class="functions">
                <div class="card">
                    <h3>News Feed</h3>
                    <p>See updates from friends in real-time.</p>
                </div>
                <div class="card">
                    <h3>Friend Requests</h3>
                    <p>Connect with new people by sending and accepting requests.</p>
                </div>
                <div class="card">
                    <h3>Messaging</h3>
                    <p>Chat privately with friends.</p>
                </div>
                <div class="card">
                    <h3>Likes & Comments</h3>
                    <p>Interact with posts through likes, comments, and shares.</p>
                </div>
            </div>
        </section>
        
        <div class="auth-buttons">
            <button class="btn login-btn" onclick="redirectTo('login.php')">Login</button>
            <button class="btn signup-btn" onclick="redirectTo('signup.php')">Signup</button>
        </div>
    </div>
    <footer>
        &copy; 2025 Facebook Clone
    </footer>
    
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
