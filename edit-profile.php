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
    <head><title>Sign Up</title></head>
    <body>
        <form action="actions/edit-profile.php" method="POST">
            <input type="text" value="<?php echo $fetch['Firstname']; ?>" name="fname" id="fname" required=""/><br/><br/>
            <input type="text" value="<?php echo $fetch['Lastname']; ?>" name="lname" id="lname" required=""/><br/><br/>
            <input type="email" value="<?php echo $fetch['Email']; ?>" name="email" id="email" required=""/><br/><br/>
            <input type="text" value="<?php echo $fetch['Phone Number']; ?>" name="phoneNo" id="phoneNo" required=""/><br/><br/>
            <input type="hidden" value="<?php echo $fetch['_id']; ?>" name="hidden_id" id="hidden_id" value=""/><br/><br/>
            <input type="submit" name="update" id="update" value="Update Info" required=""/>
        </form>
        <a href="profile.php">Go To The Profile Page</a>
    </body
</html>

<?php } ?>