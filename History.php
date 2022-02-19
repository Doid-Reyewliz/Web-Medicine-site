<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/order-history.png"/>
    <title>История</title>
</head>

<body>
    <section>
        <div class="table">
            <h3><?php echo "Клиент: " . $_POST["name"] . " " . $_POST["surname"] ?></h3>
            <br>
            <?php 
                require_once "back/db.php";
                $db = new Dbase();

                $c_name = $_POST['name'];
                $c_surname = $_POST['surname'];

                $sql = $db->query("SELECT schedule.specialist_id, specialists.Name, specialists.Surname, specialists.Specialization, schedule.date, schedule.time FROM schedule INNER JOIN specialists ON schedule.specialist_id = specialists.id WHERE schedule.client_name='$c_name' AND schedule.client_surname='$c_surname' ORDER BY schedule.date DESC, schedule.time");

                echo "<div class='t'>
                        <table>
                            <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Специализация</th>
                            <th>Дата</th>
                            <th>Время</th>
                        </tr>";
                foreach($sql as $row){
                    echo "
                            <tr>
                                <td></td>
                                <td>{$row['Name']}</td>
                                <td>{$row['Surname']}</td>
                                <td>{$row['Specialization']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['time']}</td>
                            </tr>";
                }
                echo "</table> </div>";
            ?>

            <div class="button">
                <a class="back" href="Users.php">Назад</a>
                <a class="back" href="Home.php">Главное</a>
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