<?php

class Elephant extends Pet
{
    function talk()
    {
        echo "<p>" . $this->getType() . " trumpets.</p>";
    }
}
