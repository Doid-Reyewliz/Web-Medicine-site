<?php
require_once "db.php";
$db = new Dbase();

/* Staff */
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = $db->sql("DELETE FROM staff WHERE id = '$id'");
}

/* Specialists */
if(isset($_POST['s_id'])){
    $id = $_POST['s_id'];

    $sql = $db->sql("DELETE FROM `specialists` WHERE id = $id");
}

/* Clients */
if(isset($_POST['c_id'])){
    $id = $_POST['c_id'];

    $sql = $db->sql("DELETE FROM `clients` WHERE id = $id");
}

/* Schedule */
if(isset($_POST['sch_id'])){
    $id = $_POST['sch_id'];

    $sql = $db->sql("DELETE FROM `schedule` WHERE id = $id");
}
?>