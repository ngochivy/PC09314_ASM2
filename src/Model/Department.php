<?php

namespace App\Model;

use App\Model\Database;

class Department extends Database implements CrudInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $query = "SELECT * FROM `pc09314_departments`";
        $result = $this->query($query);
        return $result;
    }

    public function getOne(int $id)
{
    $query = "SELECT `id`, `name`, `status` FROM `pc09314_departments` WHERE `id` = ?";
    $stmt = $this->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}


    public function update(int $id, array $data)
    {
        $status = isset($data['status']) ? $data['status'] : 0;
        $name = $data['name'] ?? '';
        $query = "UPDATE `pc09314_departments` SET `name`=?, `status`=? WHERE `id`=?";
        $stmt = $this->prepare($query);
        $stmt->bind_param("sii", $name, $status, $id);
        $result = $stmt->execute();
        return $result;
    }

    public function create(array $data)
    {
        $status = isset($data['status']) ? $data['status'] : 0;
        $name = $data['name'] ?? '';
        $query = "INSERT INTO `pc09314_departments` (`name`, `status`) VALUES (?, ?)";
        $stmt = $this->prepare($query);
        $stmt->bind_param("si", $name, $status);
        $result = $stmt->execute();
        return $result;
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM `pc09314_departments` WHERE `id` = ?";
        $stmt = $this->prepare($query);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        return $result;
    }
}
