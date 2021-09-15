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
    <title>Social Network</title>
</head>

<body>
</body>

</html>