<?php 
require_once "db.php";
$db = new Dbase();

$id = $_POST['id'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$date = $_POST['date'];
$time = $_POST['time'];
$select = $_POST['select'];

$update = $db->sql("UPDATE `schedule` SET `specialist_id`='$select',`date`='$date',`time`='$time',`client_name`='$name',`client_surname`='$surname' WHERE id = '$id'");
header("Location: ../Home.php?snackbar=Запись успешно изменена!!!");
?>