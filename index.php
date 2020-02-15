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

//start a session
session_start();

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//instantiate F3
$f3 = Base::instance();

//Set dubug level
$f3->set('DEBUG', 3);

// array of colors
$f3->set('colors', array("pink", "green", "blue"));

//DEFINE A DEFAULT ROUTE
$f3->route('GET /', function () {
    echo "<h1>Hello Pets!</h2>";

    echo "<a href='name'>Order a Pet</a>";
});

$f3->route('GET|POST /name', function ($f3) {
//    var_dump($_POST);

    unset($_SESSION['name']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['name']) && validString($_POST['name'])) {
            $_SESSION['name'] = $_POST['name'];
            $f3->reroute('/color');
        } else {
            $f3->set("errors['name']", "please enter a name.");
        }
    }

    $view = new Template();
    echo $view->render('views/nameForm.html');
});


$f3->route('GET|POST /color', function ($f3) {
    //var_dump($_POST);

    unset($_SESSION['color']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['color']) && validColor($_POST['color'])) {
            $_SESSION['color'] = $_POST['color'];
            $f3->reroute('/animal');
        } else {
            $f3->set("errors['color']", "please enter a valid color.");
        }
    }

    $view = new Template();
    echo $view->render('views/colorForm.html');
});

$f3->route('GET|POST /animal', function ($f3) {
//    var_dump($_POST);

    unset($_SESSION['animal']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['animal']) && validString($_POST['animal'])) {
            $_SESSION['animal'] = $_POST['animal'];
            $f3->reroute('/results');
        } else {
            $f3->set("errors['animal']", "please enter an animal.");
        }
    }

    $view = new Template();
    echo $view->render('views/typeForm.html');
});

$f3->route('GET|POST /results', function ($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        makePet($_SESSION['name'], $_SESSION['color'], $_SESSION['animal']);
    }
    $view = new Template();
    echo $view->render('views/results.html');
});


$f3->route('GET /@item', function ($f3, $params) {
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





