<?php
/*
 * Validate a color
 *
 * @param String color
 * @return boolean
 */

function validColor($color)
{
    global $f3;
    return in_array($color, $f3->get('colors'));
}

function validString($string)
{
    return !empty(trim($string)) && ctype_alpha($string);
}

function makePet($name, $color, $animal)
{
    if (strtolower($animal) == "dog") {
        $pet1 = new Dog($name, $color, $animal);
    } else if (strtolower($animal) == "cat") {
        $pet1 = new Cat($name, $color, $animal);
    } else {
        $pet1 = new Pet($name, $color, $animal);
    }

    $_SESSION['pet1'] = $pet1;
}