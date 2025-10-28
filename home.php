<?php
// home.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Facebook Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
        }
        .sidebar {
            width: 300px;
            padding: 20px;
            background-color: white;
            border-right: 1px solid #dddfe2;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar h3 {
            color: #1877f2;
            margin-bottom: 10px;
        }
        .user-list {
            list-style: none;
            padding: 0;
        }
        .user-list li {
            padding: 10px;
            border-bottom: 1px solid #dddfe2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add-friend {
            background-color: #1877f2;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .add-friend:hover {
            background-color: #166fe5;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 300px;
        }
        .post-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .post-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            resize: none;
        }
        .post-btn {
            background-color: #1877f2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .post-btn:hover {
            background-color: #166fe5;
        }
        .feed {
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
        .post-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .post-actions {
            display: flex;
            gap: 10px;
        }
        .like-btn, .comment-btn, .share-btn {
            background: none;
            border: none;
            color: #606770;
            cursor: pointer;
        }
        .like-btn:hover, .comment-btn:hover, .share-btn:hover {
            text-decoration: underline;
        }
        .comments {
            margin-top: 10px;
        }
        .comment {
            padding: 5px 0;
            border-top: 1px solid #dddfe2;
        }
        .header {
            background-color: #1877f2;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }
        .notifications-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2em;
            cursor: pointer;
            position: relative;
        }
        .notifications-popup {
            display: none;
            position: absolute;
            top: 40px;
            right: 20px;
            background-color: white;
            color: #1c1e21;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            width: 300px;
            padding: 10px;
            max-height: 400px;
            overflow-y: auto;
        }
        .notifications-popup.active {
            display: block;
        }
        .notification {
            padding: 10px;
            border-bottom: 1px solid #dddfe2;
        }
        .profile-link, .logout-link {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }
        .profile-link:hover, .logout-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                position: relative;
                width: auto;
                height: auto;
                border-right: none;
                border-bottom: 1px solid #dddfe2;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Facebook Clone</h2>
        <div>
            <button class="notifications-btn" onclick="toggleNotifications()">🔔</button>
            <a href="#" class="profile-link" onclick="redirectTo('profile.php')">Profile</a>
            <a href="#" class="logout-link" onclick="redirectTo('logout.php')">Logout</a>
        </div>
        <div class="notifications-popup" id="notificationsPopup"></div>
    </div>
    <div class="container">
        <div class="sidebar">
            <h3>Other Users</h3>
            <ul class="user-list" id="userList"></ul>
        </div>
        <div class="main-content" style="margin-top: 60px;">
            <div class="post-form">
                <textarea id="postContent" placeholder="What's on your mind?" rows="4"></textarea>
                <button class="post-btn" onclick="createPost()">Post</button>
            </div>
            <div class="feed" id="feed"></div>
        </div>
    </div>
    
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
        
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (!currentUser) {
            redirectTo('index.php');
        }
        
        function loadUsers() {
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const userList = document.getElementById('userList');
            userList.innerHTML = '';
            users.forEach(user => {
                if (user.email !== currentUser.email && !currentUser.friends.includes(user.email)) {
                    const li = document.createElement('li');
                    li.textContent = user.name;
                    const btn = document.createElement('button');
                    btn.className = 'add-friend';
                    btn.textContent = 'Add Friend';
                    btn.onclick = () => sendFriendRequest(user.email);
                    li.appendChild(btn);
                    userList.appendChild(li);
                }
            });
        }
        
        function sendFriendRequest(email) {
            const users = JSON.parse(localStorage.getItem('users'));
            const targetUser = users.find(u => u.email === email);
            targetUser.notifications.push(`${currentUser.name} sent you a friend request.`);
            localStorage.setItem('users', JSON.stringify(users));
            alert('Friend request sent!');
            addNotification(`You sent a friend request to ${targetUser.name}`);
        }
        
        function createPost() {
            const content = document.getElementById('postContent').value;
            if (!content) return;
            const post = { author: currentUser.email, content, likes: 0, comments: [], shares: 0 };
            currentUser.posts.push(post);
            updateCurrentUser();
            document.getElementById('postContent').value = '';
            loadFeed();
        }
        
        function loadFeed() {
            const feed = document.getElementById('feed');
            feed.innerHTML = '';
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const friends = users.filter(u => currentUser.friends.includes(u.email));
            const allPosts = [ ...currentUser.posts, ...friends.flatMap(f => f.posts) ];
            allPosts.forEach(post => {
                const postDiv = document.createElement('div');
                postDiv.className = 'post';
                const header = document.createElement('div');
                header.className = 'post-header';
                header.textContent = post.author;
                postDiv.appendChild(header);
                const content = document.createElement('p');
                content.textContent = post.content;
                postDiv.appendChild(content);
                const actions = document.createElement('div');
                actions.className = 'post-actions';
                const likeBtn = document.createElement('button');
                likeBtn.className = 'like-btn';
                likeBtn.textContent = `Like (${post.likes})`;
                likeBtn.onclick = () => {
                    post.likes++;
                    updatePosts();
                    loadFeed();
                    addNotification(`Someone liked your post: "${post.content.substring(0, 20)}..."`);
                };
                actions.appendChild(likeBtn);
                const commentBtn = document.createElement('button');
                commentBtn.className = 'comment-btn';
                commentBtn.textContent = `Comment (${post.comments.length})`;
                commentBtn.onclick = () => promptComment(post);
                actions.appendChild(commentBtn);
                const shareBtn = document.createElement('button');
                shareBtn.className = 'share-btn';
                shareBtn.textContent = `Share (${post.shares})`;
                shareBtn.onclick = () => {
                    post.shares++;
                    updatePosts();
                    loadFeed();
                };
                actions.appendChild(shareBtn);
                postDiv.appendChild(actions);
                const commentsDiv = document.createElement('div');
                commentsDiv.className = 'comments';
                post.comments.forEach(c => {
                    const comment = document.createElement('div');
                    comment.className = 'comment';
                    comment.textContent = c;
                    commentsDiv.appendChild(comment);
                });
                postDiv.appendChild(commentsDiv);
                feed.appendChild(postDiv);
            });
        }
        
        function promptComment(post) {
            const comment = prompt('Enter your comment:');
            if (comment) {
                post.comments.push(comment);
                updatePosts();
                loadFeed();
                addNotification(`Someone commented on your post: "${post.content.substring(0, 20)}..."`);
            }
        }
        
        function updatePosts() {
            // Simplified, assuming posts are in user objects
            updateCurrentUser();
        }
        
        function addNotification(message) {
            currentUser.notifications.push(message);
            updateCurrentUser();
        }
        
        function toggleNotifications() {
            const popup = document.getElementById('notificationsPopup');
            popup.classList.toggle('active');
            popup.innerHTML = '';
            currentUser.notifications.forEach(notif => {
                const div = document.createElement('div');
                div.className = 'notification';
                div.textContent = notif;
                popup.appendChild(div);
            });
        }
        
        function updateCurrentUser() {
            const users = JSON.parse(localStorage.getItem('users'));
            const index = users.findIndex(u => u.email === currentUser.email);
            users[index] = currentUser;
            localStorage.setItem('users', JSON.stringify(users));
            localStorage.setItem('currentUser', JSON.stringify(currentUser));
        }
        
        loadUsers();
        loadFeed();
    </script>
</body>
</html>
