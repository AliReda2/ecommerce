<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desktop.css">
    <title>Document</title>
</head>
<?php
require("config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cat = $_GET['table'];
    if (isset($_POST['updateProduct'])) {
        $name = $_POST['pName'];
        $price = $_POST['pPrice'];
        $img = $_FILES['pImage']['name'];
        $imageLoc = $_FILES['pImage']['tmp_name'];
        $folder = 'imgs/' . $img;
        $updateQuery2 = mysqli_query($con, "UPDATE $cat SET name='$name', price='$price',image='$img' WHERE id='$id'") or die("query1 failed");
        if ($updateQuery2) {
            move_uploaded_file($imageLoc, $folder);
            echo '<script type="text/javascript"> alert("item updated") </script>';
            echo '<script type="text/javascript">setTimeout(function() { window.location.href = "view.php"; }, 1000);</script>';
        } else {
            echo '<script type="text/javascript"> alert("error") </script>';
            echo '<script type="text/javascript">setTimeout(function() { window.location.href = "view.php"; }, 1000);</script>';
        }
    }
}
?>
<style>
    .editContainer {
        margin: 2em;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .updateProduct {
        display: flex;
        flex-direction: column;
        background-color: cadetblue;
        width: 50%;
        align-items: center;
        padding: 1em;
    }

    .updateProduct img {
        width: 35%;
    }

    .inputFields {
        color: black;
        width: 90%;
        margin: 15px;
        line-height: 2em;
        padding-left: 1em;
    }

    .updateBtn {
        background: #0b0b0b;
        text-align: center;
        font-size: 24px;
        color: #fff;
        padding: 15px;
        border: 0;
        outline: none;
        cursor: pointer;
        margin-top: 5px;
        border-radius: 20px;
    }

    .cancelBtn {
        background: #ff9f43;
        text-align: center;
        font-size: 24px;
        color: #fff;
        padding: 15px;
        border: 0;
        outline: none;
        cursor: pointer;
        margin-top: 5px;
        border-radius: 20px;
    }

    .btns {
        display: flex;
        width: -webkit-fill-available;
        justify-content: space-evenly;
    }
</style>

<body>
    <nav>
        <div class="logo"><a href="">Name</a></div>
        <div class="searchBar">
            <select name="" id="">
                <option value="All">All</option>
            </select>
            <input type="text">
            <div class="magnifyingGlass">
                <div class="glass"></div>
                <div class="stick"></div>
            </div>
        </div>
        <div class="signIn"><a href="admin.php">ADMIN</a>
        </div>
        <div class="cart"><a href="">CART</a></div>
    </nav>
    <section class="editContainer">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $cat = $_GET['table'];
            $updateQuery = mysqli_query($con, "SELECT * FROM $cat WHERE id='$id'") or die("query2 failed");
            if (mysqli_num_rows($updateQuery) > 0) {
                $row = mysqli_fetch_assoc($updateQuery)

        ?>
                <form action="" method="post" enctype="multipart/form-data" class="updateProduct">
                    <img src="imgs/<?php echo $row['image'] ?>" alt="">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="pId">
                    <input type="text" class="inputFields" required value="<?php echo $row['name'] ?>" name="pName">
                    <input type="number" class="inputFields" required value="<?php echo $row['price'] ?>" name="pPrice">
                    <input type="file" class="inputFields" required accept="image/jpeg, image/png, image/gif, image/jpg" name="pImage">
                    <div class="btns">
                        <input type="submit" class="updateBtn" value="Update" name="updateProduct">
                        <input type="reset" id="closeBtn" value="Cancel" class="cancelBtn" onclick="redirectToAnotherPage()">
                    </div>
                </form>
        <?php

            }
        }
        ?>

    </section>
</body>
<script>
    function redirectToAnotherPage() {
        var url = "view.php";
        window.location.href = url;
    }
</script>

</html>