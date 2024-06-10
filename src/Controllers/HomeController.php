<?php

namespace App\Controllers;

use App\Model\Employee;
use App\Views\Components\Employee\ListEmployee;
use App\Views\Components\Header;
use App\Views\Components\Footer;


class HomeController
{
    public function index()
    {
        $employee = new Employee();
        $result = $employee->getAll();

        Header::render();
        ListEmployee::render();
        Footer::render();
    }


    public function view($id)
    {
    }
}
