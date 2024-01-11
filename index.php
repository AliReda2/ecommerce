<?php
session_start(); // Starting Session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in / Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #03a9f4;
            transition: 1s;
        }

        .slide {
            background-color: #f43648;
        }

        .container {
            position: relative;
            width: 800px;
            height: 400px;
            background: rgba(0, 0, 0, 0.125);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container .box {
            position: relative;
            width: 50%;
            height: 100%;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px;
        }

        .container .box h2 {
            position: relative;
            width: 50%;
            height: 100%;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px;
        }

        .container .box button {
            cursor: pointer;
            padding: 10px 20px;
            background: #fff;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            border: none;
            outline: none;
        }

        .formBx {
            position: absolute;
            left: 50px;
            width: 350px;
            height: 480px;
            background: #fff;
            z-index: 1000;
            box-shadow: 0 5px 25px Orgba(0, 0, 0, 0.15);
            transition: 0.5s;
            transition-delay: 0.5s;
            overflow: hidden;
        }

        .slide .formBx {
            left: 400px;
        }

        .formBx .form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            transition: 0.5s;
            align-items: center;
            background: #fff;
        }

        .formBx .signupform {
            top: 100%;
            transition-delay: 0s;
        }

        .slide .formBx .signupform {
            top: 0;
            transition-delay: 1s;
        }

        .formBx .signinform {
            top: 0;
            transition-delay: 1s;
        }

        .slide .formBx .signinform {
            top: -100%;
            transition-delay: 0s;
        }

        .formBx .form form {
            display: flex;
            flex-direction: column;
            padding: 0 50px;
            width: 100%;
        }

        .formBx .form form h3 {
            font-size: 1.4em;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .formBx .form form input {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            outline: none;
            font-size: 0.8em;
            border: 1px solid #333;
            letter-spacing: 0.1em;
        }

        .formBx .form form input[type="submit"] {
            background: #03a9f4;
            border: none;
            color: #fff;
            max-width: 100px;
            cursor: pointer;
            font-weight: 500;
        }

        .formBx .signupform form input[type="submit"] {
            background: #f43648;

        }

        .forgot {
            color: #333;
            letter-spacing: 0.05em;
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box signin">
            <h2>Already Have an Account ?</h2>
            <button class="signinBtn">Sign in</button>
        </div>
        <div class="box signup">
            <h2>Don't Have an Account ?</h2>
            <button class="signupBtn">Sign up</button>
        </div>
        <div class="formBx">
            <div class="form signinform">
                <form action="signIn.php" method="post">
                    <h3>Sign In</h3>
                    <input name="sEmail" type="email" placeholder="Email" required>
                    <input name="sPassword" type="password" placeholder="password" required>
                    <input type="submit" value="Login" name="login">
                    <a href="#" class="forgot">Forgot Password</a>
                </form>
            </div>
            <div class="form signupform">
                <form action="regester.php" method="post">
                    <h3>Sign up</h3>
                    <input name="username" type="text" placeholder="Username" required>
                    <input name="email" type="email" placeholder="email" required>
                    <input name="rPassword" type="password" placeholder="password" required>
                    <input name="confirmPass" type="password" placeholder="confirm password" required>
                    <input type="submit" value="Regester" name="regester">
                </form>
            </div>
        </div>
    </div>
    <script>
        let signinBtn = document.querySelector('.signinBtn');
        let signupBtn = document.querySelector('.signupBtn');
        let body = document.querySelector('body');

        signupBtn.onclick = function() {
            body.classList.add('slide');
        }
        signinBtn.onclick = function() {
            body.classList.remove('slide');
        }
    </script>
</body>

</html>