<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "KartProj96$";
$dbname = "chatapp";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass) or die ("Unable to connect to MySQL DB:".mysqli_error($connection));
mysqli_select_db($connection,$dbname) or die("Unable to select DB".mysqli_error($connection));
if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $lastseentimestamp = $_POST['currentuats'];
    $query3 = mysqli_query($connection,"UPDATE chatusers SET lastseen='$lastseentimestamp' WHERE name='$name'");
    $response = array();
    if($query3)
    {
        $response["lastseenupdate"] = "Success";
    }
    else
    {
        $response["lastseenupdate"] = "Failed";
    }
    $query = mysqli_query($connection,"SELECT * FROM chatmessages where name='$name' ORDER by timestamp DESC");
    $arrayresult = mysqli_fetch_array($query,MYSQLI_BOTH);
    $messageinDB = $arrayresult[1];
    $timestampinDB = $arrayresult[2];
    if($query)
    {
        $query2 = mysqli_query($connection,"SELECT * FROM chatusers WHERE name='$name'");
        $arrayresult2 = mysqli_fetch_array($query2,MYSQLI_BOTH);
        $response["lastseen"] = $arrayresult2[3];
        $response["success"] = true;
        $response["message"] = $messageinDB;
        $response["timestamp"] = $timestampinDB;
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