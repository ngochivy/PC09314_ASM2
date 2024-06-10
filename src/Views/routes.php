<?php
namespace App\Model;
session_start(); // Khởi động session

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use App\Views\Components\Header;
use App\Views\Components\Footer;
use App\Views\Components\Home;
use App\Views\Components\Employee\AddEmployee;
use App\Views\Components\Employee\EditEmployee;
use App\Views\Components\Employee\ListEmployee;
use App\Views\Components\Employee\DeleteEmployee;
use App\Views\Components\Department\ListDepartment;
use App\Views\Components\Department\AddDepartment;
use App\Views\Components\Department\EditDepartment;
use App\Views\Components\Department\DeleteDepartment;
use App\Views\Components\Account\Account;

$header = new Header();
$footer = new Footer();
$home = new Home();
$listemployee = new ListEmployee();
$addemployee = new AddEmployee();
$editemployee = new EditEmployee();
$deleleteemployee = new DeleteEmployee();
$listdepartment = new ListDepartment();
$adddepartment = new AddDepartment();
$editdepartment = new EditDepartment();
$deletedepartment = new DeleteDepartment();
$account = new Account();

ob_start(); // Bắt đầu lưu trữ đầu ra

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user']) && !in_array($_GET['act'] ?? '', ['login', 'register', 'account'])) {
    // Chuyển hướng đến trang đăng nhập
    header('Location: index.php?act=account');
    exit;
}

// Hiển thị header
$header->render();

$searchQuery = $_GET['search'] ?? '';

if ($searchQuery) {
    $searchResults = handleSearch($searchQuery);
    renderSearchResults($searchResults);
} else {
    $action = $_GET['act'] ?? '';

    switch ($action) {
        case "":
            $home->render();
            break;
        case 'listemployee':
            $listemployee->render();
            break;
        case 'addemployee':
            $addemployee->render();
            $addemployee->handle();
            break;
        case 'editemployee':
            $editemployee->render();
            $editemployee->handle();
            break;
        case 'deleteemployee':
            $deleleteemployee->render();
            $deleleteemployee->handle();
            break;
        case 'listdepartment':
            $listdepartment->render();
            break;
        case 'adddepartment':
            $adddepartment->render();
            $adddepartment->handle();
            break;
        case 'editdepartment':
            $editdepartment->render();
            $editdepartment->handle();
            break;
        case 'deletedepartment':
            $deletedepartment->render();
            $deletedepartment->handle();
            break;
        case 'account':
            $account->render();
            break;
        case 'login':
            Account::login();
            break;
        case 'register':
            Account::register();
            break;
        case 'logout':
            Account::logout();
            break;
        case 'updatePassword':
            Account::updatePassword();
            break;
        case 'updateAccount':
            Account::updateInfo();
            break;
        default:
            echo "<h1>404 Page Not Found</h1>";
            break;
    }
}

// Hiển thị footer
$footer->render();

ob_end_flush(); // Gửi đầu ra đã lưu trữ và tắt lưu trữ đầu ra

function handleSearch($searchQuery)
{
    $database = new Database();
    $query = "SELECT * FROM pc09314_employees WHERE firstname LIKE ? OR lastname LIKE ? OR id = ? OR department_id = ?";
    $stmt = $database->prepare($query);
    $searchTerm = '%' . $searchQuery . '%';
    $searchId = intval($searchQuery);
    $stmt->bind_param('ssii', $searchTerm, $searchTerm, $searchId, $searchId);
    $stmt->execute();
    $result = $stmt->get_result();
    $employees = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $database->close();
    return $employees;
}

function renderSearchResults($searchResults)
{
    ?>
    <div style="text-align: center; margin-top: 20px; width: 100%; background-color: #A3DAF0;">
        <h1 style="color: green; padding: 10px; display: inline-block;">Kết quả tìm kiếm</h1>
    </div>
    <table border="1" style="width: 100%; max-width: 600px; margin: auto; border-collapse: collapse;">
        <tr style="background-color: #f2f2f2;">
            <th style="border: 1px solid #000; padding: 8px; text-align: left;">ID</th>
            <th style="border: 1px solid #000; padding: 8px; text-align: left;">Họ</th>
            <th style="border: 1px solid #000; padding: 8px; text-align: left;">Tên</th>
            <th style="border: 1px solid #000; padding: 8px; text-align: left;">ID Phòng ban</th>
        </tr>
        <?php foreach ($searchResults as $employee): ?>
            <tr>
                <td style="border: 1px solid #000; padding: 8px;"><?php echo $employee['id']; ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><?php echo $employee['firstname']; ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><?php echo $employee['lastname']; ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><?php echo $employee['department_id']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
}
?>
