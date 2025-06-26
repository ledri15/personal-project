<?php include('header.php'); ?>

<h2>Contact Us</h2>
<p>Have a question or want to make a reservation? Send us a message!</p>

<form method="POST" action="">
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="message">Your Message:</label>
    <textarea id="message" name="message" required></textarea>

    <input type="submit" value="Send Message">
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    echo "<p>Thank you, <strong>$name</strong>. We’ve received your message!</p>";
}
?>

<?php include('footer.php'); ?>
