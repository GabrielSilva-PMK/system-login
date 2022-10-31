<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct(Menu $menu) {
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $menu = $this->menu;

            $response = $menu->get();

            return response()->json(LibraryController::responseApi($response));
        } catch (Exception $e) {
            LibraryController::recordError($e);
            if ($e->getCode()) {
                $code = $e->getCode();
            }else {
                $code = 500;
            }
            return response()->json(LibraryController::responseApi([],$e->getMessage(), $code));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'id_menu_type' => 'required',
                'name' => 'required|unique:menu',
                'link' => 'max:255',
                'icon' => 'max:255',
                'order' => 'required'
            ];
            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                return response()->json(LibraryController::responseApi([], $validate->getMessageBag(), 100));
            }

            $menu = $this->menu;
            $menu->fill($request->all());
            $menu->password = bcrypt($request->password);
            $menu->save();
            return response()->json(LibraryController::responseApi($menu, 'ok'));
        } catch (Exception $e) {
            LibraryController::recordError($e);
            if ($e->getCode()) {
                $code = $e->getCode();
            }else {
                $code = 500;
            }
            return response()->json(LibraryController::responseApi([],$e->getMessage(), $code));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $menu = $this->menu;
            $menu = $menu::findOrFail($id);
            $response = $menu->where('id', $id)->get();
            return response()->json(LibraryController::responseApi($response));
        } catch (Exception $e) {
            LibraryController::recordError($e);
            if ($e->getCode()) {
                $code = $e->getCode();
            }else {
                $code = 500;
            }
            return response()->json(LibraryController::responseApi([],$e->getMessage(), $code));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $menu = $this->menu;
            $menu = $menu->findOrFail($id);
            $menu->fill($request->all());
            LibraryController::logupdate($menu);
            $menu->save();
            return response()->json(LibraryController::responseApi($menu, 'ok'));
        } catch (Exception $e) {
            LibraryController::recordError($e);
            if ($e->getCode()) {
                $code = $e->getCode();
            }else {
                $code = 500;
            }
            return response()->json(LibraryController::responseApi([],$e->getMessage(), $code));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $menu = $this->menu;
            $menu = $menu->findOrFail($id);
            $menu->delete();
            return response()->json(LibraryController::responseApi($menu, 'ok'));
        } catch (Exception $e) {
            LibraryController::recordError($e);
            if ($e->getCode()) {
                $code = $e->getCode();
            }else {
                $code = 500;
            }
            return response()->json(LibraryController::responseApi([],$e->getMessage(), $code));
        }

    }
}
