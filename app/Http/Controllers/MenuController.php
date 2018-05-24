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

    public function index()
    {
        return response(Menu::all(Menu::publishableFields()));
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
        return (Menu::findOrFail($id)->select(Menu::publishableFields())->first());
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
        return response(Menu::searchByKeyword($_GET['keyword']));
    }

}
