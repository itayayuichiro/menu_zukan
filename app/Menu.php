<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image_base64'];

    //
    public static function publishableFields()
    {
        return array_merge(['id'], (new static)->fillable);
    }

    public static function searchByKeyword($keyword)
    {
        return Menu::where('title', 'LIKE', "%" . $keyword . "%")->orWhere('description', 'LIKE', "%" . $keyword . "%")->select(Menu::publishableFields())->get();
    }

}
