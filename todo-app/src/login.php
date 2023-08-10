<?php
session_start();
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, name, password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            header("Location: tarefa.php");
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-auto w-50">
                    <form method="post">
                        <h2>Login</h2>
                        <div class="row">
                            <div class="col my-1">
                                <input type="email" placeholder="Email" id="email" name="email" class="form-control" required>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col my-1">
                                <input type="password" placeholder="Senha" id="password" name="password" class="form-control" required>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col my-1">
                                <input type="submit" value="Login" class="form-control btn btn-primary">
                            </div>    
                        </div>

                    </form>
                </div>
            </div>
        </div>







    <!-- <h2>Login</h2>
    <form method="post">
        Email: <input type="email" name="email" required><br>
        Senha: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form> -->
</body>
</html>