<?php

class Page extends Controller //App
{
    public function __construct(array $data = [])
    {
        parent::__construct();
        $this->model = new PageModel();
    }

    protected function subPageAmount($type, $total = 0){
        if ($type == 1) {
            for ($i=0;$i<=count($this->data['quantityGoods']);$i++) {
                $total += $this->data['quantityGoods'][$i]['COUNT(*)'];
            }
        } else {
            for ($i= 0;$i<=count($this->data['quantityGoods']);$i++) {
                if ($this->data['quantityGoods'][$i]['type'] == $type) {
                    $total = $this->data['quantityGoods'][$i]['COUNT(*)'];
                }
            }
        }
        return ceil($total / 18);
    }
    public function index()
    {
        $typeCategory = ($this->params[0] !== NULL) ? $this->params[0] : 1;
        $startList = ($this->params[1] !== NULL) ? (int)$this->params[1] : 0;
        $this->data['listGoods'] = $this->model->getListGoods($typeCategory, $startList * 18);
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['checkUser'] = $this->subCheckUser();
        $this->data['countUserItems'] = $this->model->getCountUserItems($this->data['checkUser'], $this->session->getValue('email'));
        $this->data['numberPages']['amount'] = $this->subPageAmount($typeCategory);
        $this->data['numberPages']['active'] = $startList;
        $this->data['numberPages']['category'] = $typeCategory;
        $this->data['countCartProducts'] = $this->cart->getProductsId();
    }

    public function item()
    {
        $goodsId = $this->params[0];
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['GoodsId'] = $this->model->getGoodsId($goodsId);
        $this->data['checkUser'] = $this->subCheckUser();
        $this->data['countUserItems'] = $this->model->getCountUserItems($this->data['checkUser'], $this->session->getValue('email'));
        $this->data['countCartProducts'] = $this->cart->getProductsId();
    }

//----------------------------------------change db

    public function item_user()
    {
        $action = isset($this->params[0]) ? $this->params[0] : NULL;
        $idDelete = isset($this->params[1]) ? $this->params[1] : NULL;

        if ($action === "delete") {
            if (is_numeric($idDelete)) {
                if ($this->model->delete($idDelete)) {
                    //Session::setUserMessage('Page was deleted');
                }
                else {
                    //Session::setUserMessage('Error while deleting page with ID "' . $this->params[0] . '"');
                }
            }
            else {
                //Session::setUserMessage('Error: page ID "' . $this->params[0] . '" was missed');
            }
            Router::redirect('ajax/removed');
        }
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['checkUser'] = $this->subCheckUser();
        $this->data['listUserItems'] = $this->model->getListUserItems($this->data['checkUser'], $this->session->getValue('email'), $action * 18);
        $this->data['countUserItems'] = $this->model->getCountUserItems($this->data['checkUser'], $this->session->getValue('email'));
        $this->data['numberPages']['amount'] = ceil($this->data['countUserItems'][0]['COUNT(*)'] / 18);
        $this->data['numberPages']['active'] = $action;
        $this->data['countCartProducts'] = $this->cart->getProductsId();
    }

    public function item_add()
    {
        $action = isset($this->params[0]) ? $this->params[0] : NULL;

        if ($action === 'img') {
            //@mkdir( 'img');
            @$ext = array_pop(explode('.',basename($_FILES['uploadfile']['name'])));
            $new_name = 'u' . time() . '.' . $ext;
            $uploaddir = 'img/';
            $uploadfile = $uploaddir . $new_name;
            copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
            Router::redirect('ajax/' . $new_name);
        }
        elseif ($action === 'insert') {
            if (isset($_POST['name']) && isset($_POST['img']) && isset($_POST['about']) && isset($_POST['type']) && isset($_POST['price']) && !empty($_POST['name']) && !empty($_POST['img']) && !empty($_POST['about']) && !empty($_POST['type']) && !empty($_POST['price'])) {

                $this->model->save($this->session->getValue('email'), $_POST);
                /*if ($this->model->save($_POST)) {
                    Session::setUserMessage('Page "' . $_POST['title'] . '" was added');
                }
                else {
                    Session::setUserMessage('Error while adding page "' . $_POST['title'] . '"');
                }*/
                Router::redirect('ajax/recorded');
            }
        }
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['checkUser'] = $this->subCheckUser();
        $this->data['countUserItems'] = $this->model->getCountUserItems($this->data['checkUser'], $this->session->getValue('email'));
        $this->data['countCartProducts'] = $this->cart->getProductsId();
    }

