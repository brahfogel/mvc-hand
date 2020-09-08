<?php


define('DS', DIRECTORY_SEPARATOR); //розделитель директории для винд и лин разный
define('ROOT', dirname(__DIR__)); //путь к общей папки

require_once (ROOT . DS . 'lib' . DS . 'init.php');
session_start();

$uri = $_SERVER['REQUEST_URI']; //tail url '/mvc_hand/'

/*$pass = md5(Config::get('pass_salt') . 'admin1122' . Config::get('pass_pep'));
echo $pass;*/
//admin1122

App::run($uri);


