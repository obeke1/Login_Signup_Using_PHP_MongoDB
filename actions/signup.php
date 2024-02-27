<?php

//retrieve the mongoDB driver from vendor folder
require_once '../vendor/autoload.php';

//Connect to MongoDB database
$DBConn = new MongoDB\Client;

//Connect to specific database in MongoDB
$myDBConn = $DBConn -> mongoPHP;

//Connect to the specific mongoDB collection
$myCollection = $myDBConn -> users;

/*if($myCollection){
    echo "collection" .$myCollection. "Connected";
}
else{
    echo "Failed to connect to database/collection";
}
*/

if(isset($_POST['SignUp'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = md5($_POST['password']);
}

$data = array(
    "Firstname" => $fname,
    "Lastname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
    "Password" => $password
);

//var_dump($data);

//insert into mongoDB user collection
$insert=$myCollection->insertOne($data);
if($insert)
{
    ?>
    <center>
        <h4 style='color:green'>Successfully registered</h4>
    </center>
    <center>
        <a href='../index.php'>Login</a>
    </center>
    <?php
}
else
{
    ?>
     <center>
        <h4 style='color:red'>Registration Failed</h4>
    </center>
    <center>
        <a href='../signup.php'>Login</a>
    </center>

    <?php
}
?>