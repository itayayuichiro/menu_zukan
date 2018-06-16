<?php
namespace App\Http;

trait Formatter
{
    public static function responseJSON($data)
    {
        switch (gettype($data)) {
            case 'boolean':
                if ($data == true) {
                    return response(array('result' => 'success'));
                } else {
                    return response(array('result' => 'failure'));
                }
            case 'object':
            case 'array':
                return response(array('result'=>'success','data'=> $data));
        }
    }
    public static function reponseErrorJSON($message)
    {
        return response([ 'result' => 'error', 'message' => $message ]);
    }
}