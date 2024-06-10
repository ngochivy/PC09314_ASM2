<?php

namespace App\Views\Components\Department;

use App\Model\Department;
use App\Views\BaseView;

class AddDepartment extends BaseView
{
    public static function render()
    {
        ob_start();

?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Add Department
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php?act=adddepartment">
                        <div class="mb-3">
                            <label for="name">Department Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="status">Static</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">----Chọn----</option>
                                <option value="0">0 - Inactive</option>
                                <option value="1">1 - Active</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Gửi
                        </button>
                    </form>
                </div>
            </div>
        </div>
<?php
    }

    public static function handle()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $department = new Department();
            $result = $department->create($data);

            if ($result) {
                header("Location: index.php?act=listdepartment");
                exit();
            }
        }
        ob_end_flush();
    }
}
