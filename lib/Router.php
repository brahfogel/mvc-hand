<?php

class Router //App
{
    protected $uri;
    protected $route;
    protected $methodPrefix;
    //protected $language;
    protected $controller;
    protected $action;
    protected $params;

    public function getUri()
    {
        return $this->uri;
    }
    public function getRoute()
    {
        return $this->route;
    }
    public function getMethodPrefix()
    {
        return $this->methodPrefix;
    }
    /*public function getLanguage()
    {
        return $this->language;
    }*/
    public function getController()
    {
        return $this->controller;
    }
    public function getAction()
    {
        return $this->action;
    }
    public function getParams()
    {
        return $this->params;
    }

    public function __construct($uri)
    {
        $routs = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->methodPrefix = isset($routs[$this->route]) ? $routs[$this->route] : '';
        //$this->language = Config::get('default_languages');
        $this->controller = Config::get('default_controller'); //page
        $this->action = Config::get('default_action'); //index

        $this->uri = urldecode(trim($uri, '/'));
        $uriParts = explode('?', $this->uri);
        $uriFirstPart = isset($uriParts[0]) ? $uriParts[0] : $this->uri;
        $uriArray = $this->getRealUri($uriFirstPart);

        if (count($uriArray)) { //если не пустой массив
            if (in_array(strtolower(current($uriArray)), array_keys($routs))) { //если ето не админ
                $this->route = strtolower(current($uriArray));
                $this->methodPrefix = isset($routs[$this->route]) ? $routs[$this->route] : '';
                array_shift($uriArray);
            }
            /*elseif (in_array(strtolower(current($uriArray)), Config::get('languages'))) {
                $this->language = strtolower(current($uriArray));
                array_shift($uriArray);
            }*/
            if (current($uriArray)) {
                $this->controller = strtolower(current($uriArray));
                array_shift($uriArray);
            }
            if (current($uriArray)) {
                $this->action = strtolower(current($uriArray));
                array_shift($uriArray);
            }

            $this->params = $uriArray;
        }
    }
    private function getRealUri($strUri = '')
    {
        if ($strUri && Config::get('dir') !== '') {
            $dirArray = explode('/', Config::get('dir'));
            $arrayUri = explode('/', $strUri);
            $isInArray = false;
            foreach ($dirArray as $key=>$dirPart) {
                if (!empty($dirPart) && $dirPart == $arrayUri[0]) {
                    array_shift($arrayUri);
                    $isInArray = true;
                }
            }
            if (!$isInArray) {
                throw new Exception('Config parameter ' . Config::get('dir') . 'is not in URI ' . $strUri);
            }
            return $arrayUri;
        }
        return false;
    }

    public static function redirect($location = '')
    {
        header('Location: /' . Config::get('dir') . $location);
    }

}










