<?php
session_start();

if(isset($_SESSION["user_id"]) ){
    header("Location: ../dashboard/dashboard.php");
}

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require dirname(__FILE__, 2) . "/common/data.php";

    $sql = sprintf(
        "SELECT * FROM user WHERE email = '%s' ",
        $mysqli->real_escape_string($_POST["Email"])
    );



    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();



    if ($user) {

        if (password_verify($_POST["Password"], $user["password_hash"])) {

            //session_start();

            $_SESSION["user_id"] = $user["id"];
            header("Location: ../dashboard/dashboard.php");
            exit;
        }
    }
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>

<body>
<!--<section  style="background-color: #eee;"> -->
<div class="cotainer">
    <div class="form-box">
        <form action="../common/index.php" name="Formfill" method="POST" onsubmit="return validation()">
            <h1 class="heading">Sign-Up</h1>
            <p id="result"></p>
            
            <div class="input-box">
                <input type="email" name="Email" placeholder="Email">
            </div>
            <div class="input-box">
                <input type="password" name="Password" placeholder="Password">
            </div>
            
            <div class="button">
                <input type="submit" name="signup"  class="btn" value="Login">
                
            </div>
            <div class="group">
                <span>
                    <a href="../Signup/signup.php">Sign-up</a>
                </span>
            </div>
        </form>
    </div>
   </div>

    <script src="login.js"></script>
</body>

</html>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="../common/style.css">
</head>
<body>
   <div class="cotainer">
    <div class="form-box">
        <form  name="Formfill" method="POST" onsubmit="return validation()">
            <h1 class="heading">Login</h1>
             <?php if ($is_invalid) : ?>
                <em>Invalid login</em>
            <?php endif; ?> 
            <p id="result"></p>
            <div class="input-box">
                <i class='bx bxs-envelope'></i>
                <input type="email" name="Email" placeholder="Email" value="<?= htmlspecialchars($_POST["Email"] ?? "") ?>">
            </div>
            <div class="input-box">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="Password" placeholder="Password" >
            </div>
            
            <div class="button">
                <input type="submit" name="signup"  class="btn" value="Login">
            </div>
            <div class="group">
                <span><a href="../Signup/signup.php">Sign-Up</a>
                </span>
            </div>
        </form>
    </div>
   </div>
    <script src="../common/script.js"></script>
</body>
</html> -->
