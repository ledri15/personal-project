<?php include('header.php'); ?>

<h2>Contact Us</h2>
<form method="POST" action="">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" required></textarea><br><br>

    <input type="submit" value="Send">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $message = htmlspecialchars($_POST["message"]);

    echo "<p>Thank you, $name. We have received your message.</p>";
}
?>

<?php include('footer.php'); ?>
