<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StoreMasterTitleRequest;
use App\Http\Requests\UpdateMasterTitleRequest;
use App\Models\MasterTitle;
use Illuminate\Http\Request;

class MasterTitleController extends Controller
{
    function index(){
        return view('masterTitle.masterTitle-index');
    }
    function getMasterTitle() {
        $data = MasterTitle::with('departementRelation','departementRelation.divisionRelation')->orderBy('departement_id','desc')->get();
        return response()->json([
            'data'=>$data,
        ]);  
    }
    function addMasterTitle(Request $request, StoreMasterTitleRequest $storeMasterTitleRequest){
        try {
            $storeMasterTitleRequest->validated();
            MasterTitle::create([
                'name'=>$request->titleName,
                'departement_id'=>$request->departementId,
            ]);
            return ResponseFormatter::success(                                
                $storeMasterTitleRequest,
                'Title successfully added'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Title failed to add',
                500
            );
        }
    }
    function detailMasterTitle(Request $request) {
        $detail = MasterTitle::with('departementRelation')->find($request->id);
        return response()->json([
            'detail'=>$detail,
        ]);  
    }
    function updateMasterTitle(Request $request, UpdateMasterTitleRequest $updateMasterTitleRequest) {
        try {
            $updateMasterTitleRequest->validated();
            MasterTitle::find($request->id)->update([
                'name'=>$request->titleNameEdit,
                'departement_id'=>$request->departementIdEdit,
            ]);
            return ResponseFormatter::success(                                
                $updateMasterTitleRequest,
                'Title successfully added'
            );            
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                $th,
                'Title failed to add',
                500
            );
        } 
    }
    function updateStatusMasterTitle(Request $request) {
        $status =500;
        $message ="Data failed to update";
        $id = MasterTitle::find($request->id);
        $update = MasterTitle::find($request->id)->update([
            'flg_aktif'=>$id->flg_aktif == 1? 0:1
        ]);
        if($update){
            $status = 200;
            $message ="Data successfully updated";
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);   
    }
}
