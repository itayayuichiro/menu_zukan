<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\Input;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $columns = ['id', 'title', 'description', 'price', 'image_base64'];

    // public $columns = ['id', 'title', 'description', 'price'];

    public function index()
    {
        return response(Menu::all($this->columns));
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
        $menu->fill($request->all())->save();
        return response(array('result' => 'success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (Menu::findOrFail($id)->select($this->columns)->first());
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
        $menu = Menu::findOrFail($id);
        $menu->fill(Input::all())->save();
        return response(array('result' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id)->first();
        $menu->delete();
        return response(array('result' => 'success'));
    }

    public function search()
    {
        return response(Menu::where('title', 'LIKE', "%" . $_GET['keyword'] . "%")->orWhere('description', 'LIKE', "%" . $_GET['keyword'] . "%")->select($this->columns)->get());
    }

}
