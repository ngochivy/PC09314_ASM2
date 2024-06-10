<?php

namespace App\Views\Components\Employee;

use App\Views\BaseView;
use App\Model\Employee;

class DeleteEmployee extends BaseView {

    public static function render() {
        ?>
        <div style="text-align: center; margin-top: -230px; width:100%; background-color: #A3DAF0;">
        <h1 style="color: green; padding: 10px; display: inline-block;">Register Employee</h1>
        </div>
        <form method="POST" action="" style="margin-left: 600px; margin-top:-100px;">
            <label for="employee_id" style="display: block; margin-bottom: 10px;">Select Employee ID:</label>
            <select id="employee_id" name="id" required style="width: 300px; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Select Employee ID --</option>
                <?php
                $employee = new Employee();
                $employees = $employee->getAll();
                foreach ($employees as $employee) {
                    echo "<option value='" . $employee['id'] . "'>" . $employee['id'] . " - " . $employee['firstname'] . " " . $employee['lastname'] . "</option>";
                }
                ?>
            </select>
            <button type="submit" style=" margin-left:80px; display:flex; width: 135px;  padding: 10px; background-color: #4682B4; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete Employee</button>
        </form>
        <?php
    }

    public static function handle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $self = new self();
            $id = $_POST['id'];

            $result = $self->deleteEmployee($id);

            if ($result) {
                echo "<script>alert('Employee deleted successfully!'); window.location.href = 'index.php?act=listemployee';</script>";
            } else {
                echo "<script>alert('Failed to delete employee.');</script>";
            }
        }
    }
    
    
    private function getAll() {
        $employee = new Employee();
        return $employee->getAll();
    }

  
    private function deleteEmployee($id) {
        $employee = new Employee();
        return $employee->delete($id);
    }
}
