<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Новый специалист</title>
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
                <h2>Новый специалист</h2>
                <input type="text" name="s_name" placeholder="Имя" autocomplete="off" required>
                <input type="text" name="s_surname" placeholder="Фамилия" autocomplete="off" required>
                <input type="text" name="special" placeholder="Специализация" autocomplete="on" required>
                <input type="submit" class="add" value="Добавить специалиста">
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
</script>

</html>