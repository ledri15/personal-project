<?php include('header.php'); ?>

<?php
$file = 'reviews.txt';
$name = $review = $rating = "";
$error = "";
$success = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $review = trim($_POST['review']);
    $rating = intval($_POST['rating']);

    if (!$name || !$review || $rating < 1 || $rating > 5) {
        $error = "Please fill all fields and select a valid rating (1-5).";
    } else {
        $line = "$name|$rating|$review|" . date('Y-m-d H:i') . "\n";
        file_put_contents($file, $line, FILE_APPEND);
        $success = "Thanks for your review!";
        $name = $review = $rating = "";
    }
}


$reviews = [];
if (file_exists($file)) 
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $parts = explode("|", $line);
        if (count($parts) === 4) {
            list($n, $r, $rev, $date) = $parts;
            $reviews[] = ['name'=>$n, 'rating'=>$r, 'review'=>$rev, 'date'=>$date];
        }
        
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews</title>
    <style>
        form { max-width: 400px; margin: 20px auto; font-family: Arial, sans-serif; }
        body { max-width:10000px; margin:20px auto; font-family:sans-serif; }
        .error {color:red;}
        .success {color:green;}
        .review {border-bottom:1px solid #ccc; padding:10px 0;}
        .stars {color:#f39c12;}
       
    </style>
    
</head>
<body>

<h2>Leave a Review</h2>

<?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<?php if($success): ?><p class="success"><?= $success ?></p><?php endif; ?>

<form method="post">
    <input type="text" name="name" placeholder="Your Name" value="<?= htmlspecialchars($name) ?>" required><br><br>
    <select name="rating" required>
        <option value="">Rating</option>
        <?php for($i=1;$i<=5;$i++): ?>
        <option value="<?= $i ?>" <?= ($rating==$i)?'selected':'' ?>><?= $i ?></option>
        <?php endfor; ?>
    </select><br><br>
    <textarea name="review" rows="4" placeholder="Your review" required><?= htmlspecialchars($review) ?></textarea><br><br>
    <button type="submit">Submit</button>
</form>

<h2>Reviews</h2>

<?php if ($reviews): ?>
    <?php foreach (array_reverse($reviews) as $rev): ?>
        <div class="review">
            <strong><?= htmlspecialchars($rev['name']) ?></strong> - 
            <span class="stars"><?= str_repeat('★', $rev['rating']) . str_repeat('☆', 5 - $rev['rating']) ?></span><br>
            <small><?= $rev['date'] ?></small>
            <p><?= nl2br(htmlspecialchars($rev['review'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No reviews yet.</p>
<?php endif; ?>

<?php include('footer.php'); ?>
</body>
</html>