<?PHP
  $xml_file = simplexml_load_file("test.xml");
  foreach ($xml_file->login as $login) {};
  foreach ($xml_file->email as $email) {};
  $msg_box = "";
  $errors = array(); // массив для сбора ошибок
  // проверяем на правильность заполнения формы
  if($_POST['name'] == "") 	 $errors[] = "Поле 'Имя' не заполнено!";
  if($_POST['login'] == "") $errors[] = "Поле 'Логин' не заполнено!";
  if($_POST['pass'] == "") 	 $errors[] = "Поле 'Пароль' не заполнено!";
  if($_POST['confirm_pass'] == "")    $errors[] = "Поле 'Повторить пароль' не заполнено!";
  if($_POST['email'] == "") $errors[] = "Поле 'E-mail' не заполнено!";
  if($_POST['pass'] != $_POST['confirm_pass']) $errors[] = "Пароли не совпадают!";
  if($_POST['login'] == $login) $errors[] = "Такой Логин уже существует!";
  if($_POST['email'] == $email) $errors[] = "Такой Email уже существует!";
  // проверяем на наличие ошибок
  if(empty($errors)){
    $pass=$_POST['pass'];
    // если ошибок нету, вносим данные в xml файл
    $password_hash= password_hash($pass, PASSWORD_DEFAULT);
    $dom_xml= new DomDocument(); 
    $login_xml = $dom_xml->appendChild($dom_xml->createElement('user'));
    $login = $login_xml->appendChild($dom_xml->createElement('login'));
    $password = $login_xml->appendChild($dom_xml->createElement('password'));
    $name = $login_xml->appendChild($dom_xml->createElement('name'));
    $email = $login_xml->appendChild($dom_xml->createElement('email'));
    $title= $login->appendChild($dom_xml->createTextNode($_POST['login']));
    $title= $password->appendChild($dom_xml->createTextNode($password_hash));
    $title= $name->appendChild($dom_xml->createTextNode($_POST['name']));
    $title= $email->appendChild($dom_xml->createTextNode($_POST['email']));
    $dom_xml->formatOutput = true;
    $dom_xml->save('test.xml');
    $msg_box = "<span style='color: green; font-size: 27px;'>Спасибо за регистрацию!</span>";// сообщим об успехе
  }
  else{
       // если были ошибки, то выводим их
      $msg_box = "";
      foreach($errors as $one_error){
          $msg_box .= "<span style='color: red; font-size: 27px;'>$one_error</span><br/>";
      }
  }
  // передаем ответ на клиентскую часть в формате JSON  
  echo json_encode (array('result'=> $msg_box));       
?>