<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/stethoscope.png"/>
    <title>Отчёт</title>
</head>

<header>
    <ul class="nav">
        <li><a href="Home.php"><h3>Главное</h3></a></li>
        <li><a href="Users.php"><h3>Клиенты</h3></a></li>
        <li><a href="Specialists.php"><h3>Специалисты</h3></a></li>
        <li><a href="Uzi.php"><h3>Узи</h3></a></li>
        <?php if($_SESSION['role']=='1'){ ?><li><a href="Staff.php"><h3>Сотрудники</h3></a></li> <?php } ?>
        <li><a href="New_schedule.php"><h3>Новая Запись</h3></a></li>
        <li class="active"><a href="Sum.php"><h3>Отчёт</h3></a></li>
    </ul>

    <ul>
        <li><a href="index.php"><h3>Выйти</h3></a></li>
    </ul>
</header>

<body>
    <section>
        <div class="table">
            <h2>Отчёт за <span><?php echo date("d-m-Y"); ?></span></h2>
            <br>
            <div class="t">
                <table id="testTable">
                    <tr>
                        <th>№</th>
                        <th>Имя клиента</th>
                        <th>Фамилия клиента</th>
                        <th>ИИН</th>
                        <th>Имя сотрудника</th>
                        <th>Фамилия сотрудника</th>
                        <th>Специализация</th>
                        <th>Дата</th>
                        <th>Время</th>
                    </tr>
                    <?php
                    require_once "back/db.php";
                    $db = new Dbase();
                    $sql = $db->sql("SELECT schedule.specialist_id, schedule.id, specialists.Name, specialists.Surname, specialists.Specialization, schedule.date, schedule.time, clients.Name AS c_Name, clients.Surname as c_Surname, clients.IIN FROM schedule INNER JOIN specialists ON schedule.specialist_id = specialists.id INNER JOIN clients ON schedule.client_name = clients.Name WHERE schedule.date = CURDATE() ORDER BY schedule.date DESC, schedule.time");
                    $id = 1;
                    if(mysqli_num_rows($sql) > 0){
                        foreach($sql as $row){
                            echo "
                                <tr>
                                    <td>$id</td>
                                    <td>{$row['c_Name']}</td>
                                    <td>{$row['c_Surname']}</td>
                                    <td>{$row['IIN']}</td>
                                    <td>{$row['Name']}</td>
                                    <td>{$row['Surname']}</td>
                                    <td>{$row['Specialization']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['time']}</td>
                                </tr>";
                            $id++;
                            }
                    }
                    ?>
                <tr>
                    <td class="total" colspan="10">Количество клиентов за <?php echo date("d-m-Y"); ?>: <span><?php echo mysqli_num_rows($sql); ?></span></td>
                </tr>
                </table>
            </div>
            <button id="download" onclick="tableToExcel('testTable', 'W3C Example Table')">Скачать<img src="https://img.icons8.com/fluent/48/000000/download.png"/></button>
        </div>
    </section>
</body>
<script type="text/javascript">
var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
})()
</script>
</html>