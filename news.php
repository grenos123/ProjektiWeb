<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="news.css">

</head>
<body>
    <div class="navbar">
        <a href="home.php"><b>Swift Rentals</b></a>
        <a href="home.php">Home</a>
        <a href="main.php">Rentals</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="news.php" class="current-page">News</a>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            echo '<a href="Dashboard.php">Admin Dashboard</a>';
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>
    <iframe src="slider.html" width="100%" height="500px" style="border: none;"></iframe>
    <style>


.content {
    flex: 1; 
}

.bottom-container {
    position: fixed;
    bottom: 0;
    left: 20px;
    width: 400px; 
}
.container, .article-list {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    text-align: left;
    margin-bottom: 10px;
}

.form-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-group input {
    width: 48%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    width: 100%;
    background: #007BFF;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background: #0056b3;
}

.article-item {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.edit-btn, .delete-btn {
    margin: 5px;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.edit-btn {
    background: #28a745;
    color: white;
}

.delete-btn {
    background: red;
    color: white;
}
    </style>
    <script>
        
        async function handleSubmit(event) {
            event.preventDefault();
            const title = document.querySelector("input[name='title']").value;
            const description = document.querySelector("textarea[name='description']").value;
            const authorName = document.querySelector("input[name='authorName']").value;
            const authorEmail = document.querySelector("input[name='authorEmail']").value;
            
            const article = { articleTitle: title, description, authorName, authorEmail };
            
            const response = await fetch("post_article.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(article)
            });
            
            const result = await response.json();
            alert(result.message);
            fetchArticles();
        }

        async function fetchArticles() {
            const response = await fetch("get_articles.php");
            const articles = await response.json();
            const output = document.getElementById("article-list");
            output.innerHTML = "";
            const isAdmin = <?php echo (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') ? 'true' : 'false'; ?>;
            
            articles.forEach(article => {
                output.innerHTML += `<div class='article-item'>
                <h3>${article.article_title}</h3>
                <p>${article.description}</p>
                <p>Added by: ${article.author_name} (${article.author_email})</p>
                ${isAdmin ? `
                <button class='edit-btn' onclick='editArticle(${article.id})'>Edit</button>
                <button class='delete-btn' onclick='deleteArticle(${article.id})'>Delete</button>
                ` : ''}
                </div>`;
            });
}

        async function deleteArticle(id) {
            await fetch(`delete_article.php?id=${id}`, { method: "DELETE" });
            fetchArticles();
        }

        async function editArticle(id) {
            const newTitle = prompt("Enter new title:");
            const newDescription = prompt("Enter new description:");
            if (newTitle && newDescription) {
                await fetch("update_article.php", {
                    method: "PUT",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id, articleTitle: newTitle, description: newDescription })
                });
                fetchArticles();
            }
        }

        document.addEventListener("DOMContentLoaded", fetchArticles);
    </script>

<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
    <div class="container">
        <h2>Post Article</h2>
        <form onsubmit="handleSubmit(event)">
            <div class="form-group">
                <input type="text" placeholder="Article Title" name="title" required>
                <textarea placeholder="Description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Author Name" name="authorName" required>
                <input type="email" placeholder="Author Email" name="authorEmail" required>
            </div>
            <button type="submit" class="btn">POST ARTICLE</button>
        </form>
    </div>
    <?php endif; ?>
    <div id="article-list" class="article-list"></div>
    <div class="under">
        <h2>Swift Rentals</h2>
        <p>Your go-to rental stop in ALL of Kosovo</p>
        <br>
        <p>Serving you with the best car rentals, reliable customer service, and unbeatable prices.</p>
        <br>
        <p>Contact us:</p>
        <p>Email: support@rentacar02.com</p>
        <p>Phone: +383 38 541 400</p>
        <br>
        <p>Follow us on social media:</p>
        <p>
            <a href="https://www.facebook.com/ubthighereducationinstitution" target="_blank">Facebook</a> | 
            <a href="https://www.instagram.com/ubt_official" target="_blank">Instagram</a> |
            <a href="https://x.com/UBTEducation" target="_blank">Twitter</a>
        </p>
        <br>
        <p>Terms & Conditions | Privacy Policy</p>
        <br>
        <a href="home.php">Home</a>
        <br>
        <a href="aboutus.php">About Us</a>
    </div>
</body>
</html>