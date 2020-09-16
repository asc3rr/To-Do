<?php
    $msg = "";

    if(isset($_GET['msg'])){
        $msg = htmlentities($_GET['msg'], ENT_QUOTES, "utf-8");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    
    <title>To Do - Zaloguj</title>

    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
</head>
<body>
    <main>
        <?php
            echo $msg;
        ?>
        <form method="post" action="login.php">
            Login: <input class="input" type="text" placeholder="Login" name="login"><br />
            <br />
            Hasło: <input class="input" type="password" placeholder="Hasło" name="password"><br />
            <br />
            <input class="submit" type="submit" value="Zaloguj się">
        </form>
        <a style="color: white; text-decoration: none;" href="register.php">Nie masz konta? <u>Zarejestruj się</u></a>
    </main>
</body>
</html>