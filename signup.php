<?php
require('classes/classes.php');

$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if($_SERVER['REQUEST_METHOD']=='POST') {

    $signup = new Signup();
    $result = $signup->evaluate($_POST);

    if($result != "") {
        echo "<div style='text-align:center;font-size:14px;background-color:grey;color:white;'>";
        echo $result;
        echo "</div>";
    }
    else {
        header("Location:login.php");
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp | SignUp</title>
</head>
<style>
    #bar {
        height:100px;
        background-color: #166FE5;
        color:#FFFFFF;
        padding: 10px;
    }
    #signup_button {
        background-color: #42b72a;
        width: 80px;
        height: 25px;
        text-align: center;
        padding: 5px;
        float: right;
        border-radius: 5px;
    }
    #bar2 {
        background-color: white;
        /* height:300px; */
        width:800px;
        margin:auto;
        margin-top: 70px;
        text-align: center;
        padding: 10px;
        padding-top: 40px;
        border-radius: 4px;
        font-weight: bold;
    }
    .text {
        height: 30px;
        width: 300px;
        border-radius: 5px;
        border: solid 1px #ccc;
        padding: 5px;
        font-size: 15px;
    }
    #button {
        width: 310px;
        height: 40px;
        border-radius: 5px;
        border: solid 1px #ccc;
        background-color: #166FE5;
        color: white;
        font-weight: bold;
    }
    #select {
        width: 312px;
        height: 40px;
        border-radius: 5px;
    }
</style>
<body style="font-family:tahoma;background-color:#e9ebee">
    <div id="bar">
        <div style="font-size:40px;">LinkUp</div>
        <a href="login.php" style="color:white;text-decoration:none;"><div id="signup_button">Log In</div></a>
    </div>
    <div id="bar2">
        Sign Up to LinkUp<br /><br />
        <form action="" method="post">
            <input value="<?php echo $first_name; ?>" name="first_name" type="text" class="text" placeholder="First Name"><br /><br />
            <input value="<?php echo $last_name; ?>" name="last_name" type="text" class="text" placeholder="Last Name"><br /><br />
            <span style="font-weight:normal;">Gender:</span><br />
            <select class="text" id="select" name="gender">
                <option><?php echo $gender; ?></option>
                <option>Male</option>
                <option>Female</option>
            </select><br /><br />
            <input value="<?php echo $email; ?>" name="email" type="text" class="text" placeholder="Email"><br /><br />
            <input name="password" type="password" class="text" Placeholder="Password"><br /><br />
            <input name="confirmpassword" type="password" class="text" Placeholder="Retype Password"><br /><br />
            <input type="submit" id="button" value="Sign Up"><br /><br />
        </form>
    </div>
</body>
</html>