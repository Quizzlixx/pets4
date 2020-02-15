<?php

class Cat extends Pet
{
    function talk()
    {
        echo "<p>" . $this->getName() . " is meowing.</p>";
    }
}
