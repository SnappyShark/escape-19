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
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];

?>
  <link rel = "stylesheet" type="text/css" href = "forgotpwd.css">
<?

if($pwd === $repwd)
{
    $sql = "UPDATE login_retail SET password = $repwd WHERE phone_num = $phone_num";
    $result = $conn->query($sql);
    echo "Password updated successfully";

    echo "<meta http-equiv='refresh' content='1;url=../homepage/home.html'>"
}
else{
    echo "Password not updated successfully

    <form name = 'pwd' action='forgotpwd.php' method='post'>
        <input type='text' name='phone_num' placeholder='Phone number' required>
        <input type='text' name='pwd' placeholder='New Password' required>
        <input type='text' name='repwd' placeholder='Re-type New password' required><br /><br /><br />
        <input type='button' value='Reset'><br /><br /><br />
    </form>
    ";
}

$conn->close();
?>
