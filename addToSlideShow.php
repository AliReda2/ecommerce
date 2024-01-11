<?php
require 'config.php';

if (isset($_POST['addItem'])) {

    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case

    $final_file = str_replace(' ', '-', $new_file_name);

    $extensions = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
    if (in_array($file_type, $extensions)) {
        $folder = "imgs/";
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $sql = "INSERT INTO slideShow(image) VALUES('$final_file')";
            mysqli_query($con, $sql);
            echo '<script type="text/javascript"> alert("new image inserted") </script>';
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
