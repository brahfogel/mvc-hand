<?php

Config::set('site_name', 'Хендмейд магазин');

Config::set('languages', ['en', 'uk']);

Config::set('dir', 'mvchand/');
Config::set('views_dir', 'views');

Config::set('routes', ['default' => '', 'admin' => 'admin_']); //положение админ или юзер (не нужно переделовать на админский урл)


Config::set('default_languages', 'en'); //по умолчанию
Config::set('default_controller', 'page');
Config::set('default_action', 'index');
Config::set('default_route', 'default');


Config::set('db_host', 'localhost');
Config::set('db_name', 'db_hand');
Config::set('db_user', 'root');
Config::set('db_pass', '');

Config::set('pass_salt', 'dg6hf6ejbskj8draols');
Config::set('pass_pep', 'd5ohewedhskjfdja56s');

/*
Config::set('db_host', 'mysql.zzz.com.ua');
Config::set('db_name', 'felice');
Config::set('db_user', 'felice');
Config::set('db_pass', '');

Config::set('pass_salt', 'dg6hf6ejbskj8draols');
Config::set('pass_pep', 'd5ohewedhskjfdja56s');
 */


