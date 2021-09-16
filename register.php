<?php
session_start(); //to store and keep entered values in a session

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
$error_array = array(); //holds error messages



//check inputs and send values after clicking register button-----------------------
if (isset($_POST['reg-btn'])) {
    $fname = strip_tags($_POST['reg-fname']); //to remove html tags
    $fname = str_replace(' ', '', $fname); //to remove spaces
    $fname = ucfirst(strtolower($fname)); //only first letter is uppercase
    $_SESSION['reg-fname'] = $fname; //to store first-name into session variable

    $lname = strip_tags($_POST['reg-lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg-lname'] = $lname;

    $email1 = strip_tags($_POST['reg-email1']);
    $email1 = str_replace(' ', '', $email1);
    $_SESSION['reg-email1'] = $email1;

    $email2 = strip_tags($_POST['reg-email2']);
    $email2 = str_replace(' ', '', $email2);
    $_SESSION['reg-email2'] = $email2;

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
                //OLDWAY: echo 'This email already exists!';
                //(we want messeges appear below the related line)
                array_push($error_array, 'This email already exists!');
            }
        } else {
            array_push($error_array, 'Email Format is not valid!');
        }
    } else {
        array_push($error_array, 'Emails do not match!');
    }

    //first name
    if (strlen($fname) > 20 || strlen($fname) < 2) {
        array_push($error_array, 'First name must have between 2 to 20 characters!');
    }

    //last name
    if (strlen($lname) > 50 || strlen($lname) < 2) {
        array_push($error_array, 'Last name must have between 2 to 50 characters!');
    }

    //password
    if ($pass1 != $pass2) {
        array_push($error_array, 'Passwords do not match!');
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $pass1)) {
            array_push($error_array, 'Password can only have English characters/numbers!');
        }
    }
    if (strlen($pass1) > 30 || strlen($pass1) < 5) {
        array_push($error_array, 'Password must have between 3 to 30 characters!');
    }



    //get registration values in database in case there is no error------
    if (empty($error_array)) {
        //encript the password
        $pass1 = md5($pass1);

        //generate username
        $username = strtolower($fname . '_' . $lname);

        //check if username already exists
        $username_existence_check = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");

        //add numbers to username in case it already exists
        $i = 0;
        while ($username_existence_check != 0) {
            $i++;
            $username = $username . '_' . $i;
            $username_existence_check = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
        }
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
    <input type="text" name="reg-fname" placeholder="First Name" value="<?php
                                                                        if (isset($_SESSION['reg-fname'])) {
                                                                            echo $_SESSION['reg-fname'];
                                                                        } ?>" required>
    <?php
    if (in_array('First name must have between 2 to 20 characters!', $error_array)) echo 'First name must have between 2 to 20 characters!';
    ?>

    <input type="text" name="reg-lname" placeholder="Last Name" value="<?php
                                                                        if (isset($_SESSION['reg-lname'])) {
                                                                            echo $_SESSION['reg-lname'];
                                                                        } ?>" required>
    <?php
    if (in_array('Last name must have between 2 to 50 characters!', $error_array)) echo 'Last name must have between 2 to 50 characters!';
    ?>

    <input type="email" name="reg-email1" placeholder="Email" value="<?php
                                                                        if (isset($_SESSION['reg-email1'])) {
                                                                            echo $_SESSION['reg-email1'];
                                                                        } ?>" required>
    <input type="email" name="reg-email2" placeholder="Confirm Email" value="<?php
                                                                                if (isset($_SESSION['reg-email2'])) {
                                                                                    echo $_SESSION['reg-email2'];
                                                                                } ?>" required>
    <?php
    if (in_array('This email already exists!', $error_array)) echo 'This email already exists!';
    if (in_array('Email Format is not valid!', $error_array)) echo 'Email Format is not valid!';
    if (in_array('Emails do not match!', $error_array)) echo 'Emails do not match!';
    ?>


    <input type="password" name="reg-pass1" placeholder="Pasword" required>
    <input type="password" name="reg-pass2" placeholder="Confirm Pasword" required>
    <?php
    if (in_array('Passwords do not match!', $error_array)) echo 'Passwords do not match!';
    if (in_array('Password can only have English characters/numbers!', $error_array)) echo 'Password can only have English characters/numbers!';
    if (in_array('Password must have between 3 to 30 characters!', $error_array)) echo 'Password must have between 3 to 30 characters!';
    ?>

    <input type="submit" name="reg-btn" value="Register">
</form>