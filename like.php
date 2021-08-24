<?php
require('classes/classes.php');
$login = new Login();
$user_data = $login->check_login($_SESSION['linkup_userid']);

if(isset($_SERVER['HTTP_REFERER'])) {
    $return_to = $_SERVER['HTTP_REFERER'];
} else {
    $return_to = "Profile.php";
}

if(isset($_GET['type']) && isset($_GET['id'])) {

    if(is_numeric($_GET['id'])) {
        //permitted features to like

        $permitted_features = array('post','user','comment');

        if(in_array($_GET['type'], $permitted_features)) {

            $post = new Post();

            $user_class = new User();
            
            $post->likePost($_GET['id'], $_GET['type'], $_SESSION['linkup_userid']);

            if($_GET['type'] == "user") {
                $user_class->followUser($_GET['id'], $_GET['type'], $_SESSION['linkup_userid']);
            }
        }
    }
}

header("Location: ". $return_to);
die;