<?php

namespace App\Controller;

use App\Util\ChargeBatteryInterface;
use App\Util\CleanFloorInterface;

class RobotController implements ChargeBatteryInterface, CleanFloorInterface
{
    protected $battery = 100;
    protected $output;
    const FLOOR_HARD = 'hard';
    const FLOOR_CARPET = 'carpet';

    public function clean(string $floorType, int $area, $output)
    {
        $this->output = $output;
        $isValidate = $this->validateInput($floorType, $area);
        if (false === $isValidate) {
            return;
        } else {
            if (self::FLOOR_HARD == $floorType) {
                $this->hardClean($area);
            } else {
                $this->carpetClean($area);
            }
        }
    }

	/*
	* Implementation of charging battery.
	*/
    public function chargeBattery()
    {
        if (0 == $this->battery) {
            $this->output->writeln('Charging Battery. It will take around 30 seconds to charge. Please wait....');
            sleep(10);
            $this->battery = 100;
            $this->output->writeln('Battery charging completed. Current Availability : '.$this->battery.' %');
        } else {
            $this->output->writeln($this->battery.'% battery still available. Please use this before Charging.');
        }
    }

	/*
	* Implementation of cleaning hard apartment.
	*/
    public function hardClean($area)
    {
        $this->output->writeln('Started cleaning HARD floor....!');
        sleep(10);
        $remainingArea = $area - 60;
        $this->cleanFloor($remainingArea);
    }

	/*
	* Implementation of cleaning carpet apartment
	*/
    public function carpetClean($area)
    {
        $this->output->writeln('Started cleaning CARPET floor....!');
        sleep(10);
        $remainingArea = $area - (60 / 2);
        $this->cleanFloor($remainingArea);
    }

	/*
	* Common code for clean apartment.
	*/
    private function cleanFloor($remainingArea)
    {
        if ($remainingArea > 0) {
            $this->output->writeln('Robot battery is discharged....!');
            $this->battery = 0;
            $this->chargeBattery();
        }
        $this->output->writeln('Cleaning resume....!');
        sleep(10);
        $this->output->writeln('Cleaning completed....!');
    }

	/*
	* Input validation.
	* input: $floorType
	* input: $area
	* output: bool $isValidate
	*/
    private function validateInput($floorType, $area)
    {
        $isValidate = true;
        $floorType = strtolower($floorType);

        if (self::FLOOR_HARD !== $floorType && self::FLOOR_CARPET !== $floorType) {
            $isValidate = false;
            $this->output->writeln('Invalid Floor type. It should be hard or carpet.');
        } elseif (self::FLOOR_HARD == $floorType && $area > 70) {
            $isValidate = false;
            $this->output->writeln('Invalid Apartment Area for hard floor. It should be not more than 70');
        } elseif (self::FLOOR_CARPET == $floorType && $area > 60) {
            $isValidate = false;
            $this->output->writeln('Invalid Apartment Area for carpet floor. It should be not more than 60');
        }

        return $isValidate;
    }
}
