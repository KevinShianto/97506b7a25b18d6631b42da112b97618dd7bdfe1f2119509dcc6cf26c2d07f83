<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "nudb";

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function __destruct()
    {
        $this->conn->close();
    }

    public function read_raw($query)
    {
        $result = $this->conn->query($query);
        return $result;
    }

    public function read($query)
    {
        $data = array();
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return $data;
    }

    public function insert($sql)
    {
        if ($this->conn->multi_query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
    }
}
