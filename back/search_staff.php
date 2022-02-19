<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "<table><tr><th>№</th><th>Логин</th><th>Пароль</th><th>Имя</th><th>Фамилия</th><th></th></tr>";

if(isset($_POST['staff'])){
    $search = $_POST['staff'];
    $sql = $db->sql("SELECT * FROM staff WHERE id > 0 AND Name LIKE '%$search%' OR Surname = '%$search%' ORDER BY Name ASC");
} else $sql = $db->sql("SELECT * FROM staff WHERE id > 0 ORDER BY Name ASC");

if(mysqli_num_rows($sql) > 0){
    $id = 1;
    while($row = mysqli_fetch_assoc($sql)){
        $output .=  "<tr><td>" . $id .
                    "</td><td>" . $row["Login"] .
                    "</td><td>" . $row["Password"] .
                    "</td><td>" . $row["Name"] .
                    "</td><td>" . $row["Surname"] .
                    "</td><td>" . "<a id='del'; type='submit' data-id=\"{$row['id']}\" onclick='Del(this)'>Удалить</a>" .
                    "</td></tr>";
                    $id++;
    }
    $output .= "</table>" . 
                "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                <script>
                function Del(obj){
                    var el = $(obj);
                    var deleteid = el.data('id');
                    var confirmalert = confirm('Вы уверены?');
                    $.ajax({
                        url: 'back/del.php',
                        type: 'POST',
                        data: { id:deleteid },
                        success: function(response){
                            $(el).closest('tr').fadeOut(800,function(){
                            $(this).remove();
                            });
                        }
                        });
                }
                </script>";
    echo $output;
    exit;
}
else{
    echo "<h1>Не найдено</h1>";
    exit;
}
?>