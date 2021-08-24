<?php
require('classes/classes.php');

//Check login
$login = new Login();
$user_data = $login->check_login($_SESSION['linkup_userid']);

$Error = "";

$likes = false;

$Post = new Post();

if(isset($_GET['postid']) && isset($_GET['type'])) {

    $likes = $Post->getLikes($_GET['postid'], $_GET['type']);

} else {

    $Error = "No information was found!";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Who Liked | LinkUp</title>
</head>
<style>
    #profile_bar {
        /* margin-top: 15px; */
        height: 50px;
        background-color: #405d9b;
        color: #d9dfeb;
    }
    #search {
        width: 600px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 5px;
        font-size: 14px;
        background-image: url(link_up_images/search.png);
        background-repeat: no-repeat;
        background-position: right;
    }
    #profile_pic {
        width: 150px;
        border-radius: 50%;
        border: solid 2px white;
    }
    .menus {
        width: 100px;
        height: 30px;
        display: inline-block;
        background-color: #405d9b;
        color: white;
        border-radius: 3px;
        margin: 10px;
        /* margin-bottom: -20px; */
        border: none;
    }
    .friends_image {
        width: 75px;
        float: left;
        margin: 8px;
    }
    #friends_area {
        /* background-color: white; */
        min-height: 400px;
        margin-top: 20px;
        /* color: #aaa; */
        padding: 8px;
        text-align: center;
        font-size: 20px;
        color: #405d9b;
        font-weight:bold;
    }
    .friends {
        clear: both;
        font-size: 12px;
        font-weight: bold;
        color: #405d9b;
    }
    textarea {
        width: 99%;
        font-family: tahoma;
        font-size: 14px;
        border: none;
        height: 60px;
        /* padding: 5px; */
    }
    #post {
        float: right;
        background-color: #405d9b;
        border-radius: 3px;
        width: 50px;
        padding: 5px;
        border: none;
        color: white;
        font-size: 14px;
        margin-right: 5px;
    }
    #post_area {
        margin-top: 20px;
        background-color: white;
        padding: 10px;
    }
    #posts {
        padding: 5px;
        font-size: 13px;
        display: flex;
        margin-bottom: 20px;
    }

</style>
<body style="font-family:tahoma; background-color: #d0d8e4;">
<!-- Profile Bar -->
    <br />
    <?php include('header.php'); ?>
    <!-- Profile Picture Section -->
    <div style="width:1000px;margin:auto;min-height:400px;">
            <!-- Friends and post area -->
            <div style="display:flex;">
            <!-- Friends -->
                
                <!-- Post area -->
                <div style="flex:2.5;min-height:400px;padding:20px;padding-right: 0px;">
                    <div style="border:none; paddding:10px;background-color:white;">   

                        <?php

                            $User = new User();
                            $image_class = new Image();
                            
                            if(is_array($likes)) {

                                foreach($likes as $row) {
                                    
                                    $friend = $User->get_user($row['userid']);

                                    include('user.php');

                                }

                            }
                        ?>    
                        <br style="clear: both;">
                    </div>
                    <!-- Post views -->
                </div>
            </div>
    </div>
</body>
</html>