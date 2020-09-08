<?php
//application

class App
{
    public static $routerApp;
    public static $dbApp;
    public static $cartApp;
    public static $sessionApp;

    public static function getRouter()
    {
        return self::$routerApp;
    }

    public static function run($uri) //index
    {
        self::$routerApp = new Router($uri);
        self::$dbApp = Db::getInstance();
        self::$cartApp = new Cart;
        self::$sessionApp = new Session;
        //Lang::load(self::$routerApp->getLanguage());

        $controllerClass = ucfirst(self::$routerApp->getController());
        //$controllerMethod = self::$router->getMethodPrefix() . self::$router->getAction();
        $controllerMethod = self::$routerApp->getAction();
        $layout = self::$routerApp->getRoute();

        if ($controllerClass === 'Ajax') {
            echo $controllerMethod;
            exit;
        }
        elseif (class_exists($controllerClass)) {
            $controllerObj = new $controllerClass;
            if (method_exists($controllerObj, $controllerMethod)) {
                $controllerObj->$controllerMethod();
                //-------------------------------methodPrefix
                if ( $layout === 'admin') {
                    ( $controllerObj->getData()['checkUser'] )
                        ? Router::redirect('page/item_user')
                        : Router::redirect('page/access');
                }
                //-------------------------------content
                $viewObj = new Views($controllerObj->getData());
                $content = $viewObj->render();
                //-------------------------------else content
                $headerTail = ($controllerObj->getData()['checkUser']) ? 'header_user.html' : 'header.html';
                $headerPath = ROOT . DS . Config::get('views_dir') . DS  . self::$routerApp->getController() . DS . $headerTail;
                $viewHeader = new Views($controllerObj->getData(), $headerPath);
                $header = $viewHeader->render();
            }
            else {
                throw new Exception('Method "' . $controllerMethod . '" of Class "' . $controllerClass . '" was not found');
            }
        }
        else {
            throw new Exception('Class "' . $controllerClass . '" was not found');
        }


        $layoutPath = ROOT . DS . Config::get('views_dir') . DS . 'default.html';
        $layoutObj = new Views(compact('content', 'header'), $layoutPath); //[$content=>'contentVal']
        echo $layoutObj->render();


        self::$dbApp->closeDb();
    }


}






