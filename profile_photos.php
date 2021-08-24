<div style="min-height: 400px; width: 100%; background-color:white;">
    <div style="padding: 20px;">
    <?php

    $DB = new Database();
    $sql = "SELECT `image`, postid FROM posts WHERE has_image = 1 && userid = $user_data[userid] ORDER BY id DESC LIMIT 30";
    $images = $DB->select($sql);

    $image_class = new Image();

    if(is_array($images)) {

        foreach($images as $image_row) {

            echo "<img src='" . $image_class->get_thumb_posts($image_row['image']) . "' style='width:33.3%;margin-top:10px;' />";

        }

    }else {
        echo "No images were found";
    }


    ?>
    </div>
</div>