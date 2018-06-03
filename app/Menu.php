<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image_base64'];

    protected static function findAll()
    {
        return Menu::all(Menu::publishableFields());
    }

    protected static function createRecord($request)
    {
        $menu = new Menu;
        $menu->fill($request)->save();
        return true;
    }

    protected static function findRecord($id)
    {
        return Menu::select(Menu::publishableFields())->findOrFail($id);
    }

    protected static function updateRecord($request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->fill($request->all())->save();
        return true;
    }

    protected static function deleteRecord($id)
    {

        $menu = Menu::findOrFail($id)->first();
        $menu->delete();
        return true;
    }


    protected static function publishableFields()
    {
        return array_merge(['id'], (new static)->fillable);
    }

    protected static function searchByKeyword($keyword)
    {
        return Menu::where('title', 'LIKE', "%" . $keyword . "%")->orWhere('description', 'LIKE', "%" . $keyword . "%")->select(Menu::publishableFields())->get();
    }

}
