<?php
$corner_image = "link_up_images/female-placeholder.png";
if(isset($USER)) {
    //Check if profile picture exists
    if(file_exists($USER['profile_image'])) {
        $image_class = new Image();
        $corner_image = $image_class->get_thumb_profile($USER['profile_image']);
    } else {
        if($USER['gender'] == "Male") {
            $corner_image = "link_up_images/male_placeholder.png";
        }
    }
}
?>

<div id="profile_bar">
        <div style="width:1000px;margin:auto;font-size:30px;">
            <a href="index.php" style="color:white;text-decoration:none;">LinkUp</a> 
            &nbsp &nbsp &nbsp &nbsp &nbsp<input type="text" id="search" placeholder="Search for people">
            <a href="profile.php"><img src="<?php echo $corner_image; ?>" alt="" style="width:50px;float:right;"></a>
            <a href="logout.php" style="color:white"><span style="font-size:15px; float:right;margin:10px;">Logout</span></a>
        </div>
</div>