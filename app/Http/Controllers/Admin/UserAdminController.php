<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\Api\UserApiController;
use Exception;
use Illuminate\Http\Request;
use stdClass;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $userController = UserApiController::index();
            $user = $userController['data'];

            return view('user.index', ['user' => $user]);
        } catch (Exception $e) {
            throw $e;
            return LibraryController::responseApi(["title" => __('messages.titleLoadPageError'), "message" => __('messages.defaultMessage')], "", 500, false);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('user.create');
        } catch (Exception $e) {
            throw $e;
            return LibraryController::responseApi(["title" => __('messages.titleLoadPageError'), "message" => __('messages.defaultMessage')], "", 500, false);
        }
    }

    // /**
    //  * Store a new blog post.
    //  *
    //  * @param  Request  $request
    //  * @return Response
    //  */
    // public function store(Request $request)
    // {
    //     try {

    //         $groupService = GroupService::store($request);
    //         $group = $groupService;

    //         $error = $group['error'];

    //         if ($error) {
    //             $validator = $group['data'];
    //             return back()
    //                         ->withErrors($validator)
    //                         ->withInput();
    //         }

    //         $permission = $request->permission;

    //         if (isset($permission)) {
    //             foreach ($permission as $key => $value) {
    //                 GroupPermission::create([
    //                     'id_group' => $group['data']->id,
    //                     'id_permission' => $value,
    //                 ]);
    //             }
    //         }

    //         return redirect()
    //                         ->route('group.create')
    //                         ->withSuccess('Grupo cadastrado com sucesso!')
    //                         ->withInput();
    //     } catch (Exception $e) {
    //         throw $e;
    //         return LibraryController::responseApi(["title" => __('messages.titleLoadPageError'), "message" => __('messages.defaultMessage')], "", 500, false);
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $userService = UserApiController::show($id);

            $user = $userService['data'];

            $returnUser = new stdClass;
            foreach ($user as $key => $value) {
                $returnUser->id = $value->id;
                $returnUser->name = $value->name;
                $returnUser->email = $value->email;
            }

            return view('user.edit',['user' => $returnUser]);
        } catch (Exception $e) {
            throw $e;
            return LibraryController::responseApi(["title" => __('messages.titleLoadPageError'), "message" => __('messages.defaultMessage')], "", 500, false);
        }
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     try {
    //         // UPDATE GROUP
    //         $groupService = GroupService::update($request, $id);
    //         $group = $groupService;

    //         $error = $group['error'];

    //         if ($error) {
    //             $validator = $group['data'];
    //             return back()
    //                         ->withErrors($validator)
    //                         ->withInput();
    //         }

    //         $request->request->add([
    //             'id_group' => $id
    //         ]);

    //         $groupPermissionService = GroupPermissionService::index($request);
    //         $groupPermission = $groupPermissionService['data'];

    //         $arrayGroupPermission = array();
    //         $updateGroupPermission = false;
    //         if (isset($request->permission)) {
    //             if (count($request->permission) != count($groupPermission)) {
    //                 GroupPermissionService::destroyWithIdGroup($id);
    //                 $updateGroupPermission = true;
    //             }else{
    //                 foreach ($groupPermission as $key => $value) {
    //                     $arrayGroupPermission[] = $value->id_permission;
    //                 }

    //                 $diff = array_diff($request->permission, $arrayGroupPermission);

    //                 if ($diff) {
    //                     GroupPermissionService::destroyWithIdGroup($id);
    //                     $updateGroupPermission = true;
    //                 }
    //             }
    //         }else{
    //             GroupPermissionService::destroyWithIdGroup($id);
    //         }

    //         // SAVE NEW GROUP PERMISSION
    //         if ($updateGroupPermission) {
    //             if ($request->permission) {
    //                 foreach ($request->permission as $value) {
    //                     GroupPermission::create([
    //                         'id_group' => $id,
    //                         'id_permission' => $value,
    //                     ]);
    //                 }
    //             }
    //         }

    //         return redirect()
    //                         ->route('group.index')
    //                         ->withSuccess('Grupo atualizado com sucesso!')
    //                         ->withInput();
    //     } catch (Exception $e) {
    //         throw $e;
    //         return LibraryController::responseApi(["title" => __('messages.titleLoadPageError'), "message" => __('messages.defaultMessage')], "", 500, false);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            UserApiController::destroy($id);
            return redirect()
                        ->route('user.index')
                        ->withSuccess('Usuário excluído com sucesso!')
                        ->withInput();
        } catch (Exception $e) {
            throw $e;
            return LibraryController::responseApi(["title" => __('messages.titleLoadPageError'), "message" => __('messages.defaultMessage')], "", 500, false);
        }
    }
}
