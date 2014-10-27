<?php

class Shooter
{
    private $weaponClip = ['pistol' => 13, 'machinegun' => 150, 'bow' => 10, 'rifle' => 20, 'gun' => 30];
    private $weapon;
    private $ammo;

    public function __construct()
    {
        echo ' Enter weapon you want to shoot with!' . PHP_EOL . ' Available: Pistol, Machinegun, Bow, Rifle, Gun' . PHP_EOL;
        $this->weapon = trim(strtolower(str_replace(" ", "", fgets(STDIN))));
        echo ' Enter how much ammo you need!' . PHP_EOL . ' Example: 50, 100, 2000' . PHP_EOL;
        $this->ammo = strtolower(str_replace(" ", "", fgets(STDIN)));
        $this->shoot($this->weapon);
    }


    /**
     * @param $weapon
     */
    private function shoot($weapon)
    {
        foreach ($this->weaponClip as $key => $value) {
            if ($key === $weapon) {
                return $weapon;
            }
        }
        echo ' Sorry, you are not skilled enough to use this weapon' . PHP_EOL;
        $this->__construct();

    }

    private function reload($weapon, $ammo)
    {

    }
}