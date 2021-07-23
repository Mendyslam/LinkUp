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
}