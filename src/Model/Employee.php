<?php

namespace App\Model;

use App\Model\Database;

class Employee extends Database implements CrudInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $query = "SELECT * FROM `pc09314_employees`";
        $result = $this->query($query);
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        return $employees;
    }

    public function getOne(int $id)
    {
        $query = "SELECT * FROM `pc09314_employees` WHERE `id` = $id";
        $result = $this->query($query);
        return $result->fetch_assoc();
    }

    public function update(int $id, array $data)
    {
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $department_id = $data['department_id'];

        $query = "UPDATE `pc09314_employees` 
                  SET `firstname`='$firstname', `lastname`='$lastname', `department_id`='$department_id' 
                  WHERE `id` = $id";
        return $this->query($query);
    }

    public function create(array $data)
    {
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $code = $data['code'];
        $department_id = $data['department_id'];

        $query = "INSERT INTO `pc09314_employees` (`firstname`, `lastname`,`code`, `department_id`) 
                  VALUES ('$firstname', '$lastname', '$code','$department_id')";
        return $this->query($query);
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM `pc09314_employees` WHERE `id` = $id";
        return $this->query($query);
    }
}
