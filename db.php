<?php 

$db = new \mysqli('localhost', 'root', '');

if (mysqli_connect_errno()) {
	die('Error: ' . mysqli_connect_error());
}

if ($db->query('CREATE DATABASE IF NOT EXISTS db_company;')) {
	//echo 'БД "db_company" успешно создана.<br>';
}

if ($db->select_db('db_company')) {
	//echo 'Была выбрана БД "db_company".<br>';
} else {
	echo 'Не удалось выбрать БД "db_company". Ошибка: ' . $db->error;
}

if ($db->query('CREATE table IF NOT EXISTS company (
		name VARCHAR(30),
		created VARCHAR(20), 
		address VARCHAR(100),
		phone VARCHAR(30),
		site VARCHAR(20),
		director VARCHAR(40),
		info VARCHAR(255));')
	) {
}

if (!empty($_GET)) {
	switch ($_GET['action']) {
		case 'del':
			$db->query("DELETE FROM `company` WHERE `name`='".$_GET['name'.$_GET['id']]."';");
			header('Location: http://digcrm.tk');
			break;
		
		case 'add':
			$db->query("INSERT INTO `company`(`name`, `created`, `address`, `phone`, `site`, `director`, `info`) VALUES ('Название".mt_rand(1000,10000)."','".gmdate("d:m:Y", time()+3600*3)."','Адрес','Телефон','Сайт','ФИО Директора','Информация');");
			header('Location: http://digcrm.tk');
			break;
		
		case 'save':
			$id = $_GET['id'];
			$q = $db->query("UPDATE `company` SET `name`='".$_GET['name'.$id]."',`created`='".$_GET['created'.$id]."',`address`='".$_GET['address'.$id]."',`phone`='".$_GET['phone'.$id]."',`site`='".$_GET['site'.$id]."',`director`='".$_GET['director'.$id]."',`info`='".$_GET['info'.$id]."' WHERE `name`='".$_GET["name".$id]."';");
			header('Location: http://digcrm.tk');
			break;
	}
}

$q = $db->query('SELECT * FROM `company`');

$a = [];

while ($r = $q->fetch_assoc()) {
	$a[] = $r;
}

echo '<form method="GET">';
$table = '<table>';
	$table .= '<thead> <td>ID</td> <td>Имя</td> <td>Дата создания</td> <td>Адрес</td> <td>Телефон</td> <td>Сайт</td> <td>Директор</td> <td>Инфо</td> </thead>';
	$id = 0;
	foreach ($a as $c) {
		$table .= '<tbody>';
		$table .= '<th><p>'.$id.'</p></th>';
		$table .= '<th><input type="text" name="name'.$id.'" value="' . $c['name'] . '" /></th>';
		$table .= '<th><input type="text" name="created'.$id.'" value="' . $c['created'] . '" /></th>';
		$table .= '<th><input type="text" name="address'.$id.'" value="' . $c['address'] . '" /></th>';
		$table .= '<th><input type="text" name="phone'.$id.'" value="' . $c['phone'] . '" /></th>';
		$table .= '<th><input type="text" name="site'.$id.'" value="' . $c['site'] . '" /></th>';
		$table .= '<th><input type="text" name="director'.$id.'" value="' . $c['director'] . '" /></th>';
		$table .= '<th><input type="text" name="info'.$id.'" value="' . $c['info'] . '" /></th>';
		$table .= '</tbody>';
		$id++;
	}
$table .= '</table>';

echo $table;

	$form = '<input type="text" name="id" placeholder="Айди компании" />';
	$form .= '<select name="action">';
		$form .= '<option value="save">Сохранить</option>';
		$form .= '<option value="add">Добавить</option>';
		$form .= '<option value="del">Удалить</option>';
	$form .= '</select>';
	$form .= '<input type="submit" value="Выполнить" />';
$form .= '</form>';

echo $form;

?>
