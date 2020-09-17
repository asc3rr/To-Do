<?php
    session_start();

    if(!isset($_SESSION['login'])){
        header("Location: login/");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">

    <title>To Do - Strona Główna</title>

    <link rel="stylesheet" href="css/project.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/index.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
</head>
<body>
    <div id="logo">
        Projekty
        <div id="buttons">
            <a class="button" href="dodaj-projekt.php">Dodaj projekt</a>
        </div>
    </div>
    <main>
        <?php
            require_once "connect.php";

            $login = $_SESSION['login'];
            $get_projects_sql = "SELECT * FROM `projects` WHERE `author`='$login' GROUP BY `id` DESC";

            if($result = $db->query($get_projects_sql)){
                if($result->num_rows > 0){
                    while($project_data = $result->fetch_assoc()){
                        $id = $project_data['id'];
                        $title = $project_data['title'];

                        echo <<<ENDL
                            <div class="project" onclick="location.href='projekt/?id=$id'">
                                <span class="project-title">$title</span>
                            </div>
                        ENDL;
                    }
                }
                else{
                    echo "Nie masz jeszcze żadnych projektów.";
                }
            }
        ?>
    </main>
</body>
</html>