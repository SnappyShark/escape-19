<?php

$server = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'escape';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$usr = $_POST['usr'];
$pwd = $_POST['pwd'];
$type = $_POST['type'];

?>
  <link rel = "stylesheet" type="text/css" href = "signup.css">
<?

if($type === 'retailer')
{
    $sql = "SELECT COUNT(*) FROM login_admin WHERE 'name' = '$usr' AND 'password' = '$pwd' ";
    $result = $conn->query($sql);


    if($result === 1)
    {
        echo "Logged in successfully";
    }
    else {
        echo "Incorrect Password, lmao";
    }
}
else
{

    $sql = "SELECT * FROM login_retail WHERE shop_name = '$usr' AND password = '$pwd'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        echo "Logged in successfully";
    }
    else {
        echo "Incorrect Password, lmao";
    }
}

$conn->close();
?>
