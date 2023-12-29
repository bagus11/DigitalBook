<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StorePermission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Menus;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    function index(){
        return view('rolePermission.rolePermission-index');
    }
    
    function getRolePermission(){
        $role           = Role::all();
        $permission     = Permission::all();
        return response()->json([
            'role'=>$role,
            'permission'=>$permission,
        ]); 

    }
    function saveRole(Request $request,StoreRoleRequest $storeRoleRequest){
        try {
            $storeRoleRequest->validated();
            Role::create([
                'name'=>$request->rolesName,
                'guard_name'=>'web'  
              ]);
            return ResponseFormatter::success(                                 
                'Roles successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Roles failed to add',
                500
            );
        }
    }
    function getMenusName() {
        $data           = Menus::all();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function savePermissions(Request $request, StorePermission $storePermission){
        try {
            $storePermission->validated();
            Permission::create([
                'name'=>$request->permissionName,
                'guard_name'=>'web'  
              ]);
            return ResponseFormatter::success(     
                $storePermission,                            
                'Roles successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Roles failed to add',
                500
            );
        }
    }
    function roleDetail(Request $request){
        $detail = Role::find($request->id);

        return response()->json([
            'detail'=>$detail,
        ]);  
    }
    function updateRole(Request $request, UpdateRoleRequest $updateRoleRequest) {
        try {
            $updateRoleRequest->validated();
            Role::find($request->id)->update([
                'name'=>$request->rolesNameEdit, 
              ]);
            return ResponseFormatter::success(     
                $updateRoleRequest,                            
                'Roles successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Roles failed to update',
                500
            );
        }
    }
    function deleteRole(Request $request) {
        $status     =500;
        $message    ='Roles failed to delete';
        $delete = Role::find($request->id)->delete();
        if($delete){
            $status =200;
            $message ='Roles successfully deleted';
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);  
    }
    function deletePermission(Request $request) {
        $status     =500;
        $message    ='Permission failed to delete';
        $delete = Permission::find($request->id)->delete();
        if($delete){
            $status =200;
            $message ='Permission successfully deleted';
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);  
    }
    function getRole(){
        $data = Role::all();
        return response()->json([
            'data'=>$data,
        ]); 
    }
    function getPermission(){
        $data = Permission::all();
        return response()->json([
            'data'=>$data,
        ]); 
    }
    function getUser(){
        $data = User::select('*')->orderBy('id')->get();
        return response()->json([
            'data'=>$data,
        ]); 
    }


}
