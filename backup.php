<?php


$server = "localhost";

$db_username = "root";

// password:
// AMPPS = mysql, XAMPP= , MAMP= root , laragon= tu dat
$db_password = "mysql";

$database = "php1_wd19303";


$connection = new mysqli(
    $server,
    $db_username,
    $db_password,
    $database
);

// var_dump($connection);
$query = "SELECT * FROM `pc09314_department`";
$result = $connection->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        var_dump($row);
        echo "<hr>";
    }
} else {
    echo "Du lieu dang duoc cap nhat";
}
