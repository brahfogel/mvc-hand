<?php
spl_autoload_register ('autoload');

function autoload ($className) {
    $libPath = ROOT . DS . 'lib' . DS . $className . '.php';
    $controllersPath = ROOT . DS . 'controllers' . DS . $className . '.php';
    $modelsPath = ROOT . DS . 'models' . DS . $className . '.php';

    if (file_exists($libPath)) {
        require_once ($libPath);
    }
    elseif (file_exists($controllersPath)) {
        require_once ($controllersPath);
    }
    elseif (file_exists($modelsPath)) {
        require_once ($modelsPath);
    }
    else {
        throw new Exception('Unknown class: ' . $className);
    }
}

require_once (ROOT . DS . 'config' . DS . 'config.php');

function tr($str, $defaultStr = '') {
    return Lang::get($str, $defaultStr);
}






