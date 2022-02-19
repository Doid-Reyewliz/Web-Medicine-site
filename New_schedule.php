<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/reservation-2--v2.png"/>
    <title>Новая запись</title>
</head>

<body>
    <section>
        <?php if (isset($_GET['true'])) { ?>
                <span class="true"><?php echo $_GET['true']; ?></span>
            <?php } ?>
        <div class="content">
            <form action="back/add.php" method="post">
                <h2>Новая запись</h2>
                <select name="select" required>
                    <option disabled selected>Специалист</option>
                    <?php
                        require_once "back/db.php";
                        $db = new Dbase();

                        $id = $_POST['id'];

                        $sql = $db->query("SELECT * FROM specialists");
                        foreach($sql as $row){
                            echo "<option value='{$row['id']}'> {$row['Name']} {$row['Surname']}</option>";
                        }

                    ?>
                </select>
                <select name="c_select" required>
                    <option disabled selected>Клиент</option>
                    <?php
                        require_once "back/db.php";
                        $db = new Dbase();

                        $id = $_POST['id'];

                        $sql = $db->query("SELECT * FROM clients");
                        foreach($sql as $row){
                            echo "<option value='{$row['id']}'> {$row['Name']} {$row['Surname']}</option>";
                        }

                    ?>
                </select>
                <input id="datefield" type="date" name="date" min='1899-01-01' max='2000-13-13' required>
                <input type="time" name="time" id="" required>
                <input type="submit" value="Добавить запись">
            </form>
            <div class="button">
                <a class="back" href="Users.php">Клиенты</a>
                <a class="back" href="Specialists.php">Специалисты</a>
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
document.getElementById("datefield").setAttribute("min", today);
</script>

</html>