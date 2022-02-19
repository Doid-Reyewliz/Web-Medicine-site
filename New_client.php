<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Записи</title>
</head>

<body>
    <section>
        <?php if (isset($_GET['true'])) { ?>
                <span class="true"><?php echo $_GET['true']; ?></span>
            <?php } ?>
        <div class="content">
            <form action="back/add.php" method="post">
                <h2>Новый клиент</h2>
                <input type="text" name="name" placeholder="Имя" autocomplete="off" required>
                <input type="text" name="surname" placeholder="Фамилия" autocomplete="off" required>
                <div class="bday">
                    <label for="date">Дата рождение:</label>
                    <input id="datefield" type="date" name="date" min='1900-01-01' max='2000-13-13' required>
                </div>
                <div class="gender">
                    <label>Пол: </label>
                    <input type="radio" name="gender" value="М"><label>Мужчина</label>
                    <input type="radio" name="gender" value="Ж"><label>Женщина</label>
                </div>
                <input type="submit" class="add" value="Добавить клиента">
            </form>
            <div class="button">
                <button class="back" onclick="goBack()">Назад</button>
                <a class="back" href="Home.php">Главная страница</a>
            </div>
        </div>
    </section>
</body>

<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("max", today);

function goBack() {
  window.history.back();
}
</script>

</html>