<?php
require('classes/classes.php');

//Check login
$login = new Login();
$user_data = $login->check_login($_SESSION['linkup_userid']);

if($_SERVER['REQUEST_METHOD'] =="POST") {
    
    //Check a file has been uploaded
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {

        if($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/jpg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/gif") {

            $allowed_size = (1024 * 1024) * 7;
            if($_FILES['file']['size'] < $allowed_size) {
                //everything is fine
                 //Update image to the database
                 //create folder for the users images
                 $folder = "uploads/" . $user_data['userid'] . "/";

                 //create folder
                 if(!file_exists($folder)) {
                     mkdir($folder, 0777, true);
                 }

                 //create a new class
                 $img = new Image();

                 $filename = $folder . $img->generateFileName(10);
                 move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                 //Set default $_GET index
                 $change_image = "profile";

                 //Check if $_GET['change'] is set
                 if(isset($_GET['change'])) {
                     $change_image = $_GET['change'];
                 }

                
                 if($change_image == "cover") {
                     if(file_exists($user_data['cover_image'])) {
                         unlink($user_data['cover_image']);
                     }
                    $img->resizeImage($filename, $filename, 1500, 1500);
                 } else {
                    if(file_exists($user_data['profile_image'])) {
                        unlink($user_data['profile_image']);
                    }
                    $img->resizeImage($filename, $filename, 1500, 1500);
                 }

                 if(file_exists($filename)) {
                    $userid = $user_data['userid'];

                    //Check the value of change and decide the action to take
                    if($change_image == "cover") {
                        $query = "UPDATE users SET cover_image = '$filename' WHERE userid = '$userid' LIMIT 1";
                        $_POST['is_cover_image'] = 1;
                    } else {
                        $query = "UPDATE users SET profile_image = '$filename' WHERE userid = '$userid' LIMIT 1";
                        $_POST['is_profile_image'] = 1;
                    }
                    
                    $DB = new Database();
                    $DB->update($query);
                    
                    //Create a post

                    $post = new Post();
                    $result = $post->create_post($userid, $_POST, $filename);
                    //redirect user to profile
                    header('Location: profile.php');
                    die;
                }

            }else {
                echo "<div style='text-align:center;font-size:14px;background-color:grey;color:white;'>";
                echo "Images should be less than 3mb";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align:center;font-size:14px;background-color:grey;color:white;'>";
            echo "Only images of jpeg/jpg/png/gif format are allowed";
            echo "</div>";
        }      
        
    } else {
        echo "<div style='text-align:center;font-size:14px;background-color:grey;color:white;'>";
        echo "Please upload a valid image";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Image | LinkUp</title>
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
    #post {
        float: right;
        background-color: #405d9b;
        border-radius: 3px;
        width: 65px;
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
            
                <!-- Post area -->
                <div style="flex:2.5;min-height:400px;padding:20px;padding-right: 0px;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div style="border: none; paddding:10px;background-color:white;">
                            <input type="file" name="file" style="margin-top:15px;">
                            <input type="submit" id="post" value="change" style="margin-top:15px;"><br />
                            <br />
                            <div style="text-align:center;">
                            <br />
                            <?php
                                //check for the selected $_GET variable
                                if(isset($_GET['change']) && $_GET['change'] == 'cover') {
                                    $change = "cover";
                                    echo "<img src='$user_data[cover_image]' alt='' style='max-width:500px;'>";
                                }else {
                                    echo "<img src='$user_data[profile_image]' alt='' style='max-width:500px;'>";
                                }
                            ?>
                            </div>
                        </div>
                    </form>
                    <!-- Post views -->
                </div>
            </div>
    </div>
</body>
</html>