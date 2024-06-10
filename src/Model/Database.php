<?php

namespace App\Model;

use mysqli;
use mysqli_stmt;

class Database
{
    private $_connection;

    public function __construct()
    {
        $server = "localhost";
        $db_username = "root";
        $db_password = "mysql";
        $database = "php1_wd19303";

        $this->_connection = new mysqli(
            $server,
            $db_username,
            $db_password,
            $database
        );

        if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->_connection->connect_error);
        }
    }

    public function query(string $query)
    {
        return $this->_connection->query($query);
    }

    public function prepare(string $query)
    {
        return $this->_connection->prepare($query);
    }

    public function close()
    {
        $this->_connection->close();
    }

    public function safeQuery(string $query, array $params = [])
    {
        $stmt = $this->_connection->prepare($query);

        if (!$stmt) {
            throw new \Exception("Query preparation failed: " . $this->_connection->error);
        }

        if (!empty($params)) {
            $types = "";
            $values = [];

            foreach ($params as $param) {
                $types .= $param['type'];
                $values[] = &$param['value'];
            }

            $bind_params = array_merge([$types], $values);

            if (!call_user_func_array([$stmt, 'bind_param'], $bind_params)) {
                throw new \Exception("Parameter binding failed: " . $stmt->error);
            }
        }

        if (!$stmt->execute()) {
            throw new \Exception("Query execution failed: " . $stmt->error);
        }

        return $stmt;
    }
}

