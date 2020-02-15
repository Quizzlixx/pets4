<?php

class Elephant extends Pet
{
    private $_age;

    function talk()
    {
        echo "<p>" . $this->getType() . " trumpets.</p>";
    }

    function getAge()
    {
        return $this->_age;
    }

    function setAge($age)
    {
        $this->_age = $age;
    }
}
