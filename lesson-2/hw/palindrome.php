<?php

class Palindrome
{
    function  Palindrome()
    {
        echo "Enter string expression\n";
    }

    private function getString()
    {
        return ((string)trim(fgets(STDIN)));
    }

    private function revert($input_string)
    {
        return ((string)strrev($input_string));
    }

    function isPalindrome()
    {
        $input_string = $this->getString();
        $str_reverted = $this->revert($input_string);
        if ($input_string == $str_reverted) {
            echo "IT IS A PALINDROME\n";
        } else {
            echo "IT IS NOT A PALINDROME\n";
        }
    }
}

$palindrome = new Palindrome();
$palindrome->isPalindrome();

