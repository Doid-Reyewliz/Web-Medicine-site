<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/home-page.png" />
    <title>Главное</title>
</head>

<header>
    <ul class="nav">
        <li class="active"><a href=""><h3>Главное</h3></a></li>
        <li><a href="Users.php"><h3>Клиенты</h3></a></li>
        <li><a href="Specialists.php"><h3>Специалисты</h3></a></li>
        <li><a href="Uzi.php"><h3>Узи</h3></a></li>
        <?php if($_SESSION['role']=='1'){ ?><li><a href="Staff.php"><h3>Сотрудники</h3></a></li> <?php } ?>
        <li><a href="New_schedule.php"><h3>Новая запись</h3></a></li>
        <?php if($_SESSION['role']=='1'){ ?><li><a href="Sum.php"><h3>Отчёт</h3></a></li><?php } ?>
    </ul>

    <ul>
        <li><a href="index.php"><h3>Выйти</h3></a></li>
    </ul>
</header>

<body>
    <section>
    <?php if (isset($_GET['snackbar'])) { ?>
        <div id="snackbar"><?php echo $_GET['snackbar']; ?></div>
        <script>
            setTimeout(function(){ document.getElementById("snackbar").style.visibility="hidden"; }, 4000);
            </script>
    <?php } ?>
    <h1 class="name">Добро пожаловать <span><?php echo $_SESSION['name'] . " " . $_SESSION['surname']; ?></span></h1>
    </section>
</body>
</html>