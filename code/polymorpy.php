<?php
class Hewan
{
    public function bernafas()
    {
        echo "Bernafas.<br>";
    }
}
class Ikan extends Hewan
{
    public function bernafas()
    {
        echo "Ikan bernafas dengan insang.<br>";
    }
}

class Beruang extends Hewan
{
    public function bernafas()
    {
        echo "Beruang bernafas dengan paru paru.<br>";
    }
}

$ikan = new Ikan();
$beruang = new Beruang();


$ikan->bernafas();
$beruang->bernafas();
?>