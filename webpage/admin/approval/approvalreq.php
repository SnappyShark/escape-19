<?php

//do all your css stuff and link it to the html stuff after this php code $table contains the table data
// to display the content of the table do that <? echo $table?>

<?

$svr = '127.0.0.1';
$usr = 'root';
$password = '';
$db = 'escape';

$conn = new mysqli($svr, $usr, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$temp = 1;
$table = "";

echo "<meta http-equiv='refresh' content='5'>";

echo "<br/> <br/> <center><h1>Retailer Application Request</h1></center><hr/>";

$sql = "SELECT * FROM signup_retail WHERE verified = '0'";
$result= $conn->query($sql);

if ($result->num_rows > 0)
{
    echo "<script>
          sendNotif();

          function sendNotif()
          {
              if (!('Notification' in window))
              {
                  alert('This browser does not support desktop notification');
              }
              else if (Notification.permission === 'granted')
              {
                  var notification = new Notification('You have a request to view!');
              }
              else if (Notification.permission !== 'denied')
              {
                  Notification.requestPermission().then(function (permission) {
                      if (permission === 'granted')
                      {
                          var notification = new Notification('You have a request to view!');
                      }
                  });
              }
          }
         </script>";
}


echo "<form name='show_all' id='content_type' method = 'POST'>
      Type: <input type='submit' name='btn1' value='Requests' onclick='return 1;'/>
      <input type='submit' name='btn2' value='All' onclick='return 1;'/>
      </form> ";

if(isset($_POST['btn1'])==1)
{
    $temp = 1;
}
else if (isset($_POST['btn2'])==1)
{
    $temp = 2;
}

if($temp == 1)
{
    $sql = "SELECT * FROM signup_retail WHERE verified = '0'";
}
else
{
    $sql = "SELECT * FROM signup_retail";
}

$result = $conn->query($sql);

if ($result->num_rows>0)
{
    $table = $table."<table border=3><tr><th>Shop Name</th><th>Shop Type</th>
		   <th>Owner Name</th><th>Phone Number</th><th>Locality</th>
		   <th>Address</th><th>Patrol Number</th><th>Approval</th></tr>";

    while($row = $result->fetch_assoc()) {
        $flag = "Pending";

        if($row["verified"]==1)
        {
            $flag = "Approved";
        }
        else if($row["verified"]==2)
        {
            $flag = "Rejected";
        }

        $t = $row['phone_num'];

        $table = $table."<tr><td>".$row['shop_name']."</td><td>".$row['shop_type']."</td><td>".$row['owner_name'].
			 "</td><td>".$row['phone_num']."</td><td>".$row['locality']."</td><td>".$row['address']."</td><td>"
			 .$row['patrol_num']."</td>";

        if($temp == 1)
        {
            $table = $table."<td></td>";
            $yol = getStatus();

            $sql1 = "UPDATE signup_retail set verified = $yol WHERE phone_num = $t";

            if($res = $conn->query($sql1))
            {
                echo "<script> window.location.replace('approvalreq.php') </script>";
                break;
            }
        }
		else {
            $table = $table."<td>".$flag."</td>";
		}

        $table = $table."</tr>";
    }
    $table = $table."</table>";
}
else
{
    echo "No new requests";
}

$conn->close();

function getStatus()
{
    echo "<form name='appr' id='appr_type' method = 'POST'>
          <input type='submit' name='appr1' value='YES' onclick='return 1;'/>
          <input type='submit' name='appr2' value='NO' onclick='return 1;'/>
          </form>";

    if(isset($_POST['appr1'])==1){
        return 1;
    }
    else if (isset($_POST['appr2'])==1){
        return 2;
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel = "stylesheet" type="text/css" href = "../../portal/generaterep.css">
    </head>
    <body>
        <?echo $table?>
    </body>
</html>
