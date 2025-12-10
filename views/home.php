<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Home Feed</title>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Home</h2>
        <a href="index.php?page=logout" class="home-button">Logout</a>
    </div>

    <form method="POST">
        <input type="hidden" name="tweeting" value="1">
        <textarea name="tweet" placeholder="What is happening?" maxlength="280" required></textarea>
        <button type="submit">Tweet</button>
    </form>

    <div class="feed">
        <?php foreach ($tweets as $tweet): ?>
            <div class="tweet">
                
                <div class="tweet-header">
                    <br>
                    <br>
                    <br>
                    ------------------------------------------------------------------------------<br>
                    <strong>@<?= $tweet['username'] ?></strong>
                    <br>
                </div>

                <p><?= $tweet['tweet'] ?></p>

                <div class="tweet-footer">
                    <small><?= $tweet['created_at'] ?></small>

                    <form method="POST" action="index.php?page=like" class="like-form">
                        <input type="hidden" name="tweet_id" value="<?= $tweet['id'] ?>">

                        <button 
                            type="submit" 
                            class="like-button <?= $tweet['is_liked'] ? 'liked' : '' ?>">
                            
                            <?= $tweet['is_liked'] ? '❤️' : '🤍' ?>
                            <?= $tweet['like_count'] ?>
                        </button>
                    ------------------------------------------------------------------------------
                    
                    </form>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
