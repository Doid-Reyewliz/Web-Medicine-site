<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/login-rounded-right.png"/>
    <title>Вход</title>
</head>
<body>
    <div class="login">
        <form class="log" action="back/login.php" method="POST" >
        <?php if (isset($_GET['snackbar'])) { ?>
            <div id="snackbar" class="error"><?php echo $_GET['snackbar']; ?></div>
            <script>
            setTimeout(function(){ document.getElementById("snackbar").style.visibility="hidden"; }, 4000);
            </script>
        <?php } ?>
            <div class="contr">
                <h2>Вход</h2>
                <div class="row100">
                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="log" required="required">
                            <span class="text">Логин</span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="inputBox">
                            <input type="password" name="pass" required="required">
                            <span class="text">Пароль</span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <br>
                    <input id="log" type="submit" value="ВОЙТИ">
                </div>
            </div>
        </form>
    </div>
</body>
</html>