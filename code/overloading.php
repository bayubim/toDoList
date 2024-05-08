<?php
class Matematika
{
    public function calculate()
    {
        $numArgs = func_num_args();
        $args = func_get_args();

        switch ($numArgs) {
            case 1:
                return $this->square($args[0]);
            case 2:
                return $this->add($args[0], $args[1]);
            case 3:
                return $this->multiply($args[0], $args[1], $args[2]);
            default:
                return "Invalid number of arguments.";
        }
    }

    private function square($num)
    {
        return $num * $num;
    }

    private function add($a, $b)
    {
        return $a + $b;
    }

    private function multiply($a, $b, $c)
    {
        return $a * $b * $c;
    }
}

// Create object
$math = new Matematika();

// Overloading behavior
echo $math->calculate(5) . "<br>";
echo $math->calculate(3, 4) . "<br>";
echo $math->calculate(2, 3, 4) . "<br>";
echo $math->calculate(1, 2, 3, 4) . "<br>";
?>