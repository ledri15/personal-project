
<?php include('header.php'); ?>


<?php

$name = $phone = $address = $order = "";
$nameErr = $phoneErr = $addressErr = $orderErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

   
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = htmlspecialchars(trim($_POST["phone"]));
        if (!preg_match("/^[0-9+\-\s()]+$/", $phone)) {
            $phoneErr = "Invalid phone number format";
        }
    }

   
    if (empty($_POST["address"])) {
        $addressErr = "Delivery address is required";
    } else {
        $address = htmlspecialchars(trim($_POST["address"]));
    }

   
    if (empty($_POST["order"])) {
        $orderErr = "Please enter your order details";
    } else {
        $order = htmlspecialchars(trim($_POST["order"]));
    }


    if (!$nameErr && !$phoneErr && !$addressErr && !$orderErr) {
        $successMsg = "Thank you, <strong>$name</strong>! Your order has been received and will be delivered to <strong>$address</strong>. We will contact you at <strong>$phone</strong> if needed.";
        
     
        $name = $phone = $address = $order = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Delivery Order Form</title>
<style>
    .error { color: red; }
    form { max-width: 400px; margin: 20px auto; font-family: Arial, sans-serif; }
    label { display: block; margin-top: 10px; }
    input[type="text"], textarea { width: 100%; padding: 8px; margin-top: 4px; }
    button { margin-top: 15px; padding: 10px 20px; }
    .success { background: #d4edda; color: #155724; padding: 15px; margin: 20px auto; max-width: 400px; border-radius: 5px; }
</style>
</head>
<body>


<h2 style="text-align:center;">Delivery Order Form</h2>

<?php if ($successMsg): ?>
    <div class="success"><?php echo $successMsg; ?></div>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span class="error"><?php echo $nameErr; ?></span>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
    <span class="error"><?php echo $phoneErr; ?></span>

    <label for="address">Delivery Address:</label>
    <textarea id="address" name="address" rows="3"><?php echo $address; ?></textarea>
    <span class="error"><?php echo $addressErr; ?></span>

    <label for="order">Order Details:</label>
    <textarea id="order" name="order" rows="5" placeholder="E.g. 2x Margherita Pizza, 1x Caesar Salad"><?php echo $order; ?></textarea>
    <span class="error"><?php echo $orderErr; ?></span>

    <button type="submit">Place Order</button>
</form>


    <?php include('footer.php'); ?>
</body>
</html>
