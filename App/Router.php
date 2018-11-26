<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/25/2018
 * Time: 7:22 PM
 */

namespace App;


class Router
{

    public function process ($path) {
        if($path === '/')  {
            if(class_exists('\App\Homepage')) {
                $homepage = new Homepage();
                $homepage->render();
            } else {
                include_once __DIR__ . '/../public/404.php';
                die();
            }
        } else {
            $path_split = explode('/', ltrim($path));
            $className = '\App\\' . ucfirst($path_split[1]);
            $methodName = $path_split[2];

            if(class_exists($className)) {
                $class = new $className;
                if(method_exists($class, $methodName)) {

                    if(isset($path_split[3])) {
                        $id = $path_split[3];
                    }
                    $class->$methodName($id);
                } else {
                    include_once __DIR__ . '/../public/404.php';
                    die();
                }

            }
        }
    }

}