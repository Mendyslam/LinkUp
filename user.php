<div class="friends">
    <?php
        $images = "link_up_images/female-placeholder.png";
        if($friend['gender'] == "Male") {
            $images = "link_up_images/male_placeholder.png";
        }
        //Ensure each friend has His/Her own image shown
        if(file_exists($friend['profile_image'])) {
            $images = $image_class->get_thumb_profile($friend['profile_image']);
        }
    ?>
    <a href="profile.php?userid=<?php echo $friend['userid']; ?>" style="text-decoration:none;">
        <img class="friends_image"src="<?php echo $images; ?>" alt="" style="border-radius:50%;"><br />
        <?php echo $friend['first_name']." ".$friend['last_name'];?>
    </a>
</div>