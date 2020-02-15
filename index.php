<?php


/*Kerrie Low
* Elijah Maret
* date: Jan/24/2020
* URL: http://klow4.greenriverdev.com/328/pets2/index.php
* URL: http://emaret.greenriverdev.com/328/pets2/index.php
* description:
*/


//start a session
session_start();

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require_once("vendor/autoload.php");

require_once('model/validation-functions.php');


//instantiate F3
$f3 = Base::instance();

//Set dubug level
$f3->set('DEBUG', 3);

// array of colors
$f3->set('colors', array("pink", "green", "blue"));

//DEFINE A DEFAULT ROUTE
$f3->route('GET /', function () {
    //$view = new Template();
    //echo $view->render('views/home.html');
    echo "<h1>Hello Pets!</h2>";

    echo "<a href='order'>Order a Pet</a>";
});

$f3->route('GET|POST /order', function($f3) {

    unset($_SESSION['animal']);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['animal']) && validString($_POST['animal'])){
            $_SESSION['animal'] = $_POST['animal'];
            $f3->reroute('/order2');
        } else {
            $f3 -> set("errors['animal']", "please enter an animal.");
        }

    }

    $view = new Template();
    echo $view->render('views/form1.html');
});


$f3->route('GET|POST /order2', function($f3) {
    //var_dump($_POST);

    unset($_SESSION['color']);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['color']) && validColor($_POST['color'])){
            $_SESSION['color'] = $_POST['color'];
            $f3->reroute('/results');
        } else {
            $f3 -> set("errors['color']", "please enter a valid color.");
        }
    }

    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3->route('GET|POST /results', function() {

    $view = new Template();
    echo $view->render('views/results.html');
});





$f3->route('GET /@item', function($f3, $params) {
    //var_dump($params);
    $item = $params['item'];
    $petSounds = array("dog" => "Woof", "chicken" => "Cluck cluck", "cat" => "Meow", "fish" => "...", "crow" => "Cawcaw!");
    if (array_key_exists($item, $petSounds)) {
        echo $petSounds[$item];
    } else {
        $f3->error(404);
    }
});





//runf3
$f3->run();





