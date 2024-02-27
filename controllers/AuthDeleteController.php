<?php 

include_once "AuthController.php" ;

class AuthDeleteController extends AuthController {
    protected function do_delete() {
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
        $db = $this->connect_db_or_exit();
        $sql = "DELETE FROM Users u WHERE u.email";
        session_start();
    }
}