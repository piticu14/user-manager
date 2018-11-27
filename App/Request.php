<?php

namespace App;


class Request
{

    public function process($page)
    {
        if($page === 'index.php') $page = 'signin';
        $controllerName = '\App\Controllers\\' . ucfirst($page) . 'Controller';
        if (class_exists($controllerName)) {
            $controller = new $controllerName;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $methodName = 'action' . ucfirst($page);
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName($this);
                } else {
                    header("Location: ../public/errors/404.php");
                    exit(404);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $methodName = 'render' . ucfirst($page);
                if (method_exists($controller, $methodName)) {
                    if (isset($_GET['id'])) {
                        $controller->$methodName($_GET['id']);
                    } else {
                        $controller->$methodName();
                    }
                } else {
                    header("Location: ../public/errors/404.php");
                    exit(404);
                }
            }
        } else {
            header("Location: ../public/errors/404.php");
            exit(404);
        }
    }

    public function getPost($name = null)
    {
        if (isset($_POST)) {
            if ($name) {
                return $_POST[$name];
            } else {
                return $_POST;
            }
        }
        return false;
    }

    public function getQuery($name = null)
    {
        if (isset($_GET)) {
            if ($name) {
                return $_GET[$name];
            } else {
                return $_GET;
            }
        }
        return false;
    }

}