<?php

namespace App\Views\Components\Employee;

use App\Views\BaseView;
use App\Model\Employee;

class EditEmployee extends BaseView
{
    public static function render()
    {
        $employeeModel = new Employee();
        $employees = $employeeModel->getAll();
        $selectedEmployee = self::handle();

        ?>
        <div style="text-align: center; margin-top: -100px; width:100%; background-color: #A3DAF0;">
            <h1 style="color: green; padding: 10px;">Edit Employee</h1>
        </div>

        <div style="margin: 20px auto; width: 600px;">
            <form method="POST" action="">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td><label for="employee_id">Select Employee ID:</label></td>
                        <td>
                            <select id="employee_id" name="employee_id" required onchange="this.form.submit()" style="width: 100%;">
                                <option value="">----Choose----</option>
                                <?php foreach ($employees as $employee) { ?>
                                    <option value="<?php echo $employee['id']; ?>" <?php if (isset($selectedEmployee) && $employee['id'] == $selectedEmployee['id']) echo 'selected'; ?>><?php echo $employee['id']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>

            <?php if (isset($selectedEmployee)) { ?>
                <form method="POST" action="">
                    <input type="hidden" name="employee_id" value="<?php echo $selectedEmployee['id']; ?>">
                    <label for="first_name">First Name:</label><br>
                    <input type="text" id="first_name" name="first_name" required style="width: 100%;" value="<?php echo htmlspecialchars($selectedEmployee['firstname']); ?>"><br>
                    <label for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" name="last_name" required style="width: 100%;" value="<?php echo htmlspecialchars($selectedEmployee['lastname']); ?>"><br>
                    <label for="department_id">Department ID:</label><br>
                    <input type="text" id="department_id" name="department_id" required style="width: 100%;" value="<?php echo htmlspecialchars($selectedEmployee['department_id']); ?>"><br><br>
                    <button type="button" onclick="window.location.href='index.php?act=listemployee'" style="padding: 10px 20px; background-color: #ccc; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 10px 20px; background-color: #4682B4; color: white; border: none; border-radius: 4px; cursor: pointer;">Update Employee</button>
                </form>
            <?php } ?>
        </div>
        <?php
    }

    public static function handle()
    {
        $employeeModel = new Employee();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employee_id'])) {
            $selectedEmployeeId = $_POST['employee_id'];

            if (isset($_POST['first_name'], $_POST['last_name'], $_POST['department_id'])) {
                $firstName = $_POST['first_name'];
                $lastName = $_POST['last_name'];
                $departmentId = $_POST['department_id'];

                $firstName = htmlspecialchars($firstName);
                $lastName = htmlspecialchars($lastName);
                $departmentId = htmlspecialchars($departmentId);

                $employeeModel->update($selectedEmployeeId, [
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'department_id' => $departmentId
                ]);

                header("Location: index.php?act=listemployee");
                exit();
            }

            return $employeeModel->getOne($selectedEmployeeId);
        }
        return null;
    }
}
