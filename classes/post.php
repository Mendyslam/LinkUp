<?php
class Post {
    private $error = "";

    public function create_post($userid, $data, $files) {

        if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image'])) {

            $myImage = "";
            $has_image = 0;
            $is_cover_image = 0;
            $is_profile_image = 0;

            if(isset($data['is_profile_image']) || isset($data['is_cover_image'])) {
                $myImage = $files;
                $has_image = 1;

                //check if profile image is set
                if(isset($data['is_profile_image'])) {
                    $is_profile_image = 1;
                }

                //check if cover image is set
                if(isset($data['is_cover_image'])) {
                    $is_cover_image = 1;
                }

            } else {
                if (!empty($files['file']['name'])) {
                    $folder = "uploads/" . $userid . "/";

                    //create folder
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    //create a new class
                    $image_class = new Image();

                    $myImage = $folder . $image_class->generateFileName(10);
                    move_uploaded_file($_FILES['file']['tmp_name'], $myImage);

                    $image_class->resizeImage($myImage, $myImage, 1500, 1500);

                    $has_image = 1;
                }
            }

            $post = "";
            if(isset($data['post'])) {

                $post = addslashes($data['post']);

            }
            
            $postid = $this->create_postid();
            $sql = "INSERT INTO posts (userid,postid,post,image,has_image,is_profile_image,is_cover_image) VALUES('$userid','$postid','$post','$myImage','$has_image','$is_profile_image','$is_cover_image')";

            $DB = new Database();
            $DB->insert($sql);
        }else {
            $this->error .= "Please Create a post!<br>";
        }
        return $this->error;
    }

    public function create_postid() {
        $length = rand(5, 10);
        $userid = "";
        for($i=0; $i<$length; $i++) {
            $rand = rand(0, 9);
            $userid .= $rand;
        }
        return $userid;
    }

    public function get_posts($userid) {
        $sql = "SELECT * FROM posts WHERE userid = '$userid' ORDER BY id DESC";
        $DB = new Database();
        $result = $DB->select($sql);
        if($result) {
            return $result;
        } else {
            return false;
        }
    }
}
?>