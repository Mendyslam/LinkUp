<?php

class Profile {
    public function get_profile($userid) {
        $DB = new Database();
        $query = "SELECT * FROM users WHERE userid = '$userid' LIMIT 1";
        return $DB->select($query);
    }
}