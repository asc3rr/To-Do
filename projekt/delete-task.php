<?php
    require_once "../connect.php";
    session_start();

    if(!isset($_SESSION['login'])){
        header("Location: ../");
    }

    $login = $_SESSION['login'];

    $id = mysqli_real_escape_string($db, $_GET['id']);

    $delete_sql = "DELETE FROM `tasks` WHERE `id`=$id AND `author`='$login'";

    $db->query($delete_sql);

    header("Location: index.php?id=$id");
?>