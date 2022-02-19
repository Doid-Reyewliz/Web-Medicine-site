<?php 
require_once "db.php";
$db = new Dbase();

if(isset($_POST['select'])){
    $c_id = $_POST['c_select'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $select = $_POST['select'];

    $sel = $db->query("SELECT * FROM clients WHERE id = '$c_id'");
    foreach($sel as $row){
        $name = $row['Name'];
        $surname = $row['Surname'];
    }

    $insert = $db->sql("INSERT INTO `schedule`(`id`,`specialist_id`, `date`, `time`, `client_name`, `client_surname`) VALUES ('','$select','$date','$time','$name','$surname')");
    header("Location: ../Home.php?snackbar=Запись успешно добавлена!!!");
}
if(isset($_POST['st_name'])){
    $name = $_POST['st_name'];
    $surname = $_POST['st_surname'];
    $log = $_POST['st_log'];
    $pass = $_POST['st_pass'];

    $check_name = $db->sql("SELECT * FROM `staff` WHERE Name = '$name' AND Surname='$surname'");
    $check_log = $db->sql("SELECT * FROM `staff` WHERE Name = '$log'");

    if(mysqli_num_rows($check_name) > 0) header("Location: ../New_staff.php?snackbar=Имя и Фамилия уже заняты");
    else if(mysqli_num_rows($check_log) > 0) header("Location: ../New_staff.php?snackbar=Такой логин уже занят");
    else{
        $insert = $db->sql("INSERT INTO `staff`(`id`, `Login`, `Password`, `Name`, `Surname`) VALUES ('','$log','$pass','$name','$surname')");
        $sql = $db->query("SELECT * FROM `staff` WHERE Name = '$name' AND Surname='$surname'");
        foreach($sql as $row){
            $id = $row['id'];
        }
    
        $role = $db->sql("INSERT INTO `user_roles`(`id`, `user_id`, `role_id`) VALUES ('','$id','2')");
        header("Location: ../Home.php?snackbar=Сотрудник успешно добавлен!!!");
    }

}
if(isset($_POST['s_name'])){
    $name = $_POST['s_name'];
    $surname = $_POST['s_surname'];
    $special = $_POST['special'];

    $check_name = $db->sql("SELECT * FROM `specialists` WHERE Name = '$name' AND Surname='$surname'");
    if(mysqli_num_rows($check_name) > 0) header("Location: ../New_special.php?snackbar=Имя и Фамилия уже заняты");
    else{
        $insert = $db->sql("INSERT INTO `specialists`(`id`, `Name`, `Surname`, `Specialization`) VALUES ('','$name','$surname','$special')");
        header("Location: ../Home.php?snackbar=Специалист успешно добавлен!!!");
    }
    
}
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];

    $insert = $db->sql("INSERT INTO `clients`(`id`, `Name`, `Surname`, `Bday`, `Gender`) VALUES ('','$name','$surname','$date','$gender')");
    header("Location: ../Home.php?snackbar=Клиент успешно добавлен!!!");
}
?>