<?php
class Animal
{
    public $name;
    public $color;
    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }
    public function eat()
    {
        return $this->name . " is eating.";
    }
}
class Dog extends Animal
{
    public $breed;
    public function __construct($name, $color, $breed)
    {
        parent::__construct($name, $color);
        $this->breed = $breed;
    }
    public function eat()
    {
        return $this->name . " the " . $this->breed . " is eating.";
    }
    public function bark()
    {
        return $this->name . " the " . $this->breed . " is barking.";
    }
}
$dog = new Dog("Moli", "White", "chihuahua");
echo $dog->name . " ";
echo $dog->color . " ";
echo $dog->breed . " ";
echo $dog->eat() . " ";
echo $dog->bark() . " ";
?>