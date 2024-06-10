<?php

namespace App\Views\Components\Department;

use App\Views\BaseView;
use App\Model\Department;

class DeleteDepartment extends BaseView {
    public static function render() {
        ?>
        <div style="text-align: center; margin-top: -230px; width:100%; background-color: #A3DAF0;">
            <h1 style="color: green; padding: 10px; display: inline-block;">Delete Department</h1>
        </div>
        <form method="POST" action="" style="margin-left: 600px; margin-top:-100px;">
            <label for="department_id" style="display: block; margin-bottom: 10px;">Select Department ID:</label>
            <select id="department_id" name="id" required style="width: 300px; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Select Department ID --</option>
                <?php
                $department = new Department();
                $departments = $department->getAll();
                foreach ($departments as $department) {
                    echo "<option value='" . $department['id'] . "'>" . $department['id'] . " - " . $department['name'] . "</option>";
                }
                ?>
            </select>
            <button type="submit" style=" margin-left:80px; display:flex; width: 135px;  padding: 10px; background-color: #4682B4; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete Department</button>
        </form>
        <?php
    }

    public static function handle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $self = new self();
            $id = $_POST['id'];

            $result = $self->deleteDepartment($id);

            if ($result) {
                echo "<script>alert('Department deleted successfully!'); window.location.href = 'index.php?act=listdepartment';</script>";
            } else {
                echo "<script>alert('Failed to delete department.');</script>";
            }
        }
    }

    // Hàm xóa department
    private function deleteDepartment($id) {
        $department = new Department();
        return $department->delete($id);
    }
}
