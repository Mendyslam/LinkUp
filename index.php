<?php
require('classes/classes.php');

//Check login
$login = new Login();

$user_data = $login->check_login($_SESSION['linkup_userid']);

$USER = $user_data;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline | LinkUp</title>
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
</head>
<body style="font-family:tahoma; background-color: #d0d8e4;">
<!-- Profile Bar -->
    <br />
    <?php include('header.php'); ?>
    <!-- Profile Picture Section -->
    <div style="width:1000px;margin:auto;min-height:400px;">
            <!-- Friends and post area -->
            <div style="display:flex;">
            <!-- Friends -->
                <div style="flex:1;min-height:400px;">
                    <div id="friends_area">
                        <img src="<?php echo $image_class->get_thumb_profile($user_data['profile_image']); ?>" alt="" id="profile_pic" style="border-radius:50%"><br />
                        <a href="profile.php" style="text-decoration:none;"><?php echo $user_data['first_name']." ".$user_data['last_name'];?></a>
                    </div>
                </div>
                <!-- Post area -->
                <div style="flex:2.5;min-height:400px;padding: 20px;padding-right: 0px;">
                    <div style="border: none; paddding: 10px;background-color:white;">
                        <textarea placeholder="Whats on your mind?"></textarea><br />
                        <input type="submit" id="post" value="post"><br />
                        <br />
                    </div>
                    <!-- Post views -->
                    <div id="post_area">
                        <!-- Post 1 -->
                        <div id="posts">
                            <div>
                                <img src="link_up_images/user1.jpg" style="width:75px;margin-right: 5px;" alt="">
                            </div>
                            <div>
                                <div style="font-weight:bold;color:#405d9b">First Guy</div>
                                this is simply a dummy test for the html structure of this page this is simply a dummy test for the html structure of this page this is simply a dummy test for the html structure of this page
                                this is simply a dummy test for the html structure of this page
                                this is simply a dummy test for the html structure of this page
                                <br /><br />
                                <a href="">Like</a> . <a href="">comment</a> . <span style="color:#999;">July 23 2021</span>
                            </div>
                        </div>
                        <!-- Post 2 -->
                        <div id="posts">
                            <div>
                                <img src="link_up_images/user2.jpg" style="width:75px;margin-right: 5px;" alt="">
                            </div>
                            <div>
                                <div style="font-weight:bold;color:#405d9b">First Guy</div>
                                this is simply a dummy test for the html structure of this page this is simply a dummy test for the html structure of this page this is simply a dummy test for the html structure of this page
                                this is simply a dummy test for the html structure of this page
                                this is simply a dummy test for the html structure of this page
                                <br /><br />
                                <a href="">Like</a> . <a href="">comment</a> . <span style="color:#999;">July 23 2021</span>
                            </div>
                        </div>
                        <div id="posts">
                            <div>
                                <img src="link_up_images/user3.jpg" style="width:75px;margin-right: 5px;" alt="">
                            </div>
                            <div>
                                <div style="font-weight:bold;color:#405d9b">First Guy</div>
                                this is simply a dummy test for the html structure of this page this is simply a dummy test for the html structure of this page this is simply a dummy test for the html structure of this page
                                this is simply a dummy test for the html structure of this page
                                this is simply a dummy test for the html structure of this page
                                <br /><br />
                                <a href="">Like</a> . <a href="">comment</a> . <span style="color:#999;">July 23 2021</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
    </div>
</body>
</html>