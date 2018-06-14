<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image_base64'];

    public static function findAll()
    {
        return Menu::all(Menu::publishableFields());
    }

    public static function createRecord($input)
    {
        $menu = new Menu;
        $menu->fill($input)->save();
        return true;
    }

    public static function findRecord($id)
    {
        return Menu::select(Menu::publishableFields())->findOrFail($id);
    }

    public static function updateRecord($input, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->fill($input)->save();
        return true;
    }

    public static function deleteRecord($id)
    {

        $menu = Menu::findOrFail($id)->first();
        $menu->delete();
        return true;
    }


    private static function publishableFields()
    {
        return array_merge(['id'], (new static)->fillable);
    }

    public static function searchByKeyword($keyword)
    {
        return Menu::where('title', 'LIKE', "%" . $keyword . "%")->orWhere('description', 'LIKE', "%" . $keyword . "%")->select(Menu::publishableFields())->get();
    }

}
