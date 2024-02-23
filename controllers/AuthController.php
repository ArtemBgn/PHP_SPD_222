<?php 

include_once "ApiController.php" ;

class AuthController extends ApiController {

    /**
     * Реєстрація нового користувача (Сreate)
     */
    protected function do_post() {
        //$result = [ 'get' => $_GET, 'post' => $_POST, 'files' => $_FILES, ] ;
        
        $result = [
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
        $result[ 'status' ] = 1 ;
		$result[ 'data' ][ 'message' ] = "Signup OK" ;
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