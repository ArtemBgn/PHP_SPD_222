<?php 

include_once "ApiController.php" ;

class AuthController extends ApiController {

    /**
     * Реєстрація нового користувача (Сreate)
     */
    protected function do_post() {
        //$result = [ 'get' => $_GET, 'post' => $_POST, 'files' => $_FILES, ] ;
        
        $result = [ // REST - як "шаблон" однаковоті відповідей АПІ
            'status' => 0,
            'meta' => [
                'api' => 'auth',
                'service' => 'signup',
                'time' => time()
            ],
            'data' => [
                'message' => ""
            ],
        ] ;

        if (empty($_POST["name-user"])) {
            $result[ 'data']['message'] = "Missing required parametr: 'name-user'";
            $this->end_with($result);
        }
        $user_name = trim($_POST["name-user"]);
        if(strlen($user_name)<2) {
            $result['data']['message'] = 
            "Validation violation: 'name-user' too  short";
            $this->end_with($result);
        }
        if(preg_match('/\d/', $user_name)) {
            $result['data']['message'] = 
            "Validation violation: 'name-user' must not contain digit(s)";
            $this->end_with($result);
        }
        $user_email = $_POST["email-user"];
        $user_password = $_POST["password-user"];
        $filename = null;
        if(!empty($_FILES['avatar-user'])) {
            // файл опціональний, але якщо переданий, то перевіряємо його
            if($_FILES['avatar-user']['error'] != 0 || $_FILES['avatar-user']['size'] == 0) {
                $result['data']['message'] = "File upload error";
                $this->end_with($result);
            }
            // перевіряемо тип файлу (розширення) на перелік допустимих
            $ext = pathinfo($_FILES[ 'avatar-user' ]['name'], PATHINFO_EXTENSION);
            if(strpos(".png.jpg.bmp.jpeg.gif.ico", $ext) == -1) {
                $result['data']['message'] = "File type error";
                $this->end_with($result);
            }
            // генеруємо ім'я для збереження файлу, залишаємо розширення
            do {
				$filename = uniqid() . "." . $ext ;
			}  // перевіряємо чи не потрапили в існуючий файл
			while( is_file( "./wwwroot/avatars/" . $filename ) ) ;
			
			// переносимо завантажений файл до нового розміщення
			move_uploaded_file( 
				$_FILES[ 'avatar-user' ][ 'tmp_name' ],
				"./wwwroot/avatars/" . $filename ) ;
        }
        /*
        Запити звичайні - підставляються у текст запиту SQL,
                            виконуються за один акт
        підготовлені - ідуть окремо, виконуються мінімум за два "1-готує", 
                        "2-передає дані", 
                        призначені для багаторазового використання,
                        значно кращі параметри безпеки щодо SQL-ін'єкції.
                        ...WHERE name='%s'... (name = "o`Brian") ->
                        ...WHERE name='o`Brian'... -- пошкоджений запис (Syntax Error)
        Використання підготовлених запитів рекомендується у всіх  випадках, коли
        у запит додаються дані, що приходять зовні
        */
        $db = $this->connect_db_or_exit();
        // виконання запитів
        $sql = "INSERT INTO Users(`email`, `name`, `password`, `avatar`) VALUES(?, ?, ?, ?)";
            
        try {
            $prep = $db->prepare($sql);
            $prep->execute( [
                $user_email,
				$user_name,
				md5( $user_password ),
				$filename
            ] );
        }
        catch( PDOException $ex ) {
			http_response_code( 500 ) ;
			echo "query error: " . $ex->getMessage() ;
			exit ;
		}

        $result[ 'status' ] = 1 ;
		$result[ 'data' ][ 'message' ] = "Signup OK" ;
		$this->end_with( $result ) ;
    }
    // Aвтентифікація користувача (Read)
    protected function do_patch() {
        $result = [ // REST - як "шаблон" однаковоті відповідей АПІ
            'status' => 0,
            'meta' => [
                'api' => 'auth',
                'service' => 'authentication',
                'time' => time()
            ],
            'data' => [
                'message' => $_GET
            ],
        ] ;
        if (empty($_GET["email"])) {
            $result[ 'data']['message'] = "Missing required parametr: 'email'";
            $this->end_with($result);
        }
        $email = trim($_GET["email"]);
        if (empty($_GET["password"])) {
            $result[ 'data']['message'] = "Missing required parametr: 'password'";
            $this->end_with($result);
        }
        $password = $_GET["password"];
        $db = $this->connect_db_or_exit();
        $sql = "SELECT * FROM Users u WHERE u.email = ? AND u.password = ?";
        try {
            $prep = $db->prepare($sql);
            $prep->execute( [$email, md5( $password )] );
            $res = $prep->fetch();
            //$result['data']['message'] = var_export($res, true);
            if($res === false) {
                $result[ 'data']['message'] = "Credentials rejected'";
                $this->end_with($result);
            }
        }
        catch( PDOException $ex ) {
			http_response_code( 500 ) ;
			echo "query error: " . $ex->getMessage() ;
			exit ;
		}
        // робота з сесіями
        session_start();
        $_SESSION['user'] = $res;
        $_SESSION['auth-moment'] = time();
        $result[ 'status' ] = 1 ;
		//$result[ 'data' ][ 'message' ] = "Signup OK" ;
        $this->end_with( $result ) ;
    }
    protected function do_delete() {
        //session_destroy();
        $result = [
            'status' => 0,
            'meta' => [
                'api' => 'auth',
                'service' => 'output',
                'time' => time()
            ],
            'data' => [
                'message' => ""
            ],
        ] ;
        session_start();
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($_SESSION['auth-moment']);
        }
        $result[ 'status' ] = 1 ;
        $result[ 'data' ][ 'message' ] = "Output OK" ;
        $this->end_with( $result ) ;
    }
}
/*
CRUD-повнота -- реалізація щонайменьше 4х операцій з даними

С - create  - method "POST"
R - Read    - method "GET"
U - update  - method "PUT"
D - delete  - method "DELETE"

*/