<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "KartProj96$";
$dbname = "chatapp";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass) or die ("Unable to connect to MySQL DB:".mysqli_error($connection));
mysqli_select_db($connection,$dbname) or die("Unable to select DB".mysqli_error($connection));
if(isset($_POST['name']) && isset($_POST['friendname']))
{
    $name = $_POST['name'];
    $friendname = $_POST['friendname'];
    $query = mysqli_query($connection,"SELECT message,timestamp FROM chatmessages WHERE name='$name'");
    $messages = array();
    while ($row=mysqli_fetch_row($query))
    {
        $messages["$row[1]"] = array($row[0],$name);
        
    }
     mysqli_free_result($query);
    $query = mysqli_query($connection,"SELECT message,timestamp FROM chatmessages WHERE name='$friendname'");
    while ($row=mysqli_fetch_row($query))
    {
        $messages["$row[1]"] = array($row[0],$name);
        
    }
     mysqli_free_result($query);
     $sorted = sort($messages);
     json_encode($messages);
}
else
{
    echo "Required data missing";
}
?>