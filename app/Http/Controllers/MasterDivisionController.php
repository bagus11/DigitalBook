<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StoreMasterDivision;
use App\Http\Requests\UpdateMasterDivisionRequest;
use App\Models\MasterDivision;
use Illuminate\Http\Request;

class MasterDivisionController extends Controller
{
    function index(){
        return view('masterDivision.masterDivision-index');
    }
    function getMasterDivision(){
        $data = MasterDivision::all();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function addMasterDivision(Request $request, StoreMasterDivision $storeMasterDivision) {
        try {
            $storeMasterDivision->validated();
            MasterDivision::create([
                'name'=>$request->divisionName
            ]);
            return ResponseFormatter::success(                                
                $storeMasterDivision,
                'Division successfully added'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Division failed to add',
                500
            );
        }
    }
    function detailMasterDivision(Request $request) {
        $detail = MasterDivision::find($request->id);
        return response()->json([
            'detail'=>$detail,
        ]); 
    }
    function updateMasterDivision(Request $request, UpdateMasterDivisionRequest $updateMasterDivision) {
        try {
            $updateMasterDivision->validated();
            MasterDivision::find($request->id)->update([
                'name'=>$request->divisionNameEdit
            ]);
            return ResponseFormatter::success(                                
                $updateMasterDivision,
                'Division successfully updated'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Division failed to update',
                500
            );
        }
    }
    function deleteMasterDivision(Request $request) {
        $status = 500;
        $message = 'Division failed to delete';
        $delete = MasterDivision::find($request->id)->delete();
        if($delete){
            $status = 200;
            $message = 'Division successfully deleted';
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]); 
    }
}
