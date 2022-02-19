<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "<table><tr><th>№</th><th>Имя</th><th>Фамилия</th><th>Дата рождения</th><th>Пол</th><th>ИИН</th><th></th><th></th></tr>";

if(isset($_POST['special'])){
    $search = $_POST['special'];
    $sql = $db->sql("SELECT * FROM clients WHERE Name LIKE '%$search%' OR Surname = '$search' ORDER BY Name ASC");
} else $sql = $db->sql("SELECT * FROM clients ORDER BY Name ASC");

if(mysqli_num_rows($sql) > 0){
    $id = 1;
    while($row = mysqli_fetch_assoc($sql)){
        $output .=  "
                    <tr><td>" . $id .
                    "</td><td>" . $row["Name"] .
                    "</td><td>" . $row["Surname"] .
                    "</td><td>" . $row["Bday"] .
                    "</td><td>" . $row["Gender"] .
                    "</td><td>" . $row["IIN"] .
                    "</td><td>" . "     <form action='Schedule.php' method='POST'>
                                            <input hidden type='text' name='c_name' value='{$row['Name']}'></input>
                                            <input hidden type='text' name='c_surname' value='{$row['Surname']}'></input>
                                            <input type='submit' value='Записи'></input>
                                        </form>" .
                    "</td><td>". "<button id='del' type='submit' data-id=\"{$row['id']}\">Удалить</button> ".
                    "</td></tr>";
                    $id++;
    }
    $output .= "</table>" . 
                "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                <script>
                $(document).ready(function(){
                    $('№del').click(function(){
                        var el = this;
                        var deleteid = $(this).data('id');
                        var confirmalert = confirm('Вы уверены?');

                        if (confirmalert == true) {
                        $.ajax({
                            url: 'back/del.php',
                            type: 'POST',
                            data: { c_id:deleteid },
                            success: function(response){
                                $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                });
                            }
                            });
                        }
                    });
                });
                </script>";
    echo $output;
    exit;
}
else{
    echo "<h1>Не найдено</h1>";
    exit;
}

?>