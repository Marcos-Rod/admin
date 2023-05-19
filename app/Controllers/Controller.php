<?php

namespace App\Controllers;

use App\Functions;

class Controller{
    private static $scripts = [];
    
    public function __construct()
    {
        Functions::showErrors(1);
    }
    
    public function view($route, $data = [])
    {
        //Destructurar array
        extract($data);

        $route = str_replace('.', '/', $route);
        
        if (file_exists(URL_SERVIDOR . "resources/views/{$route}.php")) {

            ob_start();
            include URL_SERVIDOR . "resources/views/{$route}.php";
            $content = ob_get_clean();

            return $content;
        } else {
            return "no existe";
        }
    }

    public function redirect($route){
        header("Location: {$route}");
        exit;
    }

    //Registra nuevo escript
    public static function setScript($name, $url = ''){
        self::$scripts[] = [
            'url' => $url,
            'name' => $name
        ];
    }
    
    //Obtiene scripts
    public static function getScript(){
        $html = PHP_EOL . '';
        foreach (self::$scripts as $script ) {
            $html .= '<script src="'.$script['url'].'"></script>' . PHP_EOL;
        }

        return $html;
    }
    
    
    
}