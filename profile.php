<?php
// profile.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Facebook Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .profile-info {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .profile-info h2 {
            color: #1877f2;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #dddfe2;
            border-radius: 6px;
        }
        .save-btn {
            background-color: #1877f2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        .save-btn:hover {
            background-color: #166fe5;
        }
        .posts {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .post {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #1877f2;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .back-link {
            color: white;
            text-decoration: none;
            position: absolute;
            left: 20px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#" class="back-link" onclick="redirectTo('home.php')">Back to Home</a>
        <h2>Your Profile</h2>
    </div>
    <div class="container" style="margin-top: 60px;">
        <div class="profile-info">
            <h2>Edit Profile</h2>
            <input type="text" id="name" placeholder="Name">
            <input type="text" id="bio" placeholder="Bio">
            <button class="save-btn" onclick="saveProfile()">Save</button>
        </div>
        <h3>Your Posts</h3>
        <div class="posts" id="posts"></div>
    </div>
    
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
        
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (!currentUser) {
            redirectTo('index.php');
        }
        
        document.getElementById('name').value = currentUser.name;
        document.getElementById('bio').value = currentUser.bio;
        
        function saveProfile() {
            currentUser.name = document.getElementById('name').value;
            currentUser.bio = document.getElementById('bio').value;
            const users = JSON.parse(localStorage.getItem('users'));
            const index = users.findIndex(u => u.email === currentUser.email);
            users[index] = currentUser;
            localStorage.setItem('users', JSON.stringify(users));
            localStorage.setItem('currentUser', JSON.stringify(currentUser));
            alert('Profile updated!');
        }
        
        function loadPosts() {
            const postsDiv = document.getElementById('posts');
            postsDiv.innerHTML = '';
            currentUser.posts.forEach(post => {
                const postDiv = document.createElement('div');
                postDiv.className = 'post';
                const content = document.createElement('p');
                content.textContent = post.content;
                postDiv.appendChild(content);
                postsDiv.appendChild(postDiv);
            });
        }
        
        loadPosts();
    </script>
</body>
</html>b
