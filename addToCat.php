<?php
require 'config.php';
$cat = $_POST['category'];
$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];


if (isset($_POST['addItem'])) {

    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    // make file name in lower case
    $new_file_name = strtolower($file);

    $final_file = str_replace(' ', '-', $new_file_name);

    $extensions = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
    if (in_array($file_type, $extensions)) {
        $folder = "imgs/";
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $sql = "INSERT INTO $cat(id,name,price,description,image) VALUES(null,'$name','$price','$desc','$final_file')";
            mysqli_query($con, $sql);
            echo '<script type="text/javascript"> alert("new item inserted") </script>';
            echo '<script type="text/javascript">setTimeout(function() { window.location.href = "admin.php"; }, 1000);</script>';
        } else {
?>
            <script>
                alert('error while uploading file');
                window.location.href = 'admin.php?fail';
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert('img extension error');
            window.location.href = 'admin.php?fail';
        </script>
<?php
    }
}
