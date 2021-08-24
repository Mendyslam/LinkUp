<div style="min-height: 400px; width: 100%; background-color:white;">

    <div style="padding: 20px;">

    <?php

    $user_class = new User();

    $image_class = new Image();

    $post_class = new Post();

    $followers = $post_class->getLikes($user_data['userid'], "user");

    if(is_array($followers)) {

        foreach($followers as $follower) {

            $friend = $user_class->get_user($follower['userid']);

           include("user.php");

        }

    }else {

        echo "No followers were found!";
        
    }


    ?>
    </div>
</div>