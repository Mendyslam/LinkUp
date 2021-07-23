<?php

class Database {
    private $servername = "localhost";
    private $username = "Practice";
    private $password = "@Mysqlphp";
    private $dbname = "linkup_db";

    //Connect to the database
    function connect() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        return $conn;
    }

    //Read from the database
    function select($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if($result) {
            $data = false;
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        return $data;
    }

    //Insert into the database
    function insert($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if(!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    //Update into the database
    function update($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if(!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>