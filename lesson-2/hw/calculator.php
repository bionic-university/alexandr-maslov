<?php
echo "\nWelcome to calc 1.0 :)\n";
echo "Enter math expression:\n";
$expression = str_replace(" ", "", fgets(STDIN));

class Calculator
{
    function validate($expression)
    {
        $length = strlen($expression);
        $correct_symbols = ['+', '-', '*', '/', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.'];
        $correct_operands = ['+', '-', '*', '/', '.'];
        $current_symbol_is_number = false;
        for ($i = 0; $i < $length - 1; $i++) {
            if (!in_array($expression[$i], $correct_symbols)) {
                exit("Wrong expression!\n");
            }
            if (in_array($expression[$i], $correct_operands)) {
                if($current_symbol_is_number===false){
                    exit("Wrong expression!\n");
                }
                $current_symbol_is_number = false;
            } else {
                $current_symbol_is_number = true;
            }
        }
        if($current_symbol_is_number===false){
            exit("Wrong expression!\n");
        }
    }

    function getNumbers($expression)
    {
        $correct_operands = ['+', '-', '*', '/'];
        $numbers = [];
        $variable = '';
        $length = strlen($expression);
        for ($i = 0; $i < $length - 1; $i++) {
            if (!in_array($expression[$i], $correct_operands)) {
                $variable .= $expression[$i];
            } else {
                $numbers[] = $variable;
                $variable = '';
            }
        }
        $numbers[] = $variable;
        return $numbers;
    }

    function getOperands($expression)
    {
        $correct_operands = ['+', '-', '*', '/'];
        $operands = [];
        $length = strlen($expression);
        for ($i = 0; $i < $length - 1; $i++) {
            if (in_array($expression[$i], $correct_operands)) {
                $operands[] = $expression[$i];
            }
        }
        return $operands;
    }


    function count($numbers, $operands)
    {
        for ($i = 0; $i < sizeof($operands); $i++) {
            if ($operands[$i] === '*') {
                $result = $numbers[$i] * $numbers[$i + 1];
                array_splice($numbers, $i, 1);
                array_splice($operands, $i, 1);
                $numbers[$i] = $result;
                $i--;
            }
        }
//        var_dump($numbers);
//        var_dump($operands);

        for ($i = 0; $i < sizeof($operands); $i++) {
            if ($operands[$i] === '/') {
                $result = $numbers[$i] / $numbers[$i + 1];
                array_splice($numbers, $i, 1);
                array_splice($operands, $i, 1);
                $numbers[$i] = $result;
                $i--;
            }
        }
//        var_dump($numbers);
//        var_dump($operands);

        for ($i = 0; $i < sizeof($operands); $i++) {
            if ($operands[$i] === '+') {
                $result = $numbers[$i] + $numbers[$i + 1];
                array_splice($numbers, $i, 1);
                array_splice($operands, $i, 1);
                $numbers[$i] = $result;
                $i--;
            } elseif ($operands[$i] === '-') {
                $result = $numbers[$i] - $numbers[$i + 1];
                array_splice($numbers, $i, 1);
                array_splice($operands, $i, 1);
                $numbers[$i] = $result;
                $i--;
            }
        }
//        var_dump($numbers);
//        var_dump($operands);
        echo('The answer is: ' . $numbers[0] . "\n");
    }
}

$calc = new Calculator();
$calc->validate($expression);
$numbers = $calc->getNumbers($expression);
$operands = $calc->getOperands($expression);
$calc->count($numbers, $operands);


