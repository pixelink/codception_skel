<?php

namespace Tests\Helper;

class Utility
{


    /**
     * @param $value
     * @return string
     */
    public static function timeStampedValue($value)
    {
        return time() . '_' . $value;
    }

}