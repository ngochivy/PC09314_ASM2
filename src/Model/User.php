<?php

namespace App\Model;

class User extends Database
{
    protected $table = "pc09314_users";

    public function __construct()
    {
        parent::__construct();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM $this->table WHERE `email`  = ?";

        $stmt = $this->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        // luu email
        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['user_email'] = $data['email'];
            return $data;
        } else {
            return [];
        }
    }

    public function register($name, $password, $email, $avatar)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $this->table (name, password, email, avatar) VALUES (?, ?, ?, ?)";
        $stmt = $this->prepare($sql);
        $stmt->bind_param('ssss', $name, $hashedPassword, $email, $avatar);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($email, $password)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE $this->table SET `password` = ? WHERE `email` = ?";
    $stmt = $this->prepare($sql);
    $stmt->bind_param('ss', $hashedPassword, $email);
    $stmt->execute();
}

public function updateAccount($name, $avatar, $email)
{
    $sql = "UPDATE $this->table SET name = ?, avatar = ? WHERE email = ?";
    $stmt = $this->prepare($sql);
    $stmt->bind_param('sss', $name, $avatar, $email);
    return $stmt->execute();
}






public function getUserByEmail($email)
{
    $sql = "SELECT * FROM $this->table WHERE `email` = ?";
    $stmt = $this->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


}
