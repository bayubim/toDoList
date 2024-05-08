<?php
class Animal
{
    // Property untuk menyimpan jenis hewan
    public $jenis;

    // Method untuk mengeluarkan suara 
    public function bersuara()
    {
        echo "Suara hewan...";
    }
}

// Membuat Object dari Class Animal
$kucing = new Animal();
$kucing->jenis = "Kucing";

// Menggunakan method dari Object kucing
$kucing->bersuara();
?>