<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formatter extends Model
{

    public static function responseJSON($data)
    {
        if (gettype($data) == 'boolean') {
            if ($data == true) {
                return response(array('result' => 'success'));
            } else {
                return response(array('result' => 'failure'));
            }
        } else if (gettype($data) == 'object' || gettype($data) == 'array') {
            return response($data);
        }
    }


}
