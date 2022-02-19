<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "<table><tr><th>№</th><th>Имя</th><th>Фамилия</th><th>Специализация</th><th></th><th></th></tr>";

if(isset($_POST['special'])){
    $search = $_POST['special'];
    $sql = $db->sql("SELECT * FROM specialists WHERE Name LIKE '%$search%' OR Surname = '$search' ORDER BY Name ASC");
} else $sql = $db->sql("SELECT * FROM specialists ORDER BY Name ASC");

if(mysqli_num_rows($sql) > 0){
    $id = 1;
    while($row = mysqli_fetch_assoc($sql)){
        $output .=  
                    "<tr><td>" . $id .
                    "</td><td>" . $row["Name"] .
                    "</td><td>" . $row["Surname"] .
                    "</td><td>" . $row["Specialization"] .
                    "</td><td>" . " <form action='Schedule.php' method=\"POST\">
                                        <input hidden type='text' name='s_id' value='{$row['id']}'></input>
                                        <input hidden type='text' name='s_name' value='{$row['Name']}'></input>
                                        <input hidden type='text' name='s_surname' value='{$row['Surname']}'></input>
                                        <input class='action' type='submit' value='Записи'></input>
                                        </form>" .
                    "<?php if({$_SESSION['role']} == '1'){ ?>" .
                    "</td>" .
                    "</td><td>" . " <a id='del' type='submit' data-id=\"{$row['id']}\" onclick='Del(this)'>Удалить</a> ".
                    "<?php } ?>" .
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
                        data: { s_id:deleteid },
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