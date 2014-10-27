<?php

class Shooter implements RetryInterface
{
    private $weaponClip = ['pistol' => 13, 'machinegun' => 150, 'bow' => 10, 'rifle' => 20, 'gun' => 30];
    private $weapon;
    private $ammo;

    public function __construct()
    {
        echo PHP_EOL . ' Enter weapon you want to shoot with!' . PHP_EOL . ' Available: Pistol, Machinegun, Bow, Rifle, Gun' . PHP_EOL;
        $this->weapon = trim(strtolower(str_replace(" ", "", fgets(STDIN))));
        echo ' Enter how much ammo you need!' . PHP_EOL . ' Example: 50, 100, 2000' . PHP_EOL;
        $this->ammo = trim(fgets(STDIN));
        $this->validate($this->weapon, $this->ammo);
        $this->shoot();
        $this->reload($this->weapon, $this->ammo);
    }

    /**
     * @param $weapon
     * @param $ammo
     */
    private function validate($weapon, $ammo)
    {
        $error = true;
        foreach ($this->weaponClip as $key => $value) {
            if ($key === $weapon) {
                $error = false;
            }
        }
        if ($error) {
            echo "\033[31m Sorry, you are not skilled enough to use this weapon\033[0m" . PHP_EOL;
        }
        if (!preg_match("/^[0-9]*$/", $ammo)) {
            echo "\033[31m Ammo must be a natural number!\033[0m" . PHP_EOL;
            $error = true;
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
        $clipsUsed = 0;
        $ammoUnused = 0;
        foreach ($this->weaponClip as $key => $value) {
            if ($key === $weapon) {
                $clipsUsed = floor($ammo / $value);
                $ammoUnused = $ammo % $value;
            }
        }
        echo ' Nice shooting, you have reloaded ' . $clipsUsed . ' times' . PHP_EOL;
        echo ' You have ' . $ammoUnused . ' ammo left unused' . PHP_EOL;
        echo ' Do you want to try again? [y/n]';
        $this->retry();
    }

    private function retry()
    {
        $retry = trim(strtolower(fgets(STDIN)));
        if ($retry == 'y') {
            $this->__construct();
        } else {
            exit();
        }
    }
}