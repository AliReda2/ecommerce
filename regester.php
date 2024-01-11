<?php
session_start();
setcookie("uname", $_POST["username"], time() + 3600);
require("config.php");

$username = $_POST['username'];
$password = $_POST["rPassword"];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$email = $_POST['email'];

// Use prepared statement to prevent SQL injection
$stmt = $con->prepare("SELECT id FROM credentials WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    // Check if the email is already registered
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript"> alert("Email already registered") </script>';
        echo '<script type="text/javascript">setTimeout(function() { window.location.href = "credentials.php"; }, 1000);</script>';
    } else {
        if (strlen($password) > 6) {
            if ($_POST["rPassword"] == $_POST["confirmPass"]) {
                // Use prepared statement for insertion
                $stmt = $con->prepare("INSERT INTO credentials (name, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $hashedPassword);
                $stmt->execute();

                $sql2 = "SELECT * FROM credentials WHERE email='" . $email . "'";
                $result2 = mysqli_query($con, $sql2);
            
                if ($result2) {
                    $rows = mysqli_num_rows($result2); // Count the rows
            
                    if ($rows == 1) {
                        $row = mysqli_fetch_array($result2);
                        $id = $row['id'];

                    }
                }
                echo '<script type="text/javascript"> alert("Registered successfully") </script>';
                echo '<script type="text/javascript">setTimeout(function() { window.location.href = "client.php"; }, 1000);</script>';
                setcookie("uname", $username, time() + 3600);
                setcookie("id", $id, time() + 3600);
            } else {
                echo '<script type="text/javascript"> alert("No matching password") </script>';
                echo '<script type="text/javascript">setTimeout(function() { window.location.href = "credentials.php"; }, 1000);</script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Password must be at least 7 characters") </script>';
            echo '<script type="text/javascript">setTimeout(function() { window.location.href = "credentials.php"; }, 1000);</script>';
        }
    }
} else {
    // Handle query execution error
    echo '<script type="text/javascript"> alert("Error in query execution") </script>';
    echo '<script type="text/javascript">setTimeout(function() { window.location.href = "credentials.php"; }, 1000);</script>';
}

$stmt->close();
$con->close();
