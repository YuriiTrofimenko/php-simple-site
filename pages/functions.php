<?php 

function connect(
        /* Параметры соединения */
		$host='localhost:3306', // адрес сервера mysql
		$user='root', // имя пользователя БД
		$pass='root', // пароль пользователя БД
		$dbname='travels') // имя БД
{
    /* Переменная, в которую должен быть записан объект - контекст для работы с БД */
    $pdo = false;
    // склеиваем строку соединения
    $cs = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8;';
    /* Параметры получения результата из БД */
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    );
    /* Попытка соединиться с БД и записать в переменную контекст для дальнейшей работы */
    try {
        $pdo = new PDO($cs, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        echo mb_convert_encoding($e->getMessage(), 'UTF-8', 'Windows-1251');
        return false;
    }
}

function register($name,$pass,$email){
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	$email=trim(htmlspecialchars($email));
	if ($name==="" || $pass==="" || $email==="") {
		echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
		return false;		
	}
	if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) {
		echo "<h3/><span style='color:red;'>Values Length Must Be Between 3 And 30!</span><h3/>";
		return false;		
	}
	$ins='insert into users (login,pass,email,roleid) values("'.$name.'","'.md5($pass).'","'.$email.'",2)';
    $pdo = connect();
    try {
        $resultCode = $pdo->exec($ins);
    } catch (PDOException $e) {
        // Если произошла ошибка - возвращаем ее текст
        $err = $e->getMessage();
        if (substr($err, 0, strrpos($err, ":")) == 'SQLSTATE[23000]:Integrity constraint violation') {
            echo "<h3/><span style='color:red;'>This Login Is Already Taken!</span><h3/>";
        } else {
            echo "<h3/><span style='color:red;'>Error code:".$e->getMessage()."!</span><h3/>";
        }
    }
}

function login($name,$pass)
{
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	if ($name=="" || $pass=="") 
	{
		echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
		return false;
	}
	if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) {
		echo "<h3/><span style='color:red;'>Values Length Must Be Between 3 And 30!</span><h3/>";
		return false;
	}
	$pdo = connect();
	$sel='select * from users where login="'.$name.'" and pass="'.md5($pass).'"';
    try {
        $res = $pdo->query($sel);
        if ($row=$res->fetch(PDO::FETCH_NUM)) {
            $_SESSION['ruser'] = $name;
            // если пользователь - с ролью 1 (администратор) -
            // сохранить его имя в особый элемент сессионного массива,
            // его наличие будет говорить серверной логике,
            // что пользователь - администратор
            if((int)$row[5] === 1)
            {
                $_SESSION['radmin'] = $name;
            }
            return true;
        } else {
            echo "<h3/><span style='color:red;'>No Such User!</span><h3/>";
            return false;
        }
    } catch (PDOException $e) {
        // Если произошла ошибка - возвращаем ее текст
        echo "<h3/><span style='color:red;'>Error code:".$e->getMessage()."!</span><h3/>";
        return false;
    }
}
