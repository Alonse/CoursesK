<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> test </title>
		<!-- Подключение библиотеки jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	</head>
	<body>
        <!-- Форма -->
		<form id="myForm" method="POST">
			<p>Логин</p>
			<input type="text" name="login">
			<p>Пароль</p>
			<input type="password" name="pass">
			<p>Готово</p>
			<input type="submit" name="sent" value="ok" id="btn_submit">		
		</form>
        <!-- Блок вывода сообщений -->
		<div id="messages"></div>
        <!-- Скрипт ajax -->
		<script type="text/javascript">	
            $(document).ready(function(){
                $('#btn_submit').click(function(){
                    $.ajax({
                        url: "authorization.php", // куда отправляем
                        type: "POST", // метод передачи
                        dataType: "json", // тип передачи данных
                        data: $('#myForm').serialize(), // что отправляем 
                            // после получения ответа сервера
                            success: function(data){
                            $('#messages').html(data.result); // выводим ответ сервера
                                                    }
                    });
                    return false;
                });
            });
        </script> 
	</body>
</html>