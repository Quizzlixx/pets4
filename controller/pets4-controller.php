<?php

class Pets4Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    public function home()
    {
        echo "<h1>Hello Pets!</h2>";
        echo "<a href='animal'>Order a Pet</a>";
    }

    public function animal($f3)
    {
        //    var_dump($_POST);

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
    }

    public function color($f3)
    {
        //    var_dump($_POST);

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
    }

    public function name($f3)
    {
        //    var_dump($_POST);

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
    }

    public function results()
    {
        //    var_dump($_SESSION);

        $view = new Template();
        echo $view->render('views/results.html');
    }
}
