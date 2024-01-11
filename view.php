<!DOCTYPE html>
<html lang="en">

<head style="display: none;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desktop.css">
    <title>Online Shoping</title>
</head>
<!-- <link rel="icon" href="./imgs/logo.png" type="image/x-icon" /> -->
<!-- <link rel="shortcut icon" href="./imgs/logo.png" type="image/x-icon" /> -->
<?php
require("config.php");
?>
<style>
    .logOut {
        display: none !important;
        position: absolute;
        background-color: white;
        width: 6em;
        height: 3em;
        right: 9vw;
        top: 2.5em;
        z-index: 2;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-content: center;
        flex-wrap: wrap;
    }

    .logOutBtn {
        background-color: yellow;
        color: black;
        border: 1px solid white;
        padding: 10px;
        border-radius: 12px;
        width: 7em;
    }

    .arrow {
        display: none !important;
        position: absolute;
        z-index: 2;
        width: 1em;
        height: 1em;
        right: 13vw;
        rotate: 45deg;
        background-color: white;
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
    </nav>
    <div style="display: flex; flex-direction:column" id="dim">
        <div class="slideshow-container">
            <?php
            $sql = "SELECT * FROM slideShow";
            if ($result = mysqli_query($con, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="mySlides fade">
                        <img src="imgs/<?php echo $row['image'] ?>" style="width:100%">
                    </div>
            <?php
                }
            }

            ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <div style="margin-top: 40%;display: flex;flex-direction: column;">
            <?php
            $sql = "SELECT * FROM categories";
            if ($result = mysqli_query($con, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    $categoryName = $row['name'];
                    $sql2 = "SELECT * FROM $categoryName";

                    if ($result2 = mysqli_query($con, $sql2)) {
                        if (mysqli_num_rows($result2) > 0) {
            ?>
                            <div class="gallery" style="margin-top: 2em;">
                                <p style="font-size:larger; margin:0"><?php echo $categoryName ?></p>
                                <hr>
                                <?php
                                while ($row2 = mysqli_fetch_array($result2)) {
                                ?>
                                    <style>
                                        h3 {
                                            color: black;
                                            text-align: center;
                                            font-size: 30px;
                                            margin: 0;
                                            padding-top: 10px;
                                        }

                                        .gallary {
                                            display: flex;
                                            flex-wrap: wrap;
                                            width: 100%;
                                            justify-content: center;
                                            align-items: center;
                                            margin: 50px 0;
                                        }

                                        .content {
                                            position: relative;
                                            z-index: 3;
                                            width: min-content;
                                            margin: 15px;
                                            box-sizing: border-box;
                                            float: left;
                                            text-align: center;
                                            border-radius: 20px;
                                            cursor: pointer;
                                            padding-top: 10px;
                                            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                                                0 10px 10px rgba(0, 0, 0, 0.22);
                                            transition: .4s;
                                            background: #f2f2f2;
                                        }

                                        .content:hover {
                                            box-shadow: 0 30px 6px rgba(0, 0, 0, 0.16),
                                                0 3px 6px rgbargba(0, 0, 0, 0.23);
                                            transform: translate(0px, -8px);
                                        }

                                        p {
                                            color: black;
                                            width: 200px;
                                            height: 40px;
                                            text-align: center;
                                            margin: 0 auto;
                                            display: block;
                                        }

                                        h6 {
                                            color: black;
                                            font-size: 26px;
                                            text-align: center;
                                            color: #222f3e;
                                            margin: 0;
                                        }

                                        ul {
                                            list-style: none;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            padding: 0;
                                        }

                                        li {
                                            padding: 5px;
                                        }

                                        .fa {
                                            color: black;
                                            font-size: 26px;
                                            transition: .4s;
                                        }

                                        .checked {
                                            color: #ff9f43;
                                        }

                                        .fa:hover {
                                            transform: scale(1.3);
                                            transition: .6s;
                                        }

                                        button {
                                            text-align: center;
                                            font-size: 24px;
                                            color: #fff;
                                            width: 100%;
                                            padding: 15px;
                                            border: 0;
                                            outline: none;
                                            cursor: pointer;
                                            margin-top: 5px;
                                            border-bottom-right-radius: 20px;
                                            border-bottom-left-radius: 20px;
                                        }

                                        .buy-1 {
                                            background: #2183a2;
                                        }

                                        .buy-2 {
                                            background: #3b3e6e;
                                        }

                                        .buy-3 {
                                            background: #0b0b0b;
                                        }

                                        .buy-4 {
                                            background: #ff9f43;
                                        }

                                        @media(max-width:1000px) {
                                            .content {
                                                width: 45%;
                                            }
                                        }

                                        @media(max-width:750px) {
                                            .content {
                                                width: 100%;
                                            }
                                        }
                                    </style>

                                    <div class="content">
                                        <!-- Provide the correct path or URL to the image -->
                                        <img style="width: 200px;height: 200px;text-align: center;margin: 0 auto;display: block;border-top-left-radius: 10px;border-top-right-radius: 10px;" src="imgs/<?php echo $row2['image'] ?>">
                                        <h3><?php echo $row2['name']; ?></h3>
                                        <p><?php echo $row2['description'] ?></p>
                                        <h6><?php echo $row2['price'] ?>$</h6>
                                        <ul>
                                            <li><i class="fa fa-star checked"></i></li>
                                            <li><i class="fa fa-star checked"></i></li>
                                            <li><i class="fa fa-star checked"></i></li>
                                            <li><i class="fa fa-star checked"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <button class="buy-1">
                                            <a href="deleteItem.php?id=<?php echo $row2['id'] ?>&table=<?php echo $categoryName ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                        </button>
                                        <button class="buy-2">
                                            <a href="updateItem.php?id=<?php echo $row2['id'] ?>&table=<?php echo $categoryName ?>" onclick="return confirm('Are you sure?');">update</a>
                                        </button>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
            <?php
                        } else {
                            echo "No results for category: $categoryName";
                        }
                    } else {
                        echo "Error in query 2: " . mysqli_error($con);
                    }
                }
            } else {
                echo "Error in query 1: " . mysqli_error($con);
            }
            ?>
        </div>
    </div>
</body>

<script src="./script.js"></script>
<script src="https://kit.fontawesome.com/41a5db781c.js" crossorigin="anonymous"></script>

</html>