<?php

$svr = '127.0.0.1';
$usr = 'root';
$password = '';
$db = 'escape';

$conn = new mysqli($svr, $usr, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phone_num = $_POST['phone_num'];

$date = date("Y/m/d");
date_default_timezone_set("Asia/Kolkata");
$time = date("h:i");

echo "Processing";
$store = $_COOKIE['user'];
$sql = "INSERT INTO log_cust_data VALUES($phone_num, '$date', '$time', '$store')";
$result = $conn->query($sql);


echo "<meta http-equiv='refresh' content='1.5;url=userentry.html'>"
?>
