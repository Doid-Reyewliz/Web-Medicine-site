<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Записи</title>
</head>

<body>
    <section>
        <div class="content">
            <form action="back/add.php" method="post">
                <?php if (isset($_GET['snackbar'])) { ?>
                <div id="snackbar" class="error"><?php echo $_GET['snackbar']; ?></div>
                <script>
                setTimeout(function(){ document.getElementById("snackbar").style.visibility="hidden"; }, 4000);
                </script>
                <?php } ?>
                <h2>Новый сотрудник</h2>
                <input type="text" name="st_name" placeholder="Имя" autocomplete="off" required>
                <input type="text" name="st_surname" placeholder="Фамилия" autocomplete="off" required>
                <input type="text" name="st_log" placeholder="Логин" autocomplete="off" required>
                <input id="myInput" type="password" name="st_pass" placeholder="Пароль" autocomplete="off" required>
                <div>
                    <input type="checkbox" onclick="myFunction()">Показать пароль
                </div>
                <input type="submit" class="add" value="Добавить сотрудника">
            </form>
            <div class="button">
                <button class="back" onclick="goBack()">Назад</button>
                <a class="back" href="Home.php">Главная страница</a>
            </div>
        </div>
    </section>
</body>

<script>
function goBack() {
  window.history.back();
}
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</html>