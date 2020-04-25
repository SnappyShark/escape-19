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

$table = 'login_'.$type;

$sql = "SELECT * FROM $table WHERE user_name = '$usr' AND password = '$pwd'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    setcookie("usr", $usr, time() + (86400 * 30), "/");
    setcookie("type", $type, time() + (86400 * 30), "/");

    echo "Logged in. Redirecting";
    echo "<meta http-equiv='refresh' content='1;url=../$type/dashboard.html'>";
}
else {
    echo "Incorrect Password";
}

$conn->close();
?>
