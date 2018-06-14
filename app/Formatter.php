<?php

namespace App;

trait FormatterTrait
{
    public static function boolToJSON($data)
    {
        if ($data == true) {
            return response(array('result' => 'success'));
        } else {
            return response(array('result' => 'failure'));
        }
    }

    public static function objectToJSON($data)
    {
        return response($data);
    }
}

class Formatter
{
    use FormatterTrait;

    public static function responseJSON($data)
    {
        switch (gettype($data)) {
            case 'boolean':
                return Formatter::boolToJSON($data);
            case 'object':
            case 'array':
                return Formatter::objectToJSON($data);
        }
    }
}