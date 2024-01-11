<?php
require("config.php");
$cat = $_POST['category'];

$result = $con->query("SHOW TABLES LIKE '{$cat}'");
if ($result->num_rows == 1) {
    $sql = "DROP TABLE $cat ";
    $result = mysqli_query($con, $sql);
    $sql2 = "DELETE FROM categories WHERE name='$cat'";
    $result2 = mysqli_query($con, $sql2);

    echo '<script type="text/javascript"> alert("category deleted") </script>';
    echo '<script type="text/javascript">setTimeout(function() { window.location.href = "admin.php"; }, 1000);</script>';
} else {
    echo '<script type="text/javascript"> alert("category doesnt exists") </script>';
    echo '<script type="text/javascript">setTimeout(function() { window.location.href = "admin.php"; }, 1000);</script>';
}
