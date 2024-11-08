<?php
if (isset($_POST['submit'])) {
    require_once '../dbconnect.php';
    $conn = dbconnect();
    if ($conn) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;

            $sql = "CREATE TABLE `library`.`$email-book` ( `id` INT NOT NULL ,  `name` TEXT NOT NULL ,  `author` TEXT NOT NULL ,  `available` INT NOT NULL ,  `borrowed` INT NOT NULL , PRIMARY KEY  (`id`)) ENGINE = InnoDB;";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sql = "CREATE TABLE `library`.`$email-student` ( `id` INT NOT NULL ,  `name` TEXT NOT NULL ,  `course` TEXT NOT NULL , `branch` TEXT NOT NULL ,  `borrowed` JSON NOT NULL ,  `phone` TEXT NOT NULL ,  `year` TEXT NOT NULL ,  `email` TEXT NOT NULL, PRIMARY KEY  (`id`) ) ENGINE = InnoDB;";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "<script>alert('Database Error.');</script>";
                } else {
                    header("location: ../");
                    exit;
                }
            } else {
                echo "<script>alert('Database Error.');</script>";
            }

            header("location: ../");
            exit;
        } else {
            echo "<script>alert('Cannot connect to database.')</script>";
        }
    } else {
        echo "<script>alert('Cannot connect to database.')</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="..\\login\\style.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign Up</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <!-- <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span> have to setup in future-->
                    </div>
                </div>
                <div class="card-body">
                    <form action="./" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Email" name="email">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Sign Up" class="btn float-right login_btn" name="submit">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Already have an account?<a href="#">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