    public function item_edit()
    {

        $idEdit = isset($this->params[0]) ? $this->params[0] : NULL;

        if ($idEdit === 'img') {
            //@mkdir( 'img');
            @$ext = array_pop(explode('.',basename($_FILES['uploadfile']['name'])));
            $new_name = 'u' . time() . '.' . $ext;
            $uploaddir = 'img/';
            $uploadfile = $uploaddir . $new_name;
            copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
            Router::redirect('ajax/' . $new_name);
        }
        elseif ($idEdit === 'update') {
            if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['img']) && isset($_POST['about']) && isset($_POST['type']) && isset($_POST['price']) && !empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['img']) && !empty($_POST['about']) && !empty($_POST['type']) && !empty($_POST['price'])) {
                $saved = $this->model->save($this->session->getValue('email'), $_POST, $_POST["id"]);
                if ($saved) {
                    //Session::setUserMessage('Page "' . $startOrId . '" was added');
                    Router::redirect('ajax/rewritten');
                } else {
                    //Session::setUserMessage('Error while adding page "' . $startOrId . '"');
                    Router::redirect('ajax/unrecorded');
                }
            }
        }
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['GoodsId'] = $this->model->getGoodsId($idEdit);
        $this->data['checkUser'] = $this->subCheckUser();
        $this->data['countUserItems'] = $this->model->getCountUserItems($this->data['checkUser'], $this->session->getValue('email'));
        $this->data['countCartProducts'] = $this->cart->getProductsId();
    }

//----------------------------------------cart

    public function item_cart()
    {
        $action = isset($this->params[0]) ? $this->params[0] : NULL;
        $idAction = isset($this->params[1]) ? $this->params[1] : NULL;

        if ($action === 'add') {
            $this->cart->addProduct($idAction);
            Router::redirect('ajax/' . $this->cart->getProductsId());
        }
        /*elseif ($action == 'delete') {
            $cart->deleteProduct($idAction);
            Router::redirect('ajax/');
        }*/
        elseif ($action === 'clear') {
            $this->cart->clear();
        }
        elseif (!$this->cart->isEmpty()) {
            $idProduct = $this->cart->getProductsId(true);
            $this->data['productsCart'] = $this->model->getListCartProducts($idProduct);
            $this->data['countCartProducts'] = $this->cart->getProductsId();
        }
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['checkUser'] = $this->subCheckUser();
        $this->data['countUserItems'] = $this->model->getCountUserItems($this->data['checkUser'], $this->session->getValue('email'));
    }

//----------------------------------------access

    public function access_reg()
    {
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['countCartProducts'] = $this->cart->getProductsId();

        if ( isset($_POST['login']) && isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['pass']) ) {
            $checkEmail = $this->model->getUserByEmail($_POST['email']);
            if (!$checkEmail) {
                $greenPass = md5(Config::get('pass_salt') . $_POST['pass'] . Config::get('pass_pep'));
                $user = $this->model->setUser($_POST['login'], $_POST['email'], 'user', $greenPass);
                if ($user) {
//                    Session::setValue('login' , $_POST['login']);
//                    Session::setValue('email' , $_POST['email']);
//                    Session::setValue('role' , 'user');
//                    Session::setValue('pass' , $greenPass);
//                    //------------------ send_email
//                    $recepient = "brahfogel@i.ua";
//                    $nameSite = "beget.com";
//                    $message = "$nameSite " . $_POST['login'] . " " . $_POST['email'];
//                    $res = mail($recepient, 'Subject', $message);
//                    if ($res) {
                        Router::redirect();
//                    }
//                    else {
//                        $this->session->setUserMessage('sms is not send!');
//                    }
                }
            }
            else {
                $this->session->setUserMessage('Такой адрес электронной почты уже существует!');
            }
        }
    }

    public function access()
    {
        $this->data['quantityGoods'] = $this->model->getQuantityGoods();
        $this->data['countCartProducts'] = $this->cart->getProductsId();

        if (isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
            $user = $this->model->getUserByEmail($_POST['email']);
            if ($user) {
                $greenPass = md5(Config::get('pass_salt') . $_POST['pass'] . Config::get('pass_pep'));
                if ($greenPass == $user['password']) {
                    Session::setValue('login' , $user['login']);
                    Session::setValue('email' , $user['email']);
                    Session::setValue('role' , $user['role']);
                    Session::setValue('pass' , $user['password']);
                    Router::redirect();
                }
            }
            else {
                $this->session->setUserMessage('Пароль или email введен неправильно!');
            }
        }
    }

    public function logout()
    {
        Session::destroy();
        Router::redirect();
    }


}







