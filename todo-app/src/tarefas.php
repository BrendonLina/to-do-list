<?php
session_start();
require_once("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Adicionar uma tarefa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_task"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $status = "pendente";

    $sql = "INSERT INTO tasks (title, description, creation_date, status, user_id) VALUES ('$title', '$description', NOW(), '$status', $user_id)";
    mysqli_query($conn, $sql);
}

// Marcar uma tarefa como concluída
if (isset($_GET["task_id"]) && isset($_GET["mark_as_completed"])) {
    $task_id = $_GET["task_id"];
    $sql = "UPDATE tasks SET status = 'concluída' WHERE id = $task_id AND user_id = $user_id";
    mysqli_query($conn, $sql);
}

// Consultar tarefas do usuário
$sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY creation_date DESC";
$result = mysqli_query($conn, $sql);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <div class="container">
                <div class="row justify-content-center align-items-center vh-100">
                    <div class="col-auto w-50">
                        <h3>Sistema de Gerenciamento de Tarefas</h3>
                        <form method="post">
                            <h4>Adicionar Tarefa</h4>
                            <div class="row">
                                <div class="col my-1">
                                    <input type="text" placeholder="Digite o nome da tarefa" id="title" name="title" class="form-control" required>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col my-1">
                                    <textarea  placeholder="Descrição" id="description" name="description" class="form-control" required></textarea>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col my-1">
                                    <input type="submit" value="Adicionar Tarefa" name ="new_task" class="form-control btn btn-success">
                                    <a href="logout.php">Sair</a>
                                </div>    
                            </div>
                            <div>
                                <h3>Lista de Tarefas</h3>
                                    <ul>
                                        <?php foreach ($tasks as $task): ?>
                                            <li>
                                                <strong><?= $task["title"] ?></strong><br>
                                                <?= $task["description"] ?><br>
                                                Data de Criação: <?= $task["creation_date"] ?><br>
                                                Status: <?= $task["status"] ?><br>
                                                <a href="?task_id=<?= $task["id"] ?>&mark_as_completed=true">Marcar como Concluída</a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

    

    <!-- <h3>Adicionar Tarefa</h3>
    <form method="post">
        Título: <input type="text" name="title" required><br>
        Descrição: <textarea name="description" required></textarea><br>
        <input type="submit" name="new_task" value="Adicionar Tarefa">
    </form> -->

    <!-- Lista de tarefas -->
    <h3>Lista de Tarefas</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?= $task["title"] ?></strong><br>
                <?= $task["description"] ?><br>
                Data de Criação: <?= $task["creation_date"] ?><br>
                Status: <?= $task["status"] ?><br>
                <a href="?task_id=<?= $task["id"] ?>&mark_as_completed=true">Marcar como Concluída</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>