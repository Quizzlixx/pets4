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

/**
 * Return true if the string is not empty and contains only letters, else false
 *
 * @param $string
 * @return bool
 */
function validString($string)
{
    return !empty(trim($string)) && ctype_alpha($string);
}

/**
 * Create an animal object based on the users input.
 *
 * @param $animal
 */
function makePet($animal)
{
    if (strtolower($animal) == "dog") {
        $pet1 = new Dog($animal);
    } else if (strtolower($animal) == "cat") {
        $pet1 = new Cat($animal);
    } else if (strtolower($animal) == "elephant") {
        $pet1 = new Elephant($animal);
    } else {
        $pet1 = new Pet($animal);
    }

    $_SESSION['pet1'] = $pet1;
}