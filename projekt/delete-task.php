<?php
    require_once "../connect.php";
    session_start();

    if(!isset($_SESSION['login'])){
        header("Location: ../");
    }

    if(!isset($_GET['id']) || !isset($_GET['project_id'])){
        header("Location: ../");
    }

    $login = $_SESSION['login'];

    $id = mysqli_real_escape_string($db, $_GET['id']);
    $project_id = mysqli_real_escape_string($db, $_GET['project_id']);

    $delete_sql = "DELETE FROM `tasks` WHERE `id`=$id AND `author`='$login' AND `project_id`='$project_id'";

    $db->query($delete_sql);

    header("Location: index.php?id=$id");
?>