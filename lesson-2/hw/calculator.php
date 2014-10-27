<?php
echo "\nWelcome to calc 1.0 :)\n";
echo "Enter math expression:\n";
$expression = str_replace(" ", "", fgets(STDIN));

class Calculator
{
    /**
     * @param $expression
     */
    function validate($expression)
    {
        $length = strlen($expression);
        $correctSymbols = ['+', '-', '*', '/', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.'];
        $correctOperands = ['+', '-', '*', '/', '.'];
        $currentSymbolIsNumber = false;
        for ($i = 0; $i < $length - 1; $i++) {
            if (!in_array($expression[$i], $correctSymbols)) {
                exit("Wrong expression!\n");
            }
            if (in_array($expression[$i], $correctOperands)) {
                if ($currentSymbolIsNumber === false) {
                    exit("Wrong expression!\n");
                }
                $currentSymbolIsNumber = false;
            } else {
                $currentSymbolIsNumber = true;
            }
        }
        if ($currentSymbolIsNumber === false) {
            exit("Wrong expression!\n");
        }
    }

    /**
     * @param $expression
     * @return array
     */
    function getNumbers($expression)
    {
        $correctOperands = ['+', '-', '*', '/'];
        $numbers = [];
        $variable = '';
        $length = strlen($expression);
        for ($i = 0; $i < $length - 1; $i++) {
            if (!in_array($expression[$i], $correctOperands)) {
                $variable .= $expression[$i];
            } else {
                $numbers[] = $variable;
                $variable = '';
            }
        }
        $numbers[] = $variable;
        return $numbers;
    }

    /**
     * @param $expression
     * @return array
     */
    function getOperands($expression)
    {
        $correctOperands = ['+', '-', '*', '/'];
        $operands = [];
        $length = strlen($expression);
        for ($i = 0; $i < $length - 1; $i++) {
            if (in_array($expression[$i], $correctOperands)) {
                $operands[] = $expression[$i];
            }
        }
        return $operands;
    }


    /**
     * @param $numbers
     * @param $operands
     */
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


        for ($i = 0; $i < sizeof($operands); $i++) {
            if ($operands[$i] === '/') {
                $result = $numbers[$i] / $numbers[$i + 1];
                array_splice($numbers, $i, 1);
                array_splice($operands, $i, 1);
                $numbers[$i] = $result;
                $i--;
            }
        }

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

        echo('The answer is: ' . $numbers[0] . "\n");
    }
}

$calc = new Calculator();
$calc->validate($expression);
$numbers = $calc->getNumbers($expression);
$operands = $calc->getOperands($expression);
$calc->count($numbers, $operands);


