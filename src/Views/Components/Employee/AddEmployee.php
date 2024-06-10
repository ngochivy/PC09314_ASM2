<?php

namespace App\Views\Components\Employee;

use App\Views\BaseView;
use App\Model\Employee;

class AddEmployee extends BaseView
{
    public static function render()
    {
        ob_start();
        ?>
        <div style="text-align: center; margin-top: -119px; width:100%; background-color: #A3DAF0;">
            <h1 style="color: green; padding: 10px; display: inline-block;">Register Employee</h1>
        </div>

        <div style="text-align: center; margin-top: 0px;">
            <form method="POST" action="" style="width: 600px; margin: 0 auto;">
                <table style="width: 100%; margin: 0 auto; border-collapse: collapse; max-width: 600px;">
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;"><label for="firstname">First Name:</label></td>
                        <td style="padding: 8px; border: 1px solid #ccc;"><input type="text" id="firstname" name="firstname" required style="width: 100%; "></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;"><label for="lastname">Last Name:</label></td>
                        <td style="padding: 8px; border: 1px solid #ccc;"><input type="text" id="lastname" name="lastname" required style="width: 100%; "></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;"><label for="department_id">Code:</label></td>
                        <td style="padding: 8px; border: 1px solid #ccc;"><input type="text" id="code" name="code" required style="width: 100%; "></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;"><label for="code">Department ID:</label></td>
                        <td style="padding: 8px; border: 1px solid #ccc;">
                            <select id="department_id" name="department_id" required style="width: 100%;">
                                <option value="">----Choose----</option>
                                <option value="1">1 - Human Resources</option>
                                <option value="2">2 - Finance</option>
                                <option value="3">3 - Information Technology</option>
                                <option value="4">4 - Marketing</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 8px; border: 1px solid #ccc;"><button type="submit" style="width: 40%; background-color: #4682B4; color: white; padding: 14px 20px; border: none; border-radius: 4px; cursor: pointer;">Register Employee</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
         
    }

    public static function handle()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $code = $_POST['code'];
            $department_id = $_POST['department_id'];

            
            $employee = new Employee();
            $employee->create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'code' => $code,
                'department_id' => $department_id,
            ]);

            header("Location: index.php?act=listemployee");
            exit();
        }
        ob_end_flush();
    }
}
