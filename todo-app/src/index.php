<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo "Erro ao registrar usuário: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-auto w-50">
                <form method="post">
                    <h2>Registro de Usuário</h2>
                    <div class="row">
                        <div class="col my-1">
                            <input type="text" placeholder="Nome" id="name" name="name" class="form-control" required>
                        </div>    
                    </div>
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
                            <input type="submit" value="Registrar" class="form-control btn btn-primary">
                        </div>    
                    </div>

                </form>
            </div>
        </div>
    </div>
    
</body>
</html>