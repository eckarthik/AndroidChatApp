<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "KartProj96$";
$dbname = "chatapp";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass) or die ("Unable to connect to MySQL DB:".mysqli_error($connection));
mysqli_select_db($connection,$dbname) or die("Unable to select DB".mysqli_error($connection));
if(isset($_POST['name']) && isset($_POST['password']))
{
    $name = $_POST['name'];
    $password = $_POST['password'];
    $deviceid = $_POST['deviceid'];
    $query = mysqli_query($connection,"SELECT * FROM chatusers WHERE name='$name' and password='$password' and deviceid='$deviceid'");
    $arrayresult = mysqli_fetch_array($query,MYSQLI_BOTH);
    $homeid = $arrayresult['homeid'];
    if(mysqli_num_rows($query)==1)
    {
        $response["success"] = true;
        $response["homeid"] = $homeid;
    }
    else
    {
        $response["success"] = false;
    }
    echo json_encode($response);
}
else
{
    echo "Required Data Missing";
}
?>