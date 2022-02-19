<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/reservation-2--v2.png"/>
    <title>Записи</title>
</head>

<body>
    <section>
        <div class="table">
            <h2>Записи</h2>
            <br>
            <!-- Specialists.php -->
            <?php
            if(isset($_POST["s_name"], $_POST["s_surname"])){
            ?>
                <h3><?php echo "Специалист: " . $_POST["s_name"] . " " . $_POST["s_surname"] ?></h3>
                <br>
                <?php 
                    require_once "back/db.php";
                    $db = new Dbase();

                    $specialist_id = $_POST['s_id'];
                    $id=1;

                    $sql = $db->query("SELECT * FROM schedule WHERE specialist_id = '$specialist_id' AND date >= CURDATE() AND time > CURTIME() ORDER BY date ASC, time");
                    echo "<div class='t'>
                            <table>
                                <tr>
                                    <th>№</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th></th>
                                    <th></th>
                                </tr>";
                    foreach($sql as $row){
                        echo "
                                <tr>
                                    <td>$id</td>
                                    <td>{$row['client_name']}</td>
                                    <td>{$row['client_surname']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['time']}</td>
                                    <td>
                                        <form action='Edit_schedule.php' method='POST'>
                                            <input type='text' name='id' value=\"{$row['id']}\" hidden>
                                            <input type='text' name='s_id' value='$specialist_id' hidden>
                                            <input type='text' name='name' value=\"{$row['client_name']}\" hidden>
                                            <input type='text' name='surname' value=\"{$row['client_surname']}\" hidden>
                                            <input type='date' name='date' value=\"{$row['date']}\" hidden>
                                            <input type='time' name='time' value=\"{$row['time']}\" hidden>
                                            <input id='edit' type='submit' value='Изменить'></input>
                                        </form>
                                    </td>
                                    <td>
                                        <a id='del' type='submit' data-id=\"{$row['id']}\" onclick='Del(this)'>Удалить</a>
                                    </td>
                                </tr>";
                                $id++;
                    }
                    echo "</table></div>";
                ?>

                <div class="button">
                    <a class="back" href="Specialists.php">Назад</a>
                </div>

            <!-- Users.php -->
            <?php
            }else { ?>
                <h3><?php echo "Клиент: " . $_POST["c_name"] . " " . $_POST["c_surname"] ?></h3>
                <br>
                <?php 
                    require_once "back/db.php";
                    $db = new Dbase();

                    $c_name = $_POST['c_name'];
                    $c_surname = $_POST['c_surname'];

                    $sql = $db->query("SELECT schedule.specialist_id, schedule.id, specialists.Name, specialists.Surname, specialists.Specialization, schedule.date, schedule.time FROM schedule INNER JOIN specialists ON schedule.specialist_id = specialists.id WHERE schedule.client_name='$c_name' AND schedule.client_surname='$c_surname' AND schedule.date >= CURDATE() AND schedule.time > CURTIME() ORDER BY schedule.date ASC, schedule.time");

                    if(!empty($sql)){
                        echo "<div class='t'>
                        <table>
                            <tr>
                                <th>№</th>
                                <th>Имя</th>
                                <th>Фамилия</th>
                                <th>Специализация</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th></th>
                                <th></th>
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
                                    <td>
                                        <form action='Edit_schedule.php' method='POST'>
                                            <input type='text' name='id' value=\"{$row['id']}\" hidden>
                                            <input type='text' name='s_id' value=\"{$row['specialist_id']}\" hidden>
                                            <input type='text' name='name' value='$c_name' hidden>
                                            <input type='text' name='surname' value='$c_surname' hidden>
                                            <input type='date' name='date' value=\"{$row['date']}\" hidden>
                                            <input type='time' name='time' value=\"{$row['time']}\" hidden>
                                            <input id='edit' type='submit' value='Изменить'></input>
                                        </form>
                                    </td>
                                    <td>
                                        <a id='del' type='submit' data-id=\"{$row['id']}\" onclick='Del(this)'>Удалить</a>
                                    </td>
                                </tr>";
                        }
                        echo "</table></div>";
                    }
                    else echo "<h2>Нет записей</h2>";
                ?>

                <div class="button">
                    <a class="back" href="Users.php">Назад</a>
                    <form action="History.php" method="post">
                        <input hidden type="text" name="name" value="<?php echo $c_name; ?>">
                        <input hidden type="text" name="surname" value="<?php echo $c_surname; ?>">
                        <input class="back" type="submit" value="История клиента"></input>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function Del(obj){
        var el = $(obj);
        var deleteid = el.data('id');
        var confirmalert = confirm('Вы уверены?');
        $.ajax({
            url: 'back/del.php',
            type: 'POST',
            data: { sch_id:deleteid },
            success: function(response){
                $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
                });
            }
            });
    }
    // $(document).ready(function(){
    //     $('№del').click(function(){
    //         var el = this;
    //         var deleteid = $(this).data('id');
    //         var confirmalert = confirm('Вы уверены?');

    //         if (confirmalert == true) {
    //         $.ajax({
    //             url: 'back/del.php',
    //             type: 'POST',
    //             data: { sch_id:deleteid },
    //             success: function(response){
    //                 $(el).closest('tr').fadeOut(800,function(){
    //                 $(this).remove();
    //                 });
    //             }
    //             });
    //         }
    //     });
    // });
</script>
</html>