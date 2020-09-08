<?php

class Cart
{
    private $products;

    function __construct()
    {
        $this->products = Cookie::get('idCart') == null
            ? array()
            : unserialize(Cookie::get('idCart'));
    }

    public function getProductsId($for_sql = false)
    {
        if ($for_sql) {
            return implode(',', $this->products);
        }

        return !empty($this->products) ? count($this->products) : null;
    }

    public function addProduct($id)
    {
        $id = (int)$id;
        if (!in_array($id, $this->products)) {
            array_push($this->products, $id);
        }
        Cookie::set('idCart', serialize($this->products));
    }

    /*public function deleteProduct($id)
    {
        $id = (int)$id;
        $key = array_search($id, $this->products);
        if ($key !== false){
            unset($this->products[$key]);
        }
        Cookie::set('idCart', serialize($this->products));
    }*/

    public function clear()
    {
        Cookie::delete('idCart');
    }

    public function isEmpty()
    {
        return !$this->products;
    }

}
