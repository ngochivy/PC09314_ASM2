<?php


// interface la ban thiet ke danh cho phuong thuc
// astract class la ban thiet ke danh cho lop

namespace App\Model;

interface CrudInterface{
    public function getAll();

    public function getOne(int $id);

    // update, create, delete;
    // can data de them
    public function update(int $id ,array $data);   

    public function create(array $data);


    /**
     * Ham nay dung de xoa
     * @param int $id
     * 
     * @return bool
    */
    public function delete(int $id): bool;
}
