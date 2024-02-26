<?php

//echo '<pre>' ; // замість <?= --виведення до відповіді
//print_r($_SERVER); // друк масиву
$uri =  $_SERVER['REQUEST_URI'];
// якщо у запиті є гет-параметри (знак ?), то прибираємо цю частину
$pos = strpos($uri, '?');
if($pos > 0) {
    $uri = substr($uri, 1, $pos-1);
}
else
{
    $uri = substr($uri, 1);
}
if($uri!="")
{
    $filename = "./wwwroot/{$uri}";
    if(is_readable($filename))
    {
        // без зазначення типу контенту файли можуть бути проігноровані
        // а також з метою обмеження прямого доступу до деяких файлів
        // 

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        //echo $ext; exit;
        unset($content_type);
        switch($ext)
        {
            case 'png': $content_type = "image/{$ext}"; break;
            case 'bmp': $content_type = "image/{$ext}"; break;
            case 'gif': $content_type = "image/{$ext}"; break;
            case 'js': $content_type = "text/javascript"; break;
            case 'jpg': $content_type = "image/jpeg"; break;
            case 'jpeg': $content_type = "image/jpeg"; break;
            case 'css': $content_type = "text/{$ext}"; break;
            case 'html': $content_type = "text/{$ext}"; break;
        }
        if(isset($content_type))
        {
            header("Content-Type: {$content_type}");
            readfile( $filename);
        }
        else
        {
            http_response_code(404);
            echo "Not found";
        }
        exit;
    }
}

$routes = [
    ''         => 'index.php',
    //'signup'   => 'signup.php',
    'basics'   => 'basics.php',
    'layout'   => 'layout.php',
    'api'      => 'api.php',
    'reg'      => 'reg.php' 
];
if(isset($routes[$uri])) { //у маршрутах є відповідний запис
    $page_body = $routes[$uri] ;
    include '_layout.php' ;
}
else {
    // перевіряємо чи є такий контроллер -[Uri]Controller
    $uri_name = ucfirst($uri);
    $controller_name = "{$uri_name}Controller";
    $controller_path = "./controllers/{$controller_name}.php";
    if(is_readable($controller_path))
    {
        include $controller_path;
        $controller_object = new $controller_name();
        $controller_object->serve();
    }
    else
    {
        echo "$uri not found";
    }
}
