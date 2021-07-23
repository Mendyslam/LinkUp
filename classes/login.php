<?php

class Login {
    private $error = "";

    public function evaluate($data) {
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $DB = new Database();
        $result = $DB->select($sql);

        if($result) {
            $row = $result[0];
            if($password == $row['pass_word']) {
                //Create session data
                $_SESSION['linkup_userid'] = $row['userid'];
            } else {
                $this->error .= "Wrong password <br>";
            }
        }else {
            $this->error .= "No such email was found <br>";
        }
        return $this->error;
    }

    public function check_login($userid) {

        // Check if user is logged in
        if(is_numeric($userid)) {

            $sql = "SELECT * FROM users WHERE userid = '$userid' LIMIT 1";
            $DB = new Database();
            $result = $DB->select($sql);

            if($result) {
                $user_data = $result[0];
                return $user_data;
            } else {
                header('location:login.php');
                die;
            }
        } else {
            header('location:login.php');
            die;
        }
    }
}
?>