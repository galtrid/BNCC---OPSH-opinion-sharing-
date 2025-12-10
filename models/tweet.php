<?php
class Tweet {
    private $pdo;
    public function __construct($pdo) { 
        $this->pdo = $pdo; 
    }

    public function create($userId, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO tweets (user_id, tweet) VALUES (?, ?)");
        return $stmt->execute([$userId, $content]);
    }
    
public function toggleLike($userId, $tweetId) {
        // Check if the user has already liked the tweet
        $stmt = $this->pdo->prepare("SELECT * FROM likes WHERE user_id = ? AND tweet_id = ?");
        $stmt->execute([$userId, $tweetId]);
        
        if ($stmt->fetch()) {
            // If already liked, UNLIKE (DELETE the record)
            $stmt = $this->pdo->prepare("DELETE FROM likes WHERE user_id = ? AND tweet_id = ?");
        } else {
            // If not liked, LIKE (INSERT the record)
            $stmt = $this->pdo->prepare("INSERT INTO likes (user_id, tweet_id) VALUES (?, ?)");
        }
        
        return $stmt->execute([$userId, $tweetId]);
    }


public function getAll($currentUserId) {
    
        $sql = "
            SELECT tweets.*, users.username 
            FROM tweets 
            JOIN users ON tweets.user_id = users.id         
            ORDER BY tweets.created_at DESC
        ";
        $tweets_result = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $final_tweets = [];
        foreach ($tweets_result as $tweet) {
            
            $tweetId = $tweet['id'];
            

            $countStmt = $this->pdo->prepare("SELECT COUNT(*) FROM likes WHERE tweet_id = :tweetId");
            $countStmt->execute(['tweetId' => $tweetId]);
            $tweet['like_count'] = $countStmt->fetchColumn(); 
            

            $likeCheckStmt = $this->pdo->prepare("
                SELECT 1 FROM likes 
                WHERE user_id = :currentUserId AND tweet_id = :tweetId
            ");
            $likeCheckStmt->execute(['currentUserId' => $currentUserId, 'tweetId' => $tweetId]);
            

            $tweet['is_liked'] = $likeCheckStmt->fetch() ? 1 : 0;
            

            $final_tweets[] = $tweet;
        }

        return $final_tweets;
    }
}
?>