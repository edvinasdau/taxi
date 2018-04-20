<?php

namespace App\Service;

class Calculator
{
    public function add($a, $b)
    {
        $this->validateInput($a, $b);
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        $this->validateInput($a, $b);
        return $a - $b;
    }


    public function validateInput($a, $b): void
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new \UnexpectedValueException();
        }
    }
}