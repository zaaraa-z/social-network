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

            //check if email already exists
            $email_existence_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$email1'");
            $num_rows = mysqli_num_rows($email_existence_check);
            if ($num_rows > 0) {
                echo 'This email already exists!';
            }
        } else {
            echo 'Email Format is not valid!';
        }
    } else {
        echo 'Emails do not match!';
    }

    //first name
    if (strlen($fname) > 20 || strlen($fname) < 2) {
        echo 'First name must have between 2 to 20 characters!';
    }

    //last name
    if (strlen($lname) > 50 || strlen($lname) < 2) {
        echo 'Last name must have between 2 to 50 characters!';
    }

    //password
    if ($pass1 != $pass2) {
        echo 'Passwords do not match!';
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $pass1)) {
            echo 'Password can only have English characters/numbers!';
        }
    }
    if (strlen($pass1) > 30 || strlen($pass1) < 5) {
        echo 'Password must have between 3 to 30 characters!';
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