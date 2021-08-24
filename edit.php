<?php
require('classes/classes.php');

//Check login
$login = new Login();
$user_data = $login->check_login($_SESSION['linkup_userid']);

$Error = "";
$Post = new Post();
if(isset($_GET['postid'])) {
    $row = $Post->get_one_post($_GET['postid']);
    if(!$row) {
        $Error = "No such post was found!";
    } else {
        if($row['userid'] != $_SESSION['linkup_userid']) {
            $Error = "Access denied! You can not delete this post!";
        }
    }
} else {
    $Error = "No such post was found!";
}

if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php")) {

    $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];

}

$post = new Post();
//If Post variable is set
if($_SERVER['REQUEST_METHOD'] == "POST") {

    $result = $post->edit_post($_POST, $_FILES);

    header('Location: ' . $_SESSION['return_to']);

    die;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete | LinkUp</title>
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

                        <form method="POST" enctype="multipart/form-data">
                                <?php

                                    $image_class = new Image();

                                    if($Error != "") {
                                        echo "<h3 style='text-align:center;'>$Error</h3>";
                                        die;
                                    } else {
                                        echo "<h4 style='font-weight:normal;padding-left:10px;text-align:center;'>Edit Post</h4>";
                                        
                                        echo '<textarea name="post" placeholder="Whats on your mind?">' . $row['post'] . '</textarea><br />
                                                <input type="file" name="file">';

                                                if(file_exists($row['image'])) {

                                                    $post_image = $image_class->get_thumb_posts($row['image']);
        
                                                    echo "<div style='text-align:center;'><img src='$post_image' style='width:50%'/></div>";
                                                }

                                        echo "<input type='hidden' name='postid' value='$row[postid]'>";
                                        echo "<input type='submit' name='edit' value='Save' style='margin-top:-50px;margin-left:1000px;margin-bottom:5px;background-color:#405d9b;border-radius:3px;padding:5px;border:none;color:white;margin-right: 5px;'>";                                      
                                        
                                    }
                                ?>
                                
                        </form>
                    </div>
                    <!-- Post views -->
                </div>
            </div>
    </div>
</body>
</html>