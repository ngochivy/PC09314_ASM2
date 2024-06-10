<?php

namespace App\Views\Components\Employee;

use App\Views\BaseView;
use App\Model\Employee;

class ListEmployee extends BaseView
{
    public static function render($result = null)
    {

        $employee = new Employee();

        $employees = $employee->getAll();

?>
        <div style="text-align: center; margin-top: 20px; width:100%; background-color: #A3DAF0;">
            <h1 style="color: green; padding: 10px; display: inline-block;">Employee List</h1>
        </div>

        <table style="border-collapse: collapse; width: 70%; height:100%; margin:auto; padding:auto;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">ID</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">First Name</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Last Name</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Code</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Department ID </th>
            </tr>
            <?php
            foreach ($employees as $emp) {
            ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $emp['id']; ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $emp['firstname']; ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $emp['lastname']; ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $emp['code']; ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $emp['department_id']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
<?php
    }

    public static function handle()
    {
    }
}
?>