<?php
    $msg = "";

    require_once "../connect.php";

    if(isset($_POST['login']) && isset($_POST['password'])){
        $login = mysqli_real_escape_string($db, $_POST['login']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $look_for_user_sql = "SELECT * FROM users WHERE login='$login'";

        $result = $db->query($look_for_user_sql);

        if($result->num_rows == 0){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_sql = "INSERT INTO `users`(`login`, `password`) VALUES ('$login', '$hashed_password')";

            $db->query($insert_sql);

            header("Location: index.php?msg=Właśnie utworzyłeś konto, zaloguj się");
        }
        else{
            $msg = "Użytkownik o takiej nazwie już istnieje.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    
    <title>To Do - Zarejestruj się</title>

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
</head>
<body>
    <div id="logo">
        To Do
    </div>
    <main>
        <?php echo $msg; ?>
        <form method="post" action="register.php">
            Login: <input class="input" type="text" placeholder="Login" name="login"><br />
            <br />
            Hasło: <input class="input" type="password" placeholder="Hasło" name="password"><br />
            <br />
            <input class="submit" type="submit" value="Zaloguj się">
        </form>
        <a style="color: white; text-decoration: none;" href="index.php">Masz już konto? <u>Zaloguj się</u></a>
    </main>
</body>
</html>