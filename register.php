<?php
$con = mysqli_connect('localhost', 'root', '', 'social_network');
if (mysqli_connect_errno()) {
    echo 'Failed to connect:' . mysqli_connect_errno();
}


//declaring form variables-----------------------
$fname = '';
$lname = '';
$email1 = '';
$email2 = '';
$pass1 = '';
$pass2 = '';
$date = ''; //sign-up date
$error_array = ''; //holds error messages


//post registration values-----------------------
if (isset($_POST['reg-btn'])) {
    $fname = strip_tags($_POST['reg-fname']); //remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //only first letter is uppercase

    $lname = strip_tags($_POST['reg-lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));

    $email1 = strip_tags($_POST['reg-email1']);
    $email1 = str_replace(' ', '', $email1);

    $email2 = strip_tags($_POST['reg-email2']);
    $email2 = str_replace(' ', '', $email2);

    $pass1 = strip_tags($_POST['reg-pass1']);

    $pass2 = strip_tags($_POST['reg-pass2']);

    $date = date('Y-m-d');


    //handling form errors------
    if ($email1 == $email2) {
        //check the email format
        if (filter_var($email1, FILTER_VALIDATE_EMAIL)) {
            $email1 = filter_var($email1, FILTER_VALIDATE_EMAIL);
        } else {
            echo 'Email Format is not valid!';
        }
    } else {
        echo 'Emails do not match!';
    }
}


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Zara Zamanian">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>

<body>

</body>

</html>

<form action="register.php" method="POST">
    <input type="text" name="reg-fname" placeholder="First Name" required>
    <input type="text" name="reg-lname" placeholder="Last Name" required>
    <input type="email" name="reg-email1" placeholder="Email" required>
    <input type="email" name="reg-email2" placeholder="Confirm Email" required>
    <input type="password" name="reg-pass1" placeholder="Pasword" required>
    <input type="password" name="reg-pass2" placeholder="Confirm Pasword" required>
    <input type="submit" name="reg-btn" value="Register">
</form>