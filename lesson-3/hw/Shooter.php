<?php

class Shooter
{
    private $weaponShootrate = ['pistol' => 13, 'machinegun' => 150, 'bow' => 10, 'rifle' => 20, 'gun' => 30];

    public function __construct()
    {
        echo PHP_EOL.'Welcome to shooting simulator 1.0 :)'.PHP_EOL;
        echo 'Enter weapon you want to shoot with!'.PHP_EOL.'Available: Pistol, Machinegun, Bow, Rifle, Gun'.PHP_EOL;
        $weapon = strtolower(str_replace(" ", "", fgets(STDIN)));
        echo 'Enter how much ammo you need!'.PHP_EOL.'Example: 50, 100, 2000'.PHP_EOL;
        $ammo = strtolower(str_replace(" ", "", fgets(STDIN)));
    }

    private function Shoot()
    {

    }

    private function Reload()
    {

    }
}

$shooter = new Shooter();