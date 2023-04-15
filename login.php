<?php
require_once("./lib/config.php");

if(isset($_SESSION["username"])){
    header("location:index.php");
}
if(isset($_POST["user"])){
    $user=$_POST["user"];
    $pass=$_POST["pass"];
   $query="select * from users where username=\"".$user."\" AND pass=\"".$pass."\"" ;
   $result=$conn->query($query);
   if ( isset($result->num_rows) && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["username"]=$row["username"];
            header("location:index.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid p-4 ">

    <h1 class="text-center page-header">LOGIN</h1>
        <form class="container row" method="post">
            <div class="col-sm-3 p-4">username</div>
            <div class="col-sm-9 p-4"><input type="text" name="user" class="form-control"></div>
            <div class="col-sm-3 p-4">Password</div>
            <div class="col-sm-9 p-4"><input type="password" name="pass" class="form-control"></div>
            <div class="col-sm-12 text-center">
                <input type="submit" value="login" class="btn btn-primary">
            </div>
        </form>
    </div>

</body>

</html>