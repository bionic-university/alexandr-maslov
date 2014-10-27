<?php

class Shooter
{
    private $weaponShootrate = ['pistol' => 60, 'machinegun' => 850, 'bow' => 12, 'rifle' => 15, 'gun' => 600];
    private $ammo;
    private $shootingTime;

    private function __construct()
    {
        echo 'Welcome to shooting simulator 1.0 :).PHP_EOL';
        echo "Enter math expression:\n";
        $expression = str_replace(" ", "", fgets(STDIN));
    }

    private function Shoot()
    {

    }

    private function Reload()
    {

    }
}