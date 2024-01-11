<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Document</title>
</head>

<?php
require("config.php");
?>

<body>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">My Cart</h1>
            <table>
                <?php
                $Uid = $_COOKIE['id'];
                $selectp = mysqli_query($con, "SELECT * FROM cart WHERE Uid='$Uid'");
                $num = 1;
                $grandTotal = 0;
                if (mysqli_num_rows($selectp) > 0) :
                ?>
                    <thead>
                        <th>S1 No</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($selectp)) :
                        ?>
                            <tr>
                                <td><?php echo $num ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><img src="imgs/<?php echo $row['image'] ?>"></td>
                                <td>$<?php echo number_format($row['price']) ?></td>
                                <td>
                                    <form id="quantityForm_<?php echo $row['id'] ?>" class="update-form">
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <div class="quantity_box">
                                            <input type="number" min="1" value="<?php echo $row['quantity'] ?>" name="quantity">
                                        </div>
                                    </form>
                                </td>
                                <td class="total-price">$<?php echo number_format($row['price'] * $row['quantity']) ?></td>
                                <td>
                                    <a href="deleteFromCart.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>Delete
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $grandTotal = $grandTotal + ($row['price'] * $row['quantity']);
                            $num++;
                        endwhile;
                        ?>
                    </tbody>
                <?php
                else :
                    echo "<div class='empty_text'>Cart is empty</div>";
                endif;
                ?>
            </table>
            <?php
            if ($grandTotal > 0) :
            ?>
                <div class="table_bottom">
                    <a href="client.php" class="bottom_btn">Continue shopping</a>
                    <h3 class="bottom_btn">Grand total: <span>$<?php echo number_format($grandTotal) ?></span></h3>
                    <a href="checkout.php" class="bottom_btn">Proceed to checkout</a>
                </div>
            <?php
            else :
            ?>
                <a href="client.php" class="bottom_btn">Return to shop</a>
            <?php
            endif;
            ?>
        </section>
    </div>

    <script src="https://kit.fontawesome.com/41a5db781c.js" crossorigin="anonymous"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(document).ready(function() {
            $('.update-form input[name="quantity"]').on('input', function() {
                var form = $(this).closest('form');
                var formData = form.serialize();
                var id = form.find('input[name="id"]').val();

                $.ajax({
                    type: 'POST',
                    url: 'updateQuantity.php',
                    data: formData,
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.success) {
                            // Quantity updated successfully
                            // Optionally, you can update the total price here without reloading the page
                        } else {
                            alert('Failed to update quantity');
                        }
                    },
                    error: function() {
                        console.error('Error occurred while updating the quantity');
                        alert('An error occurred while updating the quantity');
                    }
                });
            });
        });
    </script>
</body>

</html>