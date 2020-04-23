<?php

//line 27 contains the no css table display, remove that once css linking to the html portion at end of file
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

$table = $table."</table>";

echo $table;
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="generaterep.css">
        <title></title>
    </head>
    <body>
        <?echo $table ?>
    </body>
</html>
