<?php
declare(strict_types = 1);

namespace App\Converter;

class MarsClockConverter
{
    /**
     * @see https://en.wikipedia.org/wiki/Leap_second
     */
    const CURRENT_LEAP_SECONDS = 37;

    private $earthDate;

    public function __construct(\DateTime $earthDate)
    {
        $this->earthDate = $earthDate;
    }

    /**
     * @see https://en.wikipedia.org/wiki/Timekeeping_on_Mars#Formulas_to_compute_MSD_and_MTC
     */
    public function getMarsSolDate(): float
    {
        $seconds = $this->earthDate->getTimestamp();

        // Julian Date Universal Time
        $julianDateUT = 2440587.5 + ($seconds / 86400);

        // Julian Date Terrestrial Time
        $julianDateTT = $julianDateUT + (self::CURRENT_LEAP_SECONDS + 32.184) / 86400;

        return ($julianDateTT - 2405522.0028779) / 1.0274912517;
    }

    public function getMartianCoordinatedTime(): string
    {
        $marsSolDate = $this->getMarsSolDate();

        $martianHours = fmod((24 * $marsSolDate), 24);

        return gmdate("H:i:s", (int) floor($martianHours * 3600));
    }
}
