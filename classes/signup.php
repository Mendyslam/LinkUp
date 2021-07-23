<?php
class Signup {
    private $error = "";

    public function evaluate($data) {
        
        foreach($data as $key => $value) {
            
            if(empty($value)) {
                $this->error = $this->error . $key . " is empty! <br>";
            }

            if($key == "email") {
                if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->error = $this->error .  "Invalid email address is empty! <br>";
                }
            }
            if($key == "last_name") {
                if(is_numeric($value)) {
                    $this->error = $this->error .  "Last name can not be a number <br>";
                }
                if(strstr($value, " ")) {
                    $this->error = $this->error .  "Last name can not have spaces <br>";
                }

            }
            if($key == "first_name") {
                if(is_numeric($value)) {
                    $this->error = $this->error .  "First name can not be a number <br>";
                }
                if(strstr($value, " ")) {
                    $this->error = $this->error .  "First name can not have spaces <br>";
                }
            }
            
        }

        if($this->error == "") {
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }

    public function create_user($data) {
        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $pass_word = $data['password'];

        //Create a function for these
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();
        $sql = "INSERT INTO users 
        (userid, first_name, last_name, gender, email, pass_word, url_address) 
        VALUES('$userid', '$first_name', '$last_name', '$gender', '$email', '$pass_word', '$url_address')";
        $DB = new Database();
        $DB->insert($sql);
        // echo $sql;
    }

    private function create_userid() {
        $length = rand(5, 10);
        $userid = "";
        for($i=0; $i<$length; $i++) {
            $rand = rand(0, 9);
            $userid .= $rand;
        }
        return $userid;
    }
}
?>