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
    $query = mysqli_query($connection,"SELECT * FROM chatmessages where name='$name' ORDER by timestamp DESC");
    $arrayresult = mysqli_fetch_row($query,MYSQLI_BOTH);
    $messageinDB = $arrayresult[1];
    $timestampinDB = $arrayresult[2];
    if(mysqli_num_rows($query)==1)
    {
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