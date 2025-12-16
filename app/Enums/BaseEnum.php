<?php

namespace App\Enums;

use Illuminate\Support\Str;

trait BaseEnum
{
    public static function getCases($value = false, bool $translate = false)
    {
        $combinedArray = array_combine(
            self::getKeys(),
            self::getNames($translate)
        );

        $result = $value
            ? $combinedArray[$value] ?? null
            : $combinedArray;

        return $result;
    }

    public static function getAll($value = false, bool $translate = false)
    {
        $_result = [];

        $combinedArray = array_combine(
            self::getKeys(),
            self::getNames($translate)
        );

        foreach ($combinedArray as $key => $value) {
            $_result[] = [
                'value' => $key,
                'text' => $value,
            ];
        }

        if ($value) {
            foreach ($_result as $item) {
                if ($item['value'] == $value) {
                    return $item;
                }
            }
        }

        return $_result;
    }

    public static function raw($value = false)
    {
        $combinedArray = array_combine(
            self::getKeys(),
            self::getNames(false)
        );

        $result = $value
            ? $combinedArray[$value] ?? null
            : $combinedArray;

        return $result;
    }

    public static function getKeys()
    {
        return self::getColumn('value');
    }

    public static function keyName(string $case): string
    {
        $str = class_basename(self::class);
        $snake = Str::snake($str) . '_' . Str::lower($case);

        return $snake;
    }

    public static function getNames(bool $translate = true)
    {
        return $translate
            ? array_map(fn($case) => __(self::keyName($case)), self::getColumn('name'))
            : self::getColumn('name');
    }

    public static function getSymbol($value)
    {
        return self::getCases()[$value] ?? null;
    }

    public static function getColumnLikeString($column, $separator = ',')
    {
        return join($separator, self::getColumn($column));
    }

    private static function getColumn($value)
    {
        return array_column(self::cases(), $value);
    }

    public function lower()
    {
        return strtolower($this->value);
    }
}
