<?php

//retrieve the mongoDB driver from vendor folder
require_once '../vendor/autoload.php';

//Connect to MongoDB database
$DBConn = new MongoDB\Client;

//Connect to specific database in MongoDB
$myDBConn = $DBConn -> mongoPHP;

//Connect to the specific mongoDB collection
$myCollection = $myDBConn -> users;

if(isset($_POST['update'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $hidden_id = $_POST['hidden_id'];
}

$data = array('$set'=> array(
    "Firstname" => $fname,
    "Lastname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
));

//insert into mongoDB user collection
$update=$myCollection->updateOne(['_id' => new \mongoDB\BSON\ObjectID($hidden_id)], $data);
if($update)
{
    header('Location:../profile.php'); 
}
else
{
    ?>
     <center>
        <h4 style='color:red'>Update Failed</h4>
    </center>
    <center>
        <a href="../edit-profile.php?id=<?php echo $hidden_id; ?>">Try Again</a>
    </center>

    <?php
}
?>