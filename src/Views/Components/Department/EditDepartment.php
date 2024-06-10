<?php

namespace App\Views\Components\Department;

use App\Views\BaseView;
use App\Model\Department;

class EditDepartment extends BaseView
{
    public static function render()
    {

        $departmentModel = new Department();
        $departmentsResult = $departmentModel->getAll();
        $departments = [];

        while ($row = $departmentsResult->fetch_assoc()) {
            $departments[] = $row;
        }

        $selectedDepartment = self::handle();

        ob_start()
?>
        <div style="text-align: center; margin-top: -160px; width:100%; background-color: #A3DAF0;">
            <h1 style="color: green; padding: 10px;">Update Department</h1>
        </div>

        <div style="margin: 20px auto; width: 600px;">
            <form method="POST" action="">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td><label for="department_id">Select Department ID:</label></td>
                        <td>
                            <select id="department_id" name="department_id" required onchange="this.form.submit()" style="width: 100%;">
                                <option value="">----Choose----</option>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department['id']; ?>" <?php if (isset($selectedDepartment) && $department['id'] == $selectedDepartment['id']) echo 'selected'; ?>><?php echo $department['id']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <?php if (isset($selectedDepartment)) { ?>
                        <tr>
                            <td><label for="department_name">Department Name:</label></td>
                            <td><input type="text" id="department_name" name="department_name" required style="width: 100%;" value="<?php echo $selectedDepartment['name']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="department_status">Department Status:</label></td>
                            <td><input type="text" id="department_status" name="department_status" required style="width: 100%;" value="<?php echo $selectedDepartment['status']; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <button type="button" onclick="window.location.href='index.php?act=listdepartment'" style="padding: 10px 20px; background-color: #ccc; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
                                <button type="submit" name="update" style="padding: 10px 20px; background-color: #4682B4; color: white; border: none; border-radius: 4px; cursor: pointer;">Update Department</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>
<?php

        ob_end_flush();
    }

    public static function handle()
    {

        $departmentModel = new Department();


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['department_id']) && !isset($_POST['update'])) {
                $selectedDepartmentId = $_POST['department_id'];
                $result = $departmentModel->getOne($selectedDepartmentId);
                if ($result) {
                    return $result->fetch_assoc();
                }
            }


            if (isset($_POST['update']) && isset($_POST['department_id']) && isset($_POST['department_name']) && isset($_POST['department_status'])) {
                $selectedDepartmentId = $_POST['department_id'];
                $departmentName = $_POST['department_name'];
                $departmentStatus = $_POST['department_status'];


                $departmentModel->update($selectedDepartmentId, [
                    'name' => $departmentName,
                    'status' => $departmentStatus
                ]);


                header("Location: index.php?act=listdepartment");
                exit();
            }
        }
        return null;
    }
}
