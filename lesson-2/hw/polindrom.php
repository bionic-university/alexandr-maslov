<?php

echo "Enter string expression\n";
$input_string = trim(fgets(STDIN));

class Palindrome
{
    function revert($input_string)
    {
        return ((string)strrev($input_string));
    }

    function isPalindrome($input_string, $str_reverted)
    {
        if ($input_string == $str_reverted) {
            echo "IT IS A PALINDROME\n";
        } else {
            echo "IT IS NOT A PALINDROME\n";
        }
    }
}


$palindrome = new Palindrome();
$str_reverted = $palindrome->revert($input_string);
$palindrome->isPalindrome($input_string,$str_reverted);

