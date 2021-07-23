<?php 
require('classes/classes.php');

//Check login
$login = new Login();
$user_data = $login->check_login($_SESSION['linkup_userid']);

if(isset($_GET['userid'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['userid']);

    if(is_array($profile_data)) {
    $user_data = $profile_data[0];
    }
}
//For Posting
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = new Post();
    $userid = $_SESSION['linkup_userid'];
    $result = $post->create_post($userid, $_POST, $_FILES);
    if($result == "") {
        header('Location: profile.php');
        die;
    } else {
        echo "<div style='text-align:center;font-size:14px;background-color:grey;color:white;'>";
        echo $result;
        echo "</div>";
    }
}

//Display Post
$post = new Post();
$userid = $user_data['userid'];
$posts = $post->get_posts($userid);

//Get Friends
$user = new User();
$friends = $user->get_friends($userid);

$image_class = new Image();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | LinkUp</title>
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
        margin-top: -200px;
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
        background-color: white;
        min-height: 400px;
        margin-top: 20px;
        color: #aaa;
        padding: 8px;
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
            <div style="background-color:white;text-align:center;color:#405d9b">
                <?php
                    $cover_image = "link_up_images/mountain.jpg";
                    if(file_exists($user_data['cover_image'])) {
                        $cover_image = $image_class->get_thumb_cover($user_data['cover_image']);
                    }
                ?>
                <img src="<?php echo $cover_image; ?>" alt="" style=width:100%><br />
                <span style="font-size:11px;">
                    <?php
                        $image = "link_up_images/female-placeholder.png";
                        if($user_data['gender'] == "Male") {
                            $image = "link_up_images/male_placeholder.png";
                        }
                        if(file_exists($user_data['profile_image'])) {
                            $image = $image_class->get_thumb_profile($user_data['profile_image']);
                        }
                    ?>
                    <img src="<?php echo $image; ?>" alt="" id="profile_pic"><br />
                    <a href="change_image.php?change=profile" style="text-decoration:none;color:#f0f;">Change Profile Image</a> |
                    <a href="change_image.php?change=cover" style="text-decoration:none;color:#f0f;">Change Cover Image</a>
                </span>
                <br />
                <div style="font-size:20px;text-align:center;"><?php echo $user_data['first_name']. " " . $user_data['last_name']; ?></div>
                <br />
                <a href="index.php"><button class='menus'>Timeline</button></a>
                <button class='menus'>About</button>
                <button class='menus'>Friends</button>
                <button class='menus'>Photos</button>
                <button class='menus'>Settings</button>
            </div>
            <!-- Friends and post area -->
            <div style="display:flex;">
            <!-- Friends -->
                <div style="flex:1;min-height:400px;">
                    <div id="friends_area">
                        Friends<br />
                        <?php
                            if($friends) {
                                foreach($friends as $friend) {
                                    // print_r($row)."<br>";
                                    // print_r($one_user);

                                    include("user.php");
                                }
                            }
                            
                        ?>
                    </div>
                </div>
                <!-- Post area -->
                <div style="flex:2.5;min-height:400px;padding: 20px;padding-right: 0px;">
                    <div style="border: none; paddding: 10px;background-color:white;">
                    
                        <form action="" method='post' enctype="multipart/form-data">
                            <textarea name="post" placeholder="Whats on your mind?"></textarea><br />
                            <input type="file" name="file">
                            <input type="submit" id="post" value="post"><br />
                        <br />
                        </form>
                    </div>
                    <!-- Post views -->
                    <div id="post_area">
                        <?php
                            if($posts) {
                                foreach($posts as $row) {
                                    // print_r($row)."<br>";
                                    $user = new User();
                                    $one_user = $user->get_user($row['userid']);
                                    // print_r($one_user);

                                    include("post.php");
                                }
                            }
                            
                        ?>
                        
                    </div>
                </div>
            </div>
    </div>
</body>
</html>