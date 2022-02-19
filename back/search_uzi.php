<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "<table><tr><th>№</th><th>Имя</th><th>Фамилия</th><th>Специализация</th><th></th></tr>";

if(isset($_POST['uzi'])){
    $search = $_POST['uzi'];
    $sql = $db->sql("SELECT * FROM specialists WHERE specialization = 'узи' AND Name LIKE '%$search%' OR Surname = '$search' ORDER BY Name ASC");
} else $sql = $db->sql("SELECT * FROM specialists WHERE specialization = 'узи' ORDER BY Name ASC");

if(mysqli_num_rows($sql) > 0){
    $id = 1;
    while($row = mysqli_fetch_assoc($sql)){
        $output .=  "<tr><td>" . $id .
                    "</td><td>" . $row["Name"] .
                    "</td><td>" . $row["Surname"] .
                    "</td><td>" . $row["Specialization"] .
                    "</td><td>" . " <form action='Schedule.php' method=\"POST\">
                                        <input hidden type='text' name='s_id' value='{$row['id']}'></input>
                                        <input hidden type='text' name='s_name' value='{$row['Name']}'></input>
                                        <input hidden type='text' name='s_surname' value='{$row['Surname']}'></input>
                                        <input class='action' type='submit' value='Записи'></input>
                                    </form>" .
                    "</td></tr>";
                    $id++;
    }
    $output .= "</table>";
    echo $output;
    exit;
}
else{
    echo "<h1>Не найдено</h1>";
    exit;
}

?>