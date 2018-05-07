<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public $columns = ['id','name','description','price','image_base64'];
    public $columns = ['id', 'name', 'description', 'price'];

    public function index()
    {
        return response(Menu::all($this->columns));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(Menu::all($this->columns));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (Menu::where(['id' => $id])->select($this->columns)->first());

//        return response(Menu::find($id));
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::where(['id' => $id])->first();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::where(['id' => $id])->first();
        $menu->delete();
        return response(Menu::find($id));
    }

    public function search()
    {
        return response(Menu::where('name', 'LIKE', "%" . $_GET['keyword'] . "%")->select($this->columns)->get());
    }

}
