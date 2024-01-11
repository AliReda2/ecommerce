<?php
require("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Remove from the cart
    $deleteFromCartQuery = mysqli_query($con, "DELETE FROM cart WHERE id='$id'");

    if ($deleteFromCartQuery) {
        // Successfully deleted from the cart

        // Redirect back to the cart page
        header("Location: cart.php");
        exit();
    } else {
        // Handle error, perhaps redirect back with an error message
        echo "Error deleting from cart";
    }
} else {
    // Invalid request, redirect back to the cart page
    header("Location: cart.php");
    exit();
}
?>
