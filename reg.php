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
                                <h5>New user Registration</h5>
                            </td>
                        </tr>

                        <tr>
                            <td>Name</td>
                            <td><input type="text" class="form-control" name="name" required></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" class="form-control" name="addr" required></td>
                        </tr>

                        <tr>
                            <td>Email Id</td>
                            <td><input type="text" class="form-control" name="email" required></td>
                        </tr>


                        <tr>
                            <td>Phone Number</td>
                            <td><input type="text" class="form-control" name="phone" pattern="[6789]{1}[0-9]{9}" required></td>
                        </tr>





                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" class="form-control" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><button name="but" class="btn btn-success" type="submit">LOGIN</button></td>
                        </tr>


                        <tr>
                            <td></td>
                            <td> <a href="index.php">Already Registered</a> </td>
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
include './db.php';
if (isset($_POST["but"])) {

    $Uname = $_POST["username"];

    $Pass = $_POST["pass"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $addr = $_POST["addr"];
    $name = $_POST["name"];

    $sql = "INSERT INTO `users`( `name`, `address`, `email`, `phone`, `uname`, `pass`) VALUES
      ('$name','$addr','$email',$phone,'$Uname','$Pass')";


    $res = $connection->query($sql);
    if ($res === TRUE) {

        echo "<script> alert('User Registered Succesfully')   </script>";
        echo "<script> window.location.href='index.php'  </script>";
    } else {
        echo $connection->error;
        echo "<script> alert('Invalid Credentials')   </script>";
    }
}


?>