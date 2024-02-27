<?php

session_start();
if(!isset($_SESSION['email'])){

    header('Location:  index.php');
    exit();
}
else{

        //retrieve the mongoDB driver from vendor folder
    require_once 'vendor/autoload.php';

    //Connect to MongoDB database
    $DBConn = new MongoDB\Client;

    //Connect to specific database in MongoDB
    $myDBConn = $DBConn -> mongoPHP;

    //Connect to the specific mongoDB collection
    $myCollection = $myDBConn -> users;

    $userEmail = $_SESSION['email'];

    $data = array(
        "Email" => $userEmail,
    );

    //var_dump($data);

    //insert into mongoDB user collection
    $fetch=$myCollection->findOne($data);

    ?>

<html>
    <head><title>Sign In</title></head>
    <body>
        <table>
            <tr>
                <td>First Name:</td>
                <td><?php echo $fetch['Firstname']; ?></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><?php echo $fetch['Lastname']; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $fetch['Email']; ?></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><?php echo $fetch['Phone Number']; ?></td>
            </tr>
            <tr>
                <td><a href="edit-profile.php?id=<?php echo $fetch['_id']; ?>">Edit</a></td>
                <td><a href="logout.php">Log Out</a></td>
            </tr>
        </table>    
       
    </body
</html>

<?php  } ?>