<?php

namespace App\Services\BitMask;

class DayBitMask
{
    public function daysToMask(array $days): int
    {
        $mask = 0;

        foreach ($days as $day) {
            if ($day < 1 || $day > 7) {
                throw new \InvalidArgumentException('Day must be in range 1..7');
            }

            $mask |= 1 << ($day - 1);
        }

        return $mask;
    }

    public function maskToDays(int $mask): array
    {
        if ($mask < 0 || $mask > 127) {
            return [];
        }

        $days = [];

        for ($day = 1; $day <= 7; $day++) {
            if ($mask & (1 << ($day - 1))) {
                $days[] = $day;
            }
        }

        return $days;
    }
}
