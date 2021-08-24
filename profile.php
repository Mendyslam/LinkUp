<?php 
require('classes/classes.php');

//Check login
$login = new Login();
$user_data = $login->check_login($_SESSION['linkup_userid']);

$USER = $user_data;

if(isset($_GET['userid'])  && is_numeric($_GET['userid'])) {
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
        min-width: 50px;
        cursor: pointer;
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
                <img src="<?php echo $cover_image; ?>" alt="" style=width:100%><br /><br />

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
                    <div style="font-size:20px;text-align:center;"><a href="profile.php?id=<?php echo $user_data['userid']?>" style='text-decoration:none;'><?php echo $user_data['first_name']. " " . $user_data['last_name']; ?><br /></a>
                            
                        <?php
                            $mylikes = "";

                            if($user_data['likes'] > 0) {

                                $mylikes = " (" . $user_data['likes'] . "Followers)";

                            }
                        ?>
                        
                        <a href="like.php?type=user&id=<?php echo $user_data['userid']?>">
                        
                            <input type="button" id="post" value="Follow<?php echo $mylikes; ?>" style="background-color:#9b409a;width:auto;">
                        
                        </a>

                    </div>
                <br />
                <a href="index.php"><button class='menus'>Timeline</button></a>
                <a href="profile.php?section=about&id=<?php echo $user_data['userid']?>"><button class='menus'>About</button></a>
                <a href="profile.php?section=followers&id=<?php echo $user_data['userid']?>"><button class='menus'>Followers</button></a>
                <a href="profile.php?section=following&id=<?php echo $user_data['userid']?>"><button class='menus'>Following</button></a>
                <a href="profile.php?section=photos&id=<?php echo $user_data['userid']?>"><button class='menus'>Photos</button></a>
                <a href="profile.php?section=settings"><button class='menus'>Settings</button></a>
            </div>
            <!-- Friends and post area -->
            <?php
                $section = "default";

                if(isset($_GET['section'])) {

                    $section = $_GET['section'];

                }

                if($section == "default") {

                    include('profile_default.php');

                }elseif($section == "photos") {

                    include('profile_photos.php');

                }elseif($section == "followers") {

                    include('profile_followers.php');

                }elseif($section == "following") {

                    include('profile_following.php');

                }
                
            ?>
            
    </div>
</body>
</html>