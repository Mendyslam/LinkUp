<!-- Post 1 -->
    <div id="posts">
        <div>
            <?php
                $images = "link_up_images/female_placeholder.png";
                if($one_user['gender'] == 'Male') {
                    $images = "link_up_images/male_placeholder.png";
                }
                if(file_exists($one_user['profile_image'])) {
                    $images = $image_class->get_thumb_profile($one_user['profile_image']);
                }
            ?>
            <img src="<?php echo $images; ?>" style="width:75px;margin-right: 5px;border-radius:50%;" alt="">
        </div>
        <div style="width:100%">
            <div style="font-weight:bold;color:#405d9b;">
                <?php
                    echo $one_user['first_name']." ".$one_user['last_name'];

                    if($row['is_profile_image']) {
                        $gender = "his";
                        if($one_user['gender'] == 'Female') {
                            $gender = 'her';
                        }
                        echo "<span style='font-weight:normal;color:#aaa;'> Updated $gender profile image</span>";
                    }

                    if($row['is_cover_image']) {
                        $gender = "his";
                        if($one_user['gender'] == 'Female') {
                            $gender = 'her';
                        }
                        echo "<span style='font-weight:normal;color:#aaa;'> Updated $gender cover image</span>";
                    }

                ?>
            </div>
            <?php echo $row['post'];?>
            <br /><br />

            <?php
                if(file_exists($row['image'])) {
                    $post_image = $image_class->get_thumb_posts($row['image']);
                    echo "<img src='$post_image' style='width:100%'/>";
                }
            ?>

            <br /><br />
            <a href="">Like</a> . <a href="">comment</a> . <span style="color:#999;"><?php echo $row['date'];?></span>
            <span style="color:#999;float:right;">
                Edit . Delete
            </span>
        </div>
    </div>