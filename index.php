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

//Set dubug level
$f3->set('DEBUG', 3);

// array of colors
$f3->set('colors', array("pink", "green", "blue"));

//DEFINE A DEFAULT ROUTE
$f3->route('GET /', function () {
    echo "<h1>Hello Pets!</h2>";

    echo "<a href='animal'>Order a Pet</a>";
});

$f3->route('GET|POST /animal', function ($f3) {
//    var_dump($_POST);

    unset($_SESSION['animal']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // collect POST variable
        $animal = $_POST['animal'];

        // add data to hive
        $f3->set('animal', $animal);

        if (isset($animal) && validString($animal)) {

            // set session data
            $_SESSION['animal'] = $animal;

            // instantiate pet object
            makePet($animal);

            // go to color form
            $f3->reroute('/color');
        } else {
            $f3->set("errors['animal']", "please enter an animal.");
        }
    }

    $view = new Template();
    echo $view->render('views/typeForm.html');
});

$f3->route('GET|POST /color', function ($f3) {
//    var_dump($_POST);

    unset($_SESSION['color']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // collect POST variable
        $color = $_POST['color'];

        // send to hive
        $f3->set('selectedColor', $color);

        if (isset($color) && validColor($color)) {
            // set session variable
            $_SESSION['color'] = $color;

            // set pet1 objects color
            $_SESSION['pet1']->setColor($color);

            // send to name form
            $f3->reroute('/name');
        } else {
            $f3->set("errors['color']", "please enter a valid color.");
        }
    }

    $view = new Template();
    echo $view->render('views/colorForm.html');
});

$f3->route('GET|POST /name', function ($f3) {
//    var_dump($_POST);

    unset($_SESSION['name']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // collect POST variable
        $name = $_POST['name'];
        // send to hive
        $f3->set('name', $name);

        if (isset($name) && validString($name)) {
            // set session variable
            $_SESSION['name'] = $name;

            // set object name
            $_SESSION['pet1']->setName($name);

            // reroute to result page
            $f3->reroute('/results');
        } else {
            $f3->set("errors['name']", "please enter a name.");
        }
    }

    $view = new Template();
    echo $view->render('views/nameForm.html');
});

$f3->route('GET|POST /results', function ($f3) {
//    var_dump($_SESSION);

    $view = new Template();
    echo $view->render('views/results.html');
});

// run f3
$f3->run();





