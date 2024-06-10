<?php

namespace App\Views\Components\Account;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Views\BaseView;
use App\Model\User;

class Account extends BaseView
{
    public static function render()
    {
        // ob_start(); // Start output buffering

        if (!empty($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['act']) && $_GET['act'] === 'updateInfo') {
                self::updateInfo();
            } else {
                self::updateAccount();
            }
        } else {
            self::form();
        }

?>



    <?php
        // ob_end_flush(); // Send output buffer and turn off output buffering
    }

    public static function handle()
    {
        // Implement handle logic if necessary
    }

    public static function login()
    {
        ob_start(); // Start output buffering

        $email = $_POST['email'];
        $password = $_POST['password'];
        $account = new User();
        $data = $account->login($email, $password);

        if (!empty($data)) {
            $_SESSION['user'] = $data;
            header('Location: index.php?act=');
            exit;
        } else {
            echo "<script>alert('Invalid email or password');</script>";
            header('Location: index.php?act=account');
        }

        ob_end_flush(); // Send output buffer and turn off output buffering
    }

    public static function register()
    {
        ob_start(); // Start output buffering

        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];
        $avatar = $_FILES['avatar'];

        // Check if password matches the confirm password
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match');</script>";
            echo "<script>window.location='index.php?act=account';</script>";
            ob_end_flush();
            return;
        }

        // Check avatar file type and size
        if ($avatar['size'] > 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($avatar['type'], $allowedTypes)) {
                $uploadDir = 'uploads/';
                $avatarPath = $uploadDir . basename($avatar['name']);
                if (move_uploaded_file($avatar['tmp_name'], $avatarPath)) {
                    // File uploaded successfully
                } else {
                    echo "<script>alert('Failed to upload avatar');</script>";
                    echo "<script>window.location='index.php?act=account';</script>";
                    ob_end_flush();
                    return;
                }
            } else {
                echo "<script>alert('Invalid file type. Only JPG, PNG, and GIF are allowed.');</script>";
                echo "<script>window.location='index.php?act=account';</script>";
                ob_end_flush();
                return;
            }
        } else {
            $avatarPath = null;
        }

        // Add user to the database
        $account = new User();
        $account->register($name, $password, $email, $avatarPath);
        echo "<script>alert('Registration successful');</script>";
        echo "<script>window.location='index.php?act=account';</script>";
        ob_end_flush(); // Send output buffer and turn off output buffering
    }

    public static function logout()
    {
        session_destroy(); // Destroy all sessions

        // Redirect to login or register page
        header('Location: index.php?act=account');
        exit;
    }

    public static function updatePassword()
    {
        // Check if all required fields are provided
        if (!isset($_POST['old_password']) || !isset($_POST['new_password']) || !isset($_POST['confirm_password'])) {
            header("Location: ?act=account");
            exit;
        }

        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Access the database
        // Check email
        $email = $_SESSION['user']['email'];

        $account = new User();
        $data = $account->login($email, $old_password);
        if (!empty($data)) {
            // Check if new password matches the confirm password
            if ($new_password !== $confirm_password) {
                $_SESSION['password_notify'] = "Confirm Password do not match";
                header("Location: ?act=account");
                exit;
            }

            // Update password
            $account->updatePassword($email, $new_password);
            $_SESSION['password_notify'] = "Password updated successfully";
        } else {
            // Notify incorrect old password
            $_SESSION['password_notify'] = "Incorrect Old Password";
        }

        header("Location: ?act=account");
        exit;
    }







    public static function updateInfo()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_SESSION['user']['email'];
        $avatar = $_FILES['avatar'];

        $isUpdateSuccessful = true; // Flag to track the overall update success
        $avatarPath = $_SESSION['user']['avatar']; // Default to the current avatar path

        // Check if a new file is uploaded
        if ($avatar['size'] > 0) {
            $allowedMimeTypes = ['image/jpeg', 'image/png'];
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
            $fileMimeType = $fileInfo->file($avatar['tmp_name']);
            $fileExtension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));

            // Validate the file type and extension
            if (in_array($fileMimeType, $allowedMimeTypes) && in_array($fileExtension, $allowedExtensions)) {
                $uploadDir = 'uploads/';
                $avatarPath = $uploadDir . basename($avatar['name']);
                
                // Attempt to move the uploaded file
                if (!move_uploaded_file($avatar['tmp_name'], $avatarPath)) {
                    // Failed to move the file
                    $isUpdateSuccessful = false;
                    echo "<script>alert('Failed to upload avatar');</script>";
                }
            } else {
                // Invalid file type
                $isUpdateSuccessful = false;
                echo "<script>alert('Invalid file type. Only JPG and PNG files are allowed.');</script>";
            }
        }

        // Proceed to update the database only if the file is valid and upload was successful
        if ($isUpdateSuccessful) {
            $account = new User();
            if ($account->updateAccount($name, $avatarPath, $email)) {
                // Update the session with new information
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['avatar'] = $avatarPath;
                echo "<script>alert('Update successful!!!');</script>";
            } else {
                // Database update failed
                echo "<script>alert('Update failed!!!');</script>";
            }
        }

        // Redirect to the account page to refresh the view
        echo "<script>window.location='index.php?act=account';</script>";
    }
}








    public static function form()
    {
        ob_start();
    ?>
        <!-- Hiển thị thông báo -->
        <?php if (isset($_SESSION['password_notify'])) : ?>
            <div class="alert alert-info">
                <?php
                echo $_SESSION['password_notify'];
                unset($_SESSION['password_notify']); // Xóa thông báo sau khi hiển thị
                ?>
            </div>
        <?php endif; ?>

        <div class="container" style="margin-left: 150px; margin-top:100px;">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="index.php?act=login" method="post">
                                <div class="mb-3"><label for="email">Email</label><input type="email" id="email" name="email" class="form-control"></div>
                                <div class="mb-3"><label for="password">Password</label><input type="password" id="login_password" name="password" class="form-control"></div>
                                <div class="mb-3"><button type="submit" class="btn btn-primary">Login</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form action="index.php?act=register" method="post" enctype="multipart/form-data">
                                <div class="mb-3"><label for="name">Name</label><input type="text" class="form-control" name="name" required></div>
                                <div class="mb-3"><label for="password">Password</label><input type="password" class="form-control" name="password" required></div>
                                <div class="mb-3"><label for="confirm_password">Confirm Password</label><input type="password" class="form-control" id="confirm_password" name="confirm_password" required></div>
                                <div class="mb-3"><label for="email">Email</label><input type="email" class="form-control" name="email" required></div>
                                <div class="mb-3"><label for="avatar">Avatar</label><input type="file" class="form-control" name="avatar" accept="image/*"></div>
                                <div class="mb-3"><button type="submit" class="btn btn-primary">Register</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
        ob_end_flush();
    }

    public static function updateAccount()
    {
    ?>
        <!-- Hiển thị thông báo -->
        <?php if (isset($_SESSION['password_notify'])) : ?>
            <div class="alert alert-info">
                <?php
                echo $_SESSION['password_notify'];
                unset($_SESSION['password_notify']); // Xóa thông báo sau khi hiển thị
                ?>
            </div>
        <?php endif; ?>

        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <!-- Password Change Form -->
                <div class="col-xl-6" style="padding-right: 15px;">
                    <div class="card">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form action="index.php?act=updatePassword" method="post">
                                <div class="mb-3">
                                    <label for="update_password_old">Old Password</label>
                                    <input type="password" value="" id="update_password_old" name="old_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="update_password">New Password</label>
                                    <input type="password" value="" id="update_password" name="new_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" value="" id="confirm_password" name="confirm_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Update Form -->
                <div class="col-xl-6" style="padding-left: 15px;">
                    <div class="card">
                        <div class="card-header">Update Account</div>
                        <div class="card-body">
                            <form action="index.php?act=updateAccount" method="post">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" readonly id="email" name="email" class="form-control" value="<?php echo $_SESSION['user']['email']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $_SESSION['user']['name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
