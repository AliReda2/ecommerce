<?php
require "config.php";

if (isset($_POST['login'])) {
    $email = $_POST['sEmail'];
    $password = $_POST['sPassword'];

    // To protect MySQL injection for Security purpose
    $sql = "SELECT * FROM credentials WHERE email='" . $email . "'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $rows = mysqli_num_rows($result); // Count the rows

        if ($rows == 1) {
            $row = mysqli_fetch_array($result);
            $hashedPassword = $row['password'];

            // Verify the entered password against the stored hash
            if (password_verify($password, $hashedPassword)) {
                // Password is correct
                $name = $row['name'];
                $id = $row['id'];
                echo '<script type="text/javascript"> alert("User found") </script>';
                echo '<script type="text/javascript">setTimeout(function() { window.location.href = "client.php"; }, 1000);</script>';
                setcookie("uname", $name, time() + 3600);
                setcookie("id", $id, time() + 3600);
            } else {
                // Incorrect password
                echo '<script type="text/javascript"> alert("Incorrect password") </script>';
                echo '<script type="text/javascript"> setTimeout(function() { window.location.href = "credentials.php"; }, 1000); </script>';
            }
        } else {
            // Email not found
            echo '<script type="text/javascript"> alert("Email not found") </script>';
            echo '<script type="text/javascript"> setTimeout(function() { window.location.href = "credentials.php"; }, 1000); </script>';
        }
    } else {
        // Error in the SQL query
        echo '<script type="text/javascript"> alert("Error in login") </script>';
        echo '<script type="text/javascript"> setTimeout(function() { window.location.href = "credentials.php"; }, 1000); </script>';
    }

    mysqli_close($con); // Closing Connection
}
