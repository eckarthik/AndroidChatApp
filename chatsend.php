<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "KartProj96$";
$dbname = "chatapp";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass) or die ("Unable to connect to MySQL DB:".mysqli_error($connection));
mysqli_select_db($connection,$dbname) or die("Unable to select DB".mysqli_error($connection));
if(isset($_POST['name']) && isset($_POST['message']))
{
    $name = $_POST['name'];
    $message = $_POST['message'];
    $timestamp = $_POST['timestamp'];
    $query = mysqli_query($connection,"INSERT INTO chatmessages(name,message,timestamp) VALUES('$name','$message','$timestamp')");
    if($query)
    {
        $response["success"] = true;
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