<?php

namespace Begin\Practice\Helper;

class Data
{
    public function getGender($value)
    {
        return match ((int)$value) {
            0 => __('Female'),
            1 => __('Male'),
            default => ('Other')
        };
    }
}
