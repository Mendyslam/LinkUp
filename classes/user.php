<?php

class User {
    public function get_data($userid) {

        $sql = "SELECT * FROM users WHERE userid = '$userid'";
        $DB = new Database();
        $result = $DB->select($sql);
        if($result) {
            $row = $result[0];
            return $row;
        } else {
            return false;
        }
    }

    public function get_user($userid) {
        $sql = "SELECT * FROM users WHERE userid = '$userid' limit 1";
        $DB = new Database();
        $result = $DB->select($sql);

        if($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function get_friends($userid) {
        $sql = "SELECT * FROM users WHERE userid != '$userid'";
        $DB = new Database();
        $result = $DB->select($sql);

        if($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function followUser($id, $type, $loggedinUser) {
        
        $DB = new Database();

        //Save likes informations and details
        $sql = "SELECT `following` FROM likes WHERE `type` ='$type' && contentid='$loggedinUser' LIMIT 1";
        $result = $DB->select($sql);

        if(is_array($result)) {
            //Convert to an array
            $likes = json_decode($result[0]['following'], true);
            //extract userids
            $userIds = array_column($following, 'userid');

            if(!in_array($loggedinUser, $userIds)) {

                $userInfo['userid'] = $id;
                $userInfo['date'] = date("Y-m-d H:i:s");

                $following[] = $userInfo;

                $following = json_encode($following);
                $sql = "UPDATE likes SET `following`='$following' WHERE `type`='$type' && contentid='$loggedinUser' LIMIT 1";
                $DB->insert($sql);


            } else {
                $key = array_search($id, $userIds);
                unset($following[$key]);
                $following = json_encode($following);
                $sql = "UPDATE likes SET `following`='$following' WHERE `type`='$type' && contentid='$loggedinUser' LIMIT 1";
                $DB->insert($sql);
            }
            
        } else {
            $userInfo['userid'] = $id;
            $userInfo['date'] = date("Y-m-d H:i:s");

            $userInfoCombined[] = $userInfo; 
            $following = json_encode($userInfoCombined);
            $sql = "INSERT INTO likes(`type`, contentid, `following`) VALUES('$type', '$loggedinUser', '$following')";
            $DB->insert($sql);
            
        }
    }

    public function getFollowing($id, $type) {

        $DB = new Database();

        if (is_numeric($id)) {
            
            //Save following informations and details
            $sql = "SELECT `following` FROM likes WHERE `type` ='$type' && contentid='$id' LIMIT 1";

            $result = $DB->select($sql);

            if (is_array($result)) {
                //Convert to an array
                $following = json_decode($result[0]['following'], true);
                return $following;
            }
        }

        return false;
    }
}