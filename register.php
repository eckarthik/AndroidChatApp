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
    $checkRegistration = mysqli_query($connection,"SELECT * FROM chatusers WHERE name='$name'");
    if(mysqli_num_rows($checkRegistration)==1)
    {
        $response["success"] = false; //Name/HomeID already registered
        $response["message"] = "User already registered";
        echo json_encode($response);
    }
    else
    {
        $query = mysqli_query($connection,"INSERT into chatusers(name,password,deviceid) VALUES('$name','$password','$deviceid')");
        $response = array();
        if($query && $query2)
        {
            $response["success"] = true;
        }
        else
        {
            $response["success"] = false;
            $response["message"] = "Some error occured while adding data to the appusers";
        }
        echo json_encode($response);
    }
    
}
else
{
    echo "Required Data Missing";
}
?>