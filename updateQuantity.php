<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $newQuantity = $_POST['quantity'];

    // Perform the update query here
    $updateQuery = "UPDATE cart SET quantity='$newQuantity' WHERE id='$productId'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        $newTotalPrice = $row['price'] * $newQuantity; // Calculate the new total price

        // Calculate the new grand total
        $newGrandTotal = calculateGrandTotal($con);

        echo json_encode(['success' => true, 'newTotalPrice' => $newTotalPrice, 'newGrandTotal' => $newGrandTotal]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Function to calculate the grand total
function calculateGrandTotal($con)
{
    $Uid = $_COOKIE['id'];
    $selectp = mysqli_query($con, "SELECT * FROM cart WHERE Uid='$Uid'");
    $grandTotal = 0;

    while ($row = mysqli_fetch_assoc($selectp)) {
        $grandTotal += $row['price'] * $row['quantity'];
    }

    return $grandTotal;
}
