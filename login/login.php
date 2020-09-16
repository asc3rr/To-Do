<?php
    require_once "../connect.php";

    $login = mysqli_real_escape_string($db, $_POST["login"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    $look_for_user_sql = "SELECT * FROM users WHERE login='$login'";

    $result = $db->query($look_for_user_sql);

    if($result->num_rows > 0){
        $user_data = $result->fetch_assoc();

        if(password_verify($password, $user_data['password'])){
            session_start();

            $_SESSION['login'] = $login;

            header("Location: ../");
        }
        else{
            header("Location: ../login/?msg=Zły login lub hasło.");
        }
    }
    else{
        header("Location: ../login/?msg=Użytkownik o takim loginie nie istnieje.");
    }
?>