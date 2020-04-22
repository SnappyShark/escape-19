<?php

$svr = '127.0.0.1';
$usr = 'root';
$password = '';
$db = 'escape';

$conn = new mysqli($svr, $usr, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$shop_name = $_POST['shop_name'];
$shop_type = $_POST['shop_type'];
$owner_name = $_POST['owner_name'];
$phone_num = $_POST['phone_num'];
$locality = $_POST['locality'];
$address = $_POST['address'];
$patrol_num = $_POST['patrol_num'];
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];

?>
  <link rel = "stylesheet" type="text/css" href = "signup.css">
<?

if($pwd === $repwd)
{
    $sql = "INSERT INTO signup_retail VALUES('$shop_name', '$shop_type','$owner_name', $phone_num, '$locality',
                '$address', $patrol_num, '0')";
    $sql1 = "INSERT INTO login_retail VALUES('$shop_name', $phone_num, '$pwd')";
    $result = $conn->query($sql);
    $result1 = $conn->query($sql1);
    echo "account created successfully";
}
else
{
    echo "
        <form name='getPwd' action = 'signup-validation.php' method = 'POST'>
            <input type = 'text' value = '$shop_name' name = 'shop_name' >
            <input type = 'text' value = '$shop_type' name = 'shop_type' >
            <input type = 'text' value = '$owner_name' name = 'owner_name' >
            <input type = 'text' value = '$phone_num' name = 'phone_num' >
            <input type = 'text' value = '$locality' name = 'locality' >
            <input type = 'text' value = '$address' name = 'address' >
            <input type = 'text' value = '$patrol_num' name = 'patrol_num' > <br><br>

            passwords do not match. <br>

            <input type ='password' placeholder='Password' name = 'pwd' required>
            <input type ='password' placeholder='Re-enter Password' name = 'repwd' required>
            <input id='submit' type='submit' value='Submit'>
        </form>
        ";
}

$conn->close();
?>
