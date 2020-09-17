<?php
    session_start();

    if(!isset($_SESSION['login'])){
        header("Location: ../");
    }

    require_once "connect.php";

    if(isset($_POST['content'])){
        //GETTING ID
        $get_id_sql = "SELECT * FROM `projects`";

        $result = $db->query($get_id_sql);

        $id = $result->num_rows + 1;
        $content = mysqli_real_escape_string($db, nl2br($_POST['content']));
        $author = $_SESSION['login'];

        $insert_sql = "INSERT INTO `projects`(`id`, `title`, `author`) VALUES ($id, '$content', '$author')";

        $db->query($insert_sql);

        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>To Do - Projekt</title>

    <link rel="stylesheet" href="css/project.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <main>
        <form method="post">
            Treść: <br />
            <textarea name="content"></textarea><br />
            <br />
            <input type="submit" value="Dodaj projekt">
        </form>
    </main>
</body>
</html>