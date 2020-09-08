<?php


class Controller
{
    protected $data;
    protected $model;
    protected $params;
    protected $cart;
    protected $session;

    public function getData()
    {
        return $this->data;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getParams()
    {
        return $this->params;
    }

    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->params = App::$routerApp->getParams();
        $this->cart = App::$cartApp;
        $this->session = App::$sessionApp;
    }

    protected function subCheckUser()
    {
        if ($this->session->getValue('email') && $this->session->getValue('pass') && $this->session->getValue('role')) {
            $user = $this->model->getUserByEmail($this->session->getValue('email'));
            if ($user) {
                if ($this->session->getValue('pass') == $user['password']) {
                    return $user['role'];
                }
            }
        }
        return false;
    }

}
