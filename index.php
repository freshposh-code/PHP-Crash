<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>WELCOME TO POSHBOOK</h2>
        <label>UserName</label> <br>
        <input type="text" name="username"> <br>
        <label>Password</label> <br>
        <input type="password" name="password"> <br> <br>
        <input type="submit" name="submit" value="register"> <br>
    </form>
    <br>
    <br>
    <br>
</body>

</html>
<?php

include("database.php");

// CREATE USER FORM TO STORE IN DB

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo "Please enter a username";
    } elseif (empty($password)) {
        echo "Please enter a password" . "<br>";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user, password) 
        VALUES ('$username', '$hash')";

        mysqli_query($conn, $sql);
        echo "YOU ARE NOW REGISTERED";
    }
}


// FETCH ROWS FROM DATABASE

$sql = "SELECT * FROM users";
$results = mysqli_query($conn, $sql);

if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
        // echo $row["id"] . "<br>";
        // echo $row["user"] . "<br>";
        // echo $row["reg_date"] . "<br>";
    };
} else {
    echo "No user found<br>";
}

mysqli_close($conn);
