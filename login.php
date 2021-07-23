<?php
require('classes/classes.php');

$email = "";
$password = "";

if($_SERVER['REQUEST_METHOD']=='POST') {

    $login = new Login();
    $result = $login->evaluate($_POST);

    if($result != "") {
        echo "<div style='text-align:center;font-size:14px;background-color:grey;color:white;'>";
        echo $result;
        echo "</div>";
    }
    else {
        header("Location:profile.php");
        die;
    }
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    
    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp | LogIn</title>
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
        height:300px;
        width:800px;
        margin:auto;
        margin-top: 100px;
        text-align: center;
        padding: 10px;
        padding-top: 80px;
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
</style>
<body style="font-family:tahoma;background-color:#e9ebee">
    <div id="bar">
        <div style="font-size:40px;">LinkUp</div>
        <div id="signup_button">SignUp</div>
    </div>
    <div id="bar2">
        Log in to LinkUp<br /><br />
        <form action="" method="post">
            <input value="<?php echo $email; ?>" name="email" type="text" class="text" placeholder="Email"><br /><br />
            <input value="<?php echo $password; ?>" name="password" type="password" class="text" Placeholder="Password"><br /><br />
            <input type="submit" id="button" value="Log in"><br /><br />
        </form>
    </div>
</body>
</html>