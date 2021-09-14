<?php
$con = mysqli_connect('localhost', 'root', '', 'social_network');
if (mysqli_connect_errno()) {
    echo 'Failed to connect:' . mysqli_connect_errno();
}

$query = mysqli_query($con, 'INSERT INTO test VALUES("", "Zara")');

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Zara Zamanian">
    <link rel="stylesheet" href="style.css">
    <title>Social Network</title>
</head>

<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg-fname" placeholder="First Name" required>
        <input type="text" name="reg-lname" placeholder="Last Name" required>
        <input type="email" name="reg-email1" placeholder="Email" required>
        <input type="email" name="reg-email2" placeholder="Confirm Email" required>
        <input type="password" name="reg-pass1" placeholder="Pasword" required>
        <input type="password" name="reg-pass2" placeholder="Confirm Pasword" required>
        <input type="submit" name="reg-btn" value="Register">
    </form>
</body>

</html>