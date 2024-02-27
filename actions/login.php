<?php

session_start();

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

if(isset($_POST['SignIn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
}

$data = array(
    "Email" => $email,
    "Password" => $password
);

//var_dump($data);

//insert into mongoDB user collection
$fetch=$myCollection->findOne($data);
if($fetch)
{
    
    //create a session
    $_SESSION['email']= $fetch['Email'];

    //redirect to the profile page
    header('Location:../profile.php');
    exit();
}
else
{
    ?>
     <center>
        <h4 style='color:red'>User Not Found</h4>
    </center>
    <center>
        <a href='../index.php'>Try Again</a>
    </center>

    <?php
}
?>