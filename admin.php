<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admin Dashboard | Keyframe Effects</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<?php
require("config.php");
?>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>N<span>ame</span></h3>
        </div>

        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(./imgs/luffy-straw-hat-one-piece-thumb.jpg)"></div>
                <h4>Ali Reda</h4>
            </div>

            <div class="side-menu">
            </div>
        </div>
    </div>

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <div class="user">
                        <a href="view.php">
                            <div class="bg-img" style="background-image: url(./imgs/logo.png)"></div>
                        </a>
                    </div>
                </div>
            </div>
        </header>


        <main>

            <div class="page-header">
                <h1>Home</h1>
            </div>

            <div class="page-content">
                <form action="newCat.php" method="post">
                    <p>Insert New Category</p>
                    <br>
                    <label for="category">Category Name</label>
                    <input type="text" name="category">
                    <input type="submit" value="submit">
                </form>
                <br>
                <hr>
                <br>
                <form action="deleteCat.php" method="post">
                    <p>Delete Category</p>
                    <br>
                    <select name="category">
                        <?php
                        $sql = "SELECT * From categories";
                        if ($result = mysqli_query($con, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <option value="<?php echo $row['name'] ?>">
                                        <?php echo $row['name'] ?>
                                    </option>
                        <?php
                                }
                            }
                        } ?>
                    </select>
                    <input type="submit" value="submit">
                </form>
                <br>
                <hr>
                <br>
                <form action="addToCat.php" method="post" enctype="multipart/form-data">
                    <p>add new item</p>
                    <table>
                        <tr>
                            <td>category</td>
                            <td>
                                <select name="category">
                                    <?php
                                    $sql = "SELECT * From categories";
                                    if ($result = mysqli_query($con, $sql)) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <option value="<?php echo $row['name'] ?>">
                                                    <?php echo $row['name'] ?>
                                                </option>
                                    <?php
                                            }
                                        }
                                    } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>name</td>
                            <td><input type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <td>price</td>
                            <td><input type="number" name="price" required></td>
                        </tr>
                        <tr>
                            <td>description </td>
                            <td><input type="text" name="desc" required></td>
                        </tr>
                        <tr>
                            <td>image</td>
                            <td> <input type="file" name="file" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="submit" name="addItem"></td>
                        </tr>
                    </table>
                </form>
                <br>
                <hr>
                <br>
                <form action="addToSlideShow.php" method="post" enctype="multipart/form-data">
                    <p>update slide show</p>
                    <table>
                        <tr>
                            <td>image</td>
                            <td> <input type="file" name="file" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="add" name="addItem"></td>
                        </tr>
                    </table>
                </form>
                <br>
                <?php
                $sql = "SELECT * FROM slideshow";
                if ($result = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table border="1">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Image</th>";
                        echo "<th> Action</th";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?php echo $row['image'] ?> </td>
                                <td>
                                    <a class="btn" href="deleteFromSlideShow.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                <?php                  }

                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        // mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($con);
                ?>
            </div>

        </main>

    </div>
</body>

</html>