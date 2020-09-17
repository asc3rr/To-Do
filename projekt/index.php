<?php
    require_once "../connect.php";
    session_start();

    if(!isset($_SESSION['login'])){
        header("Location: ../");
    }

    if(!isset($_GET['id'])){
        header("Location: ../");
    }

    $login = $_SESSION['login'];

    $id = mysqli_real_escape_string($db, $_GET['id']);

    //PROJECTS
    $projects_sql = "SELECT * FROM `projects` WHERE `id`=$id AND `author`='$login'";

    if($result = $db->query($projects_sql)){
        if($result->num_rows > 0){
            $projects = $result->fetch_assoc();
            
            $title = $projects['title'];
        }
        else{
            $error = "Nie masz jeszcze żadnych zadań.";
        }
    }

    //ELEMENTS
    $tasks_sql = "SELECT * FROM `tasks` WHERE `project_id`=$id AND `author`='$login' GROUP BY `id` DESC";

    if($result = $db->query($tasks_sql)){
        if($result->num_rows > 0){
            $tasks = $result->fetch_assoc();
            
            $content = $tasks['content'];
            $task_id = $tasks['id'];
        }
        else{
            $error = "Nie masz jeszcze żadnych zadań.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>To Do - Projekt</title>

    <link rel="stylesheet" href="../css/project.css">
    <link rel="stylesheet" href="../css/all.css">
</head>
<body>
    <div id="logo">
        <?php echo $title;?>
        <div id="buttons">
            <?php
                echo <<<ENDL
                    <a class="button" href="dodaj-zadanie.php?id=$id">Dodaj Zadanie</a>
                ENDL;
            ?>
        </div>
    </div>
    <main>
        <?php
            if(!isset($error)){
                echo <<<ENDL
                <div class="task">
                    <a class="task-button" href="delete-task.php?id=$task_id&project_id=$id">Skończyłem już</a>
                    <span class="task-title">$content</span>
                </div>
                ENDL;
            }
            else{
                echo $error;
            }
        ?>
    </main>
</body>
</html>