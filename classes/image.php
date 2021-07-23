<?php

class Image {

    public function generateFileName($length) {

        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        //initializing filename to be generated to zero
        $text = "";

        for($i=0; $i<$length; $i++) {

            $randomNumber = rand(0, 61);
            //select from array
            $text .= $array[$randomNumber];
        }

        return $text;

    }

    public function cropImage($original_file_name, $cropped_file_name, $maxWidth, $maxHeight) {

        //Check if file exists
        if(file_exists($original_file_name)) {

            //Create and image resource
            $original = imagecreatefromjpeg($original_file_name);

            //Original width
            $original_width = imagesx($original);
            //original height
            $original_height = imagesy($original);

            if($original_height > $original_width) {
                //Make width equal to the max width
                $ratio = $maxWidth / $original_width;

                //new width
                $newWidth = $maxWidth;
                //new height
                $newHeight = $original_height * $ratio;

            } else {
                //Make height equal to the max height
                $ratio = $maxHeight / $original_height;

                //new width
                $newHeight = $maxHeight;
                //new height
                $newWidth = $original_width * $ratio;
            }

        }

        //Adjust incase max width and max height are different
        if($maxWidth != $maxHeight) {
            
            if($maxHeight > $maxWidth) {

                if($maxHeight > $newHeight) {
                    $adjusment = ($maxHeight / $newHeight);
                } else {
                    $adjusment = ($newHeight / $maxHeight);
                }
                $newWidth = $newWidth * $adjusment;
                $newHeight = $newHeight * $adjusment;

            } else {

                if($maxWidth > $newWidth) {
                    $adjusment = ($maxWidth / $newWidth);
                } else {
                    $adjusment = ($newWidth / $maxWidth);
                }
                $newHeight = $newHeight * $adjusment;
                $newWidth = $newWidth * $adjusment;
            }
        }
        $new_image = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($new_image, $original, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

        //destroy image resource
        imagedestroy($original);

        if($maxWidth != $maxHeight) {

            if($maxWidth > $maxHeight) {
                //difference between width and height
                $diff = ($newHeight - $maxHeight);
                if($diff < 0) {
                    $diff = $diff * -1;
                }
                $y = round($diff / 2);
                $x = 0;
            } else {

                $diff = ($newWidth - $maxHeight);
                if($diff < 0) {
                    $diff = $diff * -1;
                }
                $x = round($diff / 2);
                $y = 0;
            }
        } else {
            if($newHeight > $newWidth) {
                //difference between width and height
                $diff = ($newHeight - $newWidth);
                $y = round($diff / 2);
                $x = 0;
            } else {
                $diff = ($newWidth - $newHeight);
                $x = round($diff / 2);
                $y = 0;
            }
        }
        //Create a new resource
        $new_cropped_image = imagecreatetruecolor($maxWidth, $maxHeight);
        imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $maxWidth, $maxHeight, $maxWidth, $maxHeight);

        //Destroy Image
        imagedestroy($new_image);

        //To save the file
        imagejpeg($new_cropped_image, $cropped_file_name, 90);

        //Destroy Image since it has been saved
        imagedestroy($new_cropped_image);
    }


    // Function to view full image when clicked on so that other users can see the full image as well
    public function resizeImage($original_file_name, $resized_file_name, $maxWidth, $maxHeight) {

        //Check if file exists
        if(file_exists($original_file_name)) {

            //Create and image resource
            $original = imagecreatefromjpeg($original_file_name);

            //Original width
            $original_width = imagesx($original);
            //original height
            $original_height = imagesy($original);

            if($original_height > $original_width) {
                //Make width equal to the max width
                $ratio = $maxWidth / $original_width;

                //new width
                $newWidth = $maxWidth;
                //new height
                $newHeight = $original_height * $ratio;

            } else {
                //Make height equal to the max height
                $ratio = $maxHeight / $original_height;

                //new width
                $newHeight = $maxHeight;
                //new height
                $newWidth = $original_width * $ratio;
            }

        }

        //Adjust incase max width and max height are different
        if($maxWidth != $maxHeight) {
            
            if($maxHeight > $maxWidth) {

                if($maxHeight > $newHeight) {
                    $adjusment = ($maxHeight / $newHeight);
                } else {
                    $adjusment = ($newHeight / $maxHeight);
                }
                $newWidth = $newWidth * $adjusment;
                $newHeight = $newHeight * $adjusment;

            } else {

                if($maxWidth > $newWidth) {
                    $adjusment = ($maxWidth / $newWidth);
                } else {
                    $adjusment = ($newWidth / $maxWidth);
                }
                $newHeight = $newHeight * $adjusment;
                $newWidth = $newWidth * $adjusment;
            }
        }
        $new_image = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($new_image, $original, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);

        //destroy image resource
        imagedestroy($original);

        //To save the file
        imagejpeg($new_image, $resized_file_name, 90);

        //Destroy Image since it has been saved
        imagedestroy($new_image);
    }


    //Create thumbnails for cover image
    public function get_thumb_cover($filename) {
        $thumbnail = $filename . "_cover_thumb.jpg";
        if(file_exists($thumbnail)) {
            return $thumbnail;
        }
        $this->cropImage($filename, $thumbnail, 1366, 488);

        if(file_exists($thumbnail)) {
            return $thumbnail;
        } else {
            return $filename;
        }
    }

    //Create thumbnails for Profile image
    public function get_thumb_profile($filename) {
        $thumbnail = $filename . "_profile_thumb.jpg";
        if(file_exists($thumbnail)) {
            return $thumbnail;
        }
        $this->cropImage($filename, $thumbnail, 600, 600);

        if(file_exists($thumbnail)) {
            return $thumbnail;
        } else {
            return $filename;
        }
    }

    //Create thumbnails for post images
    public function get_thumb_posts($filename) {
        $thumbnail = $filename . "_post_thumb.jpg";
        if(file_exists($thumbnail)) {
            return $thumbnail;
        }
        $this->cropImage($filename, $thumbnail, 600, 600);

        if(file_exists($thumbnail)) {
            return $thumbnail;
        } else {
            return $filename;
        }
    }
}