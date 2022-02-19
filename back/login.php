<?php
session_start();

require_once "db.php";;
$db = new Dbase();

if(isset($_POST['log'], $_POST['pass'])) {

	$log = $_POST['log'];
	$pass = $_POST['pass'];
	
	$sql = $db->query("SELECT staff.Login, staff.Password, staff.Name, staff.Surname, user_roles.user_id, staff.id, user_roles.role_id FROM staff INNER JOIN user_roles ON staff.id = user_roles.user_id WHERE staff.Login = '$log' AND staff.Password = '$pass'");

	if(!empty($sql))
		foreach ($sql as $row) {
			if($row['Login'] == $log AND $row['Password'] == $pass)
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['name'] = $row['Name'];
				$_SESSION['surname'] = $row['Surname'];
				$_SESSION['role'] = $row['role_id'];
				header("Location: ../Home.php");
			}
		}
	else header("Location: ../index.php?snackbar=Неправильный логин или пароль");
}