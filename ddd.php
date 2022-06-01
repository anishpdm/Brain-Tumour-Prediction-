<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col col-sm-4">


            </div>

            <div class="col col-sm-4 col-12">
                <form action="" method="post">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td>
                                <h4>Disease Prediction System</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" class="form-control" name="password" required></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><button class="btn btn-success" name="but" type="submit">LOGIN</button></td>
                        </tr>


                        <tr>
                            <td></td>
                            <td> <a href="reg.php">New Users Click Here</a> </td>
                        </tr>


                    </table>
                </form>

            </div>


            <div class="col col-sm-4">


            </div>


        </div>

    </div>

</body>

</html>



<?php
session_start();
include './db.php';
if (isset($_POST["but"])) {

    $Uname = $_POST["username"];

    $Pass = $_POST["password"];

    $sql = "SELECT `id`, `name`, `address`, `email`, `phone`, `uname`, 
    `pass` FROM `users` WHERE `uname`='$Uname' and `pass`='$Pass'";
    $res = $connection->query($sql);

    if ($res->num_rows > 0) {

        while ($row = $res->fetch_assoc()) {

            $id = $row["id"];
            $name = $row["name"];
            $address = $row["address"];

            $email = $row["email"];
            $phone = $row["phone"];
            $uname = $row["uname"];
            $pass = $row["pass"];
            $_SESSION['id'] = $id;

            echo "<script> window.location.href='cancerpredict.php'  </script>";
        }
    } else {
        echo "<script> alert('LogIn Failed')   </script>";
    }
}


?>