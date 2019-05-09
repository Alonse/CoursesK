<?PHP
	$pass=$_POST['pass'];
	$msg_box = "";
	// массив для сбора ошибок
	$errors = array();
	// парсим xml файлЧ 
	$xml_file = simplexml_load_file("test.xml");
	foreach ($xml_file->login as $login) {
	  	if($_POST['login'] != $login) $errors[] = "Не верный Логин!";
		};
	foreach ($xml_file->password as $password) {
	  	if($pass != password_verify($pass, $password)) $errors[] = "Не верный Пароль!";
		};
	if($pass == "") $errors[] = "Не верный Пароль!";
	// проверяем на наличие ошибок
	if(empty($errors)){
		$msg_box = "<span style='color: green; font-size: 27px;'>Hello!</span>";
	 	}
	else
	    {
	     // если были ошибки, то выводим их
	    $msg_box = "";
	    foreach($errors as $one_error){
	        $msg_box .= "<span style='color: red; font-size: 27px;'>$one_error</span><br/>";
	  		}
		}
	// передаем ответ на клиентскую часть в формате JSON  
	echo json_encode (array('result'=> $msg_box));       
?>

