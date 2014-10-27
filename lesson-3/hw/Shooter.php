<?php

class Shooter
{
    private $weaponClip = ['pistol' => 13, 'machinegun' => 150, 'bow' => 10, 'rifle' => 20, 'gun' => 30];
    private $weapon;
    private $ammo;

    public function __construct()
    {
        echo PHP_EOL.' Enter weapon you want to shoot with!' . PHP_EOL . ' Available: Pistol, Machinegun, Bow, Rifle, Gun' . PHP_EOL;
        $this->weapon = trim(strtolower(str_replace(" ", "", fgets(STDIN))));
        echo ' Enter how much ammo you need!' . PHP_EOL . ' Example: 50, 100, 2000' . PHP_EOL;
        $this->ammo = trim(fgets(STDIN));
        $this->validate($this->weapon, $this->ammo);
        $this->shoot();
        $this->reload($this->weapon, $this->ammo);
    }

    private function validate($weapon, $ammo)
    {
        $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $error = true;
        foreach ($this->weaponClip as $key => $value) {
            if ($key === $weapon) {
                $error = false;
            }
        }
        if ($error) {
            echo "\033[31m Sorry, you are not skilled enough to use this weapon\033[0m" . PHP_EOL;
        }
        for ($i = 0; $i < strlen($ammo); $i++) {
            if (!in_array($ammo[$i], $numbers)) {
                echo "\033[31m Ammo must be integer!\033[0m".PHP_EOL;
                $error = true;
            }
        }
        if ($error) {
            $this->__construct();
        }
    }

    private function shoot()
    {

    }

    private function reload($weapon, $ammo)
    {

    }
}