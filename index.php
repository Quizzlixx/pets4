<?php


/*Kerrie Low
* Elijah Maret
* date: Jan/24/2020
* URL: http://klow4.greenriverdev.com/328/pets2/index.php
* URL: http://emaret.greenriverdev.com/328/pets2/index.php
* description:
*/

// require autoload file
require_once("vendor/autoload.php");

require_once('model/validation-functions.php');


//start a session
session_start();

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);



//instantiate F3
$f3 = Base::instance();

// instantiate controller object
$controller = new Pets4Controller($f3);

//Set dubug level
$f3->set('DEBUG', 3);

// array of colors
$f3->set('colors', array("pink", "green", "blue"));

//DEFINE A DEFAULT ROUTE
$f3->route('GET /', function () {
    $GLOBALS['controller']->home();
});

// pick animal type
$f3->route('GET|POST /animal', function ($f3) {
    $GLOBALS['controller']->animal($f3);
});

// pick animal color
$f3->route('GET|POST /color', function ($f3) {
    $GLOBALS['controller']->color($f3);
});

// pick animal name
$f3->route('GET|POST /name', function ($f3) {
    $GLOBALS['controller']->name($f3);
});

$f3->route('GET|POST /results', function () {
    $GLOBALS['controller']->results();
});

// run f3
$f3->run();





