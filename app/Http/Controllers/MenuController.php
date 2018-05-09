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
    public $columns = ['id','title','description','price','image_base64'];
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
        try{
            $menu = new Menu;
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->price = $request->price;
            // $menu->image_base64 = base64_encode($request->image_base64);
            $menu->image_base64 = $request->image_base64;
            $menu->save();
            return response(array('result'=>'success'));
        }catch (\Exception $e) {
            return response(array('result'=>'error','message'=>$e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (empty(Menu::where(['id' => $id])->select($this->columns)->first())) {
            return response(array('result'=>'error','message'=>'ID not found'));
        }else{
            return (Menu::where(['id' => $id])->select($this->columns)->first());
        }
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
        try{
            $menu = Menu::where(['id' => $id])->first();
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->image_base64 = $request->image_base64;
            $menu->save();
            return response(array('result'=>'success'));
        }catch (\Exception $e) {
            return response(array('result'=>'error','message'=>$e));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(Menu::where(['id' => $id])->select($this->columns)->first())) {
            return response(array('result'=>'error','message'=>'ID not found'));
        }else{
            $menu = Menu::where(['id' => $id])->first();
            $menu->delete();
            return response(array('result'=>'success'));
        }
    }

    public function search()
    {
        return response(Menu::where('title', 'LIKE', "%" . $_GET['keyword'] . "%")->select($this->columns)->get());
    }

}
