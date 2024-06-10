<?php

namespace App\Views\Components\Department;

use App\Views\BaseView;
use App\Model\Department;


class ListDepartment extends BaseView
{
    public static function render()
    {
        
        $department = new Department();
        
        
        $departments = $department->getAll();

        
        echo '<div style="text-align: center; margin-top: 20px; width:100%; background-color: #A3DAF0;">';
        echo '<h1 style="color: green; padding: 10px; display: inline-block;">Department List</h1>';
        echo '</div>';

        
        echo '<table style="border-collapse: collapse; width: 50%; height:100%; margin:auto; padding:auto;">';
        echo '<tr><th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Department ID</th><th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Department Name</th><th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Status </th></tr>';

        foreach ($departments as $dpt) {
            echo '<tr>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $dpt['id'] . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $dpt['name'] . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $dpt['status'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
    public static function handle(){
        
    }
}
