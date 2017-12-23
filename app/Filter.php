<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    public function censor($string)
    {

        $array = [];
        for ($i = 1; $i <= mb_strlen($string, 'UTF-8') - 2; $i++) {
            $array[] = '*';
        };
        $first_letter = mb_substr($string, 0, -(mb_strlen($string)-1));
        $last_letter = mb_substr($string, mb_strlen($string)-1);
        return $first_letter . implode($array) . $last_letter;
    }

    public function value($filter)
    {
        return array_map(array($this, 'censor'), $filter);
    }
}
