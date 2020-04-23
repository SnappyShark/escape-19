<?php
$svr = '127.0.0.1';
$usr = 'root';
$password = '';
$db = 'escape';

$conn = new mysqli($svr, $usr, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM log_cust_data ORDER BY date,time desc";
$result = $conn->query($sql);

$table = "<table border=3><tr><th>Phone</th><th>Date</th><th>Time</th></tr>";

while($row = $result->fetch_assoc()) {

    $t = $row['phone_num'];
    $table = $table."<tr><td>".$row['phone_num']."</td><td>".$row['date']."</td><td>".$row['time']."</td></tr>";
}

$test = $table."</table>";

echo $test;
$conn->close();
?>
