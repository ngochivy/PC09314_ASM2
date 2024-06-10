<?php

namespace App\Views\Components;

use App\Views\BaseView;

class Header extends BaseView
{
    public static function render()
    {
        $searchQuery = $_GET['search'] ?? '';
        ob_start(); // Start output buffering
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <script>
                window.onload = function() {
                    var alertMessage = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>";
                    if (alertMessage !== '') {
                        alert(alertMessage);
                        <?php unset($_SESSION['message']); ?> // Xóa thông báo sau khi hiển thị
                    }
                };
            </script>

        </head>

        <body>
            <nav class="navbar navbar-expand-sm navbar-light bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="index.php?act=" style="color:white;">PC09314</a>
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?act=" aria-current="page" style="color:white;">Home
                                    <span class="visually-hidden">(current)</span></a>
                            </li>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Employee
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?act=listemployee">List Employee</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=addemployee">Add Employee</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=editemployee">Update Employee</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=deleteemployee">Delete Employee</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Department
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?act=listdepartment">List Department</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=adddepartment">Add Department</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=editdepartment">Update Department</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=deletedepartment">Delete Department</a></li>
                                </ul>
                            </div>
                        </ul>
                        <form class="d-flex my-2 my-lg-0" method="GET" action="index.php" style="margin-right: 10px;">
                            <input class="form-control me-sm-2" type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search" />
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: -40px;">
                                    Hi, <?php echo $_SESSION['user']['name']; ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="index.php?act=updatePassword">Update Account</a></li>
                                    <li><a class="dropdown-item" href="index.php?act=logout">Log out</a></li>
                                    
                                </ul>
                            </div>
                        <?php else : ?>
                            <li class="nav-item d-none d-sm-inline-block" style="margin-left: 0px; text-decoration: none;">
                                <a href="index.php?act=account" class="nav-link" style="color:white;">Account</a>
                            </li>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
    <?php
        ob_end_flush(); // Send output buffer and turn off output buffering
    }

    public static function handle()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) != 'index.php') {
            // Nếu chưa đăng nhập và không phải trang đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?act=account');
            exit;
        }
    }
}
