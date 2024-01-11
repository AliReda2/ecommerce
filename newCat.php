<?php
require("config.php");
$cat = $_POST['category'];

$result = $con->query("SHOW TABLES LIKE '{$cat}'");
if ($result->num_rows == 1) {
    echo '<script type="text/javascript"> alert("category already exists") </script>';
    echo '<script type="text/javascript">setTimeout(function() { window.location.href = "admin.php"; }, 1000);</script>';
} else {
    $sql = "CREATE TABLE $cat (id int primary key AUTO_INCREMENT,price int,name varchar(255),description varchar(255),image varchar(100))";
    $result = mysqli_query($con, $sql);
    $sql2 = "INSERT INTO categories(id,name) VALUES(null,'$cat')";
    $result2 = mysqli_query($con, $sql2);
    echo '<script type="text/javascript"> alert("new category created") </script>';
    echo '<script type="text/javascript">setTimeout(function() { window.location.href = "admin.php"; }, 1000);</script>';
}
