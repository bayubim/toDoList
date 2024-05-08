<?php
// Interface
interface Kendaraan
{
    public function bahanBakar();
}

// implementasi interface
class Motor implements Kendaraan
{
    public function bahanBakar()
    {
        echo "Bensin";
    }
}

$dog = new Motor();


$dog->bahanBakar();
?>