<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function __construct(Permission $permission) {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $permission = $this->permission;

            $response = $permission->get();

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
                'name' => 'required|max:255'
            ];
            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                return response()->json(LibraryController::responseApi([], $validate->getMessageBag(), 100));
            }

            $permission = $this->permission;
            $permission->fill($request->all());
            $permission->password = bcrypt($request->password);
            $permission->save();
            return response()->json(LibraryController::responseApi($permission, 'ok'));
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
            $permission = $this->permission;
            $permission = $permission::findOrFail($id);
            $response = $permission->where('id', $id)->get();
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
            $permission = $this->permission;
            $permission = $permission->findOrFail($id);
            $permission->fill($request->all());
            LibraryController::logupdate($permission);
            $permission->save();
            return response()->json(LibraryController::responseApi($permission, 'ok'));
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
            $permission = $this->permission;
            $permission = $permission->findOrFail($id);
            $permission->delete();
            return response()->json(LibraryController::responseApi($permission, 'ok'));
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
