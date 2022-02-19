<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/medical-doctor.png"/>
    <title>Узи</title>
</head>

<header>
    <ul class="nav">
        <li><a href="Home.php"><h3>Главное</h3></a></li>
        <li><a href="Users.php"><h3>Клиенты</h3></a></li>
        <li><a href="Specialists.php"><h3>Специалисты</h3></a></li>
        <li class="active"><a href="Uzi.php"><h3>Узи</h3></a></li>
        <?php if($_SESSION['role']=='1'){ ?><li><a href="Staff.php"><h3>Сотрудники</h3></a></li> <?php } ?>
        <li><a href="New_schedule.php"><h3>Новая Запись</h3></a></li>
        <?php if($_SESSION['role']=='1'){ ?><li><a href="Sum.php"><h3>Отчёт</h3></a></li><?php } ?>
    </ul>

    <ul>
        <li><a href="index.php"><h3>Выйти</h3></a></li>
    </ul>
</header>

<body>
    <section>
        <div class="table">
            <h2>Узи</h2>
            <div id="search">
                <input name="search" class="search" type="text" autocomplete="off" placeholder=" Поиск">
            </div>
            <div class="t"></div>
        </div>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
//search
$(document).ready(function(){
    loadData();
    function loadData(query){
        $.ajax({
            url: "back/search_uzi.php",
            type: "POST",
            chache: false,
            data:{
                uzi:query,
            },
            success:function(response){
                $(".t").html(response);
            }
        });
    }

    $(".search").keyup(function(){
        var search = $(this).val();
        if (search !="") {
            loadData(search);
        }else{
            loadData();
        }
    });
});
</script>
</html>