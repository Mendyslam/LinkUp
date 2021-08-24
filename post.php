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
                    echo htmlspecialchars($one_user['first_name']) . " " . htmlspecialchars($one_user['last_name']);

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
            <?php echo htmlspecialchars($row['post']);?>
            <br /><br />

            <?php
                if(file_exists($row['image'])) {
                    $post_image = $image_class->get_thumb_posts($row['image']);
                    echo "<img src='$post_image' style='width:100%'/>";
                }
            ?>

            <br /><br />
            <?php
                $likes = "";

                $likes = $row['likes'] > 0 ? "(".$row['likes'].")" : "" ;
            ?>
            <a href="like.php?type=post&id=<?php echo $row['postid']; ?>">Like<?php echo $likes; ?></a> . <a href="">comment</a> . <span style="color:#999;"><?php echo htmlspecialchars($row['date']);?></span>
            <span style="color:#999;float:right;">
                <?php
                    $myPost = new Post();
                    if($myPost->myPosts($row['postid'], $_SESSION['linkup_userid'])) {
                        echo "<a href='edit.php?postid=$row[postid]'>Edit</a> . <a href='delete.php?postid=$row[postid]'>Delete</a>";
                    }
               ?>
            </span>
            <?php

                $iLiked = false;

                if(isset($_SESSION['linkup_userid'])) {

                    $DB = new Database();
                    
                //Show who liked the post
                    $sql = "SELECT likes FROM likes WHERE `type` ='post' && contentid='$row[postid]' LIMIT 1";
                    
                    $result = $DB->select($sql);

                    if (is_array($result)) {
                        //Convert to an array
                        $likes = json_decode($result[0]['likes'], true);
                        //extract userids
                        $userIds = array_column($likes, 'userid');

                        if (in_array($_SESSION['linkup_userid'], $userIds)) {
                            $iLiked = true;
                        }
                    }

                }


                if($row['likes'] > 0 ) {

                    echo "<br>";

                    echo "<a href='peoplewholiked.php?type=post&postid=$row[postid]'>";

                    if($row['likes'] == 1) {

                        if($iLiked) {

                            echo "<span style='text-align:left;'> You liked this post </span>";

                        } else {

                            echo "<span style='text-align:left;'> 1 person liked this post </span>";

                        }

                    } else {

                        if($iLiked) {

                            $text = "people";

                            if(($row['likes'] - 1) == 1) {

                                $text = "person";

                            }
                            
                            echo "<span style='text-align:left;'> You and " . ($row['likes'] - 1) . " $text liked this post </span>";

                        } else {

                            echo "<span style='text-align:left;'> You and " . $row['likes'] . " {$text} liked this post </span>";

                        }
                        
                    }

                    echo "</a>";
                }
            ?>
        </div>
    </div>