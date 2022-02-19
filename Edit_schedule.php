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
            <form action="back/edit.php" method="post">
                <h2>Изменить запись</h2>
                <select name="select" required>
                    <option disabled selected>Специалисты</option>
                    <?php
                        require_once "back/db.php";
                        $db = new Dbase();

                        $s_id = $_POST['s_id'];
                        $id = $_POST['id'];

                        $sql = $db->query("SELECT * FROM specialists");
                        foreach($sql as $row){
                        ?>
                            <option value=<?php echo $row['id']; ?> <?php if($row['id'] == $s_id){echo 'selected';}?>> <?php echo $row['Name'] . " " . $row['Surname'];?> </option>;
                        <?php
                        }
                    ?>
                </select>
                <input type="text" name="id" value="<?php echo $id; ?>" hidden>
                <input type="text" name="name" placeholder="Имя" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" required>
                <input type="text" name="surname" placeholder="Фамилия" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];} ?>" required>
                <input id="datefield" type="date" name="date" min='1899-01-01' max='2100-13-13' value="<?php if(isset($_POST['date'])){echo $_POST['date'];} ?>" required>
                <input type="time" name="time" value="<?php if(isset($_POST['time'])){echo $_POST['time'];} ?>" required>
                <br>
                <input type="submit" value="Редактировать запись">
            </form>
            <div class="button">
                <?php if(isset($_POST['id'])){
                    ?>
                <a class="back" href="Specialists.php">Назад</a>
                    <?php
                }
                else{
                    ?>
                <a class="back" href="Users.php">Назад</a>
                    <?php
                } ?>
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

function goBack() {
  window.history.back();
}
</script>

</html>