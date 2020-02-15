<?php

class Pet
{
    private $_name;
    private $_color;
    private $_type;

    // PHP only allows ONE constructor
    function __construct($type = "unknown", $color = "?", $name = "unknown")
    {
        $this->_type = $type;
        $this->_color = $color;
        $this->_name = $name;
    }

    function eat()
    {
        // $this MUST be called in PHP
        echo $this->_name . " is eating<br>";
    }

    function talk()
    {
        echo $this->_name . " is talking<br>";
    }

    function getName()
    {
        return $this->_name;
    }

    function setName($name)
    {
        $this->_name = $name;
    }

    function getColor()
    {
        return $this->_color;
    }

    function setColor($color)
    {
        $this->_color = $color;
    }

    function setType($type)
    {
        $this->_type = $type;
    }

    function getType()
    {
        return $this->_type;
    }
}
