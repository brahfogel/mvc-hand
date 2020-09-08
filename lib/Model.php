<?php


class Model
{
    protected $bd;

    public function __construct()
    {
        $this->db = App::$dbApp;
    }

}
