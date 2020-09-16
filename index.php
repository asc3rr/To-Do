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

    <link rel="stylesheet" href="css/all.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
</head>
<body>
    <main>
        <?php
            require_once "connect.php";

            $login = $_SESSION['login'];
            $get_projects_sql = "SELECT * FROM `projects` WHERE `author`='$login' GROUP BY `id` DESC";

            echo "$login<br />$get_projects_sql";

            if($result = $db->query($get_projects_sql)){
                if($result->num_rows > 0){
                    $projects_data = array();

                    while($project_data = $result->fetch_assoc()){
                        $id = $project_data['id'];
                        $title = $project_data['title'];

                        echo <<<ENDL
                            <div class="project" onclick="location.href='projekt/?id=$id'">
                                <span class="project-title">$title</span>
                            </div>
                        ENDL;

                        $project_array = array($id, $title);

                        print_r($project_array);
                        
                        array_push($project_data, $project_array);
                    }

                    print_r($projects_data);

                    foreach(array_reverse($projects_data) as $project_data){
                        $id = $project_data[0];
                        $title = $project_data[1];

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