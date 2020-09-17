<?php
    session_start();

    if(!isset($_SESSION['login'])){
        header("Location: ../");
    }

    if(!isset($_GET['id'])){
        header("Location: ../");
    }

    require_once "../connect.php";

    if(isset($_POST['content'])){
        //GETTING ID
        $get_id_sql = "SELECT * FROM `tasks`";

        $result = $db->query($get_id_sql);

        $id = $result->num_rows + 1;
        $project_id = mysqli_real_escape_string($db, $_GET['id']);
        $content = mysqli_real_escape_string($db, nl2br($_POST['content']));
        $author = $_SESSION['login'];

        $insert_sql = "INSERT INTO `tasks`(`id`, `project_id`, `content`, `author`) VALUES ($id, $project_id, '$content', '$author')";

        $db->query($insert_sql);

        header("Location: index.php?id=$project_id");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>To Do - Projekt</title>

    <link rel="stylesheet" href="../css/project.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div id="logo">
        Dodaj zadanie
    </div>
    <main>
        <form method="post">
            Treść: <br />
            <textarea name="content"></textarea><br />
            <br />
            <input type="submit" value="Dodaj zadanie">
        </form>
    </main>
</body>
</html>