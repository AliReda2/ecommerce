<?php
require("config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cat = $_GET['table'];
    $deletQuery = mysqli_query($con, "DELETE FROM $cat WHERE id='$id'") or die("query failed");

    if ($deletQuery) {
        echo "<script>alert('Successfully deleted!')</script>";
        echo '<script type="text/javascript">setTimeout(function() { window.location.href = "view.php"; }, 1000);</script>';
    }else{
        echo "<script>alert('Failed to delete!')</script>";
    }
}
